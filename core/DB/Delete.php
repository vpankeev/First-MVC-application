<?php

namespace core\DB;

use core\DB\Database;

class Delete extends Database
{
    /**
     * Constants for work with methods
     */
    const QUOTE = '`';
    const DOT = '.';
    const SQL_WHERE = ' WHERE ';
    const SQL_AND = ' AND ';
    const SQL_OR = ' OR ';
    const SQL_DELETE = 'DELETE ';
    const SQL_FROM = ' FROM ';

    /** @var string */
    protected $table;

    /** @var array */
    protected $where;

    /**
     * Delete constructor.
     * @param string $table
     */
    public function __construct($table)
    {
        $this->table = $table;
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

    /**
     * @return bool|\mysqli_result
     */
    public function deleteData()
    {
        if (empty($this->table) || empty($this->where) || !is_string($this->getWhere())) {
            return false;
        }

        $sql = self::SQL_DELETE . self::SQL_FROM . self::QUOTE . $this->table . self::QUOTE . $this->getWhere();
        return $this->query($sql);
    }
}