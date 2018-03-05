<?php

namespace core\DB;

use core\DB\Database;

class Update extends Database
{
    /**
     * Constants for work with methods
     */
    const QUOTE = '`';
    const DOT = '.';
    const SQL_SET = ' SET ';
    const SQL_UPDATE = 'UPDATE ';
    const SQL_WHERE = ' WHERE ';
    const SQL_AND = ' AND ';
    const SQL_OR = ' OR ';

    /** @var  string */
    protected $table;

    /** @var array */
    protected $data;

    /** @var array*/
    protected $where;

    /**
     * Update constructor.
     * @param $table
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * @return bool|\mysqli_result
     */
    public function save()
    {
        if (empty($this->table) || empty($this->getData())) {
            return false;
        }

        $sql  = self::SQL_UPDATE . self::QUOTE . $this->table . self::QUOTE . self::SQL_SET . $this->getData();
        $sql .= $this->getWhere() ? $this->getWhere() : null;
        return $this->query($sql);
    }

    /**
     * Set data to array
     * @param array $data
     * @return $this|bool
     */
    public function setData($data)
    {
        if (empty($data)) {
            return false;
        }

        foreach ($data as $column => $value) {
            $value = $this->escape(trim($value));
            $this->data[$column] = $value;
        }
        return $this;
    }

    /**
     * Prepare data before insert to db
     * @return array|bool
     */
    protected function getData()
    {
        if (empty($this->data)) {
            return false;
        }

        foreach ($this->data as $column => $value) {
            $items[] = $column . ' = \'' . $value . '\'';
        }
        return is_array($this->data) && !empty($items) ? implode(', ', $items) : null;
    }

    /**
     * Add where to array with protected from SQL injection
     * @param string $cond
     * @param null|string $value
     * @param null|string $type
     * @return $this
     */
    public function where($cond, $value = null, $type = null)
    {
        if ($value !== null) {
            $value = $this->escape($value);
            $cond  = str_replace('?', '\'' . $value . '\'', $cond);
        }

        if (!count($this->where)) {
            $type = null;
        } elseif (($type === null && count($this->where)) || $type == trim(self::SQL_AND)) {
            $type = self::SQL_AND;
        } else {
            $type = self::SQL_OR;
        }

        if (!empty($cond)) {
            $this->where[] = $type . '(' . $cond . ')';
        }
        return $this;
    }

    /**
     * @return bool|string
     */
    protected function getWhere()
    {
        return !empty($this->where) ? self::SQL_WHERE . implode(' ', $this->where) : null;
    }
}