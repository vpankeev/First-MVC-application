<?php

namespace core\DB;

use core\DB\Database;

class Insert extends Database
{
    /**
     * Constants for work with methods
     */
    const QUOTE = '`';
    const DOT = '.';
    const SQL_INSERT = 'INSERT INTO ';
    const SQL_SET = ' SET ';

    /** @var  string */
    protected $table;

    /** @var array */
    protected $data;

    /**
     * Insert constructor.
     * @param string $table
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

        $sql = self::SQL_INSERT . self::QUOTE . $this->table . self::QUOTE . self::SQL_SET . $this->getData();
        return $this->query($sql);
    }

    /**
     * Set data to array
     * @param array $data
     * @return $this|bool
     */
    public function setData($data)
    {
        if (is_integer(current(array_keys($data)))) {
            return false;
//            throw new \Exception('The array must be associative!');
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
}