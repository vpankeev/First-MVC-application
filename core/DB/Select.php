<?php

namespace core\DB;

use core\DB\Database;

class Select extends Database
{
    /*
    |--------------------------------------------------------------------------
    | SELECT
    |--------------------------------------------------------------------------
    | columns   - selected columns in query | default - '*' (All columns)
    | table     - main table with which data is select | required field
    | join      - join another one table to select | joinLeft, joinRight, joinInner
    | where     - add where conditions
    | group     - group by condition
    | order     - order by condition
    | limit     - limit condition
    | having    - having condition. Only working with group by
    */

    /**
     * Constants for work with methods
     */
    const QUOTE = '`';
    const DOT = '.';
    const SQL_AS = ' as ';
    const SQL_SELECT = 'SELECT ';
    const SQL_FROM = ' FROM ';
    const SQL_AND = ' AND ';
    const SQL_OR = ' OR ';
    const SQL_ON = ' ON ';
    const SQL_WHERE = ' WHERE ';
    const SQL_LEFT_JOIN = ' LEFT JOIN ';
    const SQL_RIGHT_JOIN = ' RIGHT JOIN ';
    const SQL_INNER_JOIN = ' INNER JOIN ';
    const SQL_GROUP_BY = ' GROUP BY ';
    const SQL_HAVING = ' HAVING ';
    const SQL_ORDER_BY = ' ORDER BY ';
    const SQL_ASC = ' ASC ';
    const SQL_DESC = ' DESC ';
    const SQL_LIMIT = ' LIMIT ';

    /**
     * array with columns for select
     * @var array
     */
    protected $columns;

    /**
     * It's main table with which data is select
     * @var string
     */
    protected $table;

    /**
     * It's array contains joins
     * LEFT_JOIN | RIGHT_JOIN | INNER_JOIN
     * @var array
     */
    protected $join;

    /**
     * It's array contains conditions for select
     * @var array
     */
    protected $where;

    /**
     * It's array contains columns for GROUP BY
     * @var array
     */
    protected $group;

    /**
     * It's array for sort select
     * key - column
     * value - sort | ASC or DESC
     * @var array
     */
    protected $order;

    /**
     * It's array contains condition for limit | offset, limit
     * @var array
     */
    protected $limit;

    /**
     * It's string for having condition in select
     * Used only with group condition
     * @var string
     */
    protected $having;

    /**
     * Set main table for select
     * @param string $table
     * @param array|null $columns
     * @return $this
     */
    public function from($table, $columns = null)
    {
        $this->table = $table;
        if (is_array($columns) && !empty(current($columns)) && $columns != ['*']) {
            $this->addColumns('main_table', $columns);
        } else {
            $this->columns = ['`main_table`.*'];
        }
        return $this;
    }

    /**
     * Fetch single row from mysqli resource
     * @return array|bool|null
     */
    public function fetch()
    {
        if ($result = $this->query($this->buildQuery())) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    /**
     * Fetch all data from mysqli resource
     * @return array|bool|null
     */
    public function fetchAll()
    {
        if ($result = $this->query($this->buildQuery())) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return false;
    }

    /**
     * Building SQL Query from available data
     * @return bool|string
     */
    private function buildQuery()
    {
        if (empty($this->table)) {
            return false;
        }

        $cols   = $this->getColumns();
        $table  = $this->getTable();
        $join   = $this->getJoin();
        $where  = $this->getWhere();
        $group  = $this->getGroup();
        $order  = $this->getOrder();
        $limit  = $this->getLimit();
        $having = $this->getHaving();

        $sql = self::SQL_SELECT . $cols . self::SQL_FROM . $table;
        $sql .= !empty($join) ? $join : null;
        $sql .= !empty($where) ? $where : null;
        $sql .= !empty($group) ? $group : null;
        $sql .= !empty($having) ? $having : null;
        $sql .= !empty($order) ? $order : null;
        $sql .= !empty($limit) ? $limit : null;

        return $sql;
    }

    /**
     * Get main table
     * @return null|string
     */
    private function getTable()
    {
        if ($this->table !== null) {
            return self::QUOTE . $this->table . self::QUOTE . self::SQL_AS . '`main_table`';
        }
        return null;
    }

    /**
     * Main method for join table with different type
     * All of joins are added to array
     * @param $type
     * @param array $table
     * @param string $cond
     * @param array $cols
     * @return bool|string
     */
    private function _join($type, $table, $cond, $cols = ['*'])
    {
        if (!is_array($table) || is_integer(current(array_keys($table))) || empty($cond)) {
            return false;
        }
        $cols = !is_array($cols) ? $cols = [$cols] : $cols;
        $cols = empty(current($cols)) ? ['*'] : $cols;

        $cond = $this->escape($cond);

        $alias = self::QUOTE . current($table) . self::QUOTE;
        $joinTable = self::QUOTE . current(array_keys($table)) . self::QUOTE;

        $join = $type . $joinTable . self::SQL_AS . $alias . self::SQL_ON . $cond;

        if (is_array($cols) && current($cols) != '*') {
            $this->addColumns(current($table), $cols);
        } elseif ($cols == '*' || current($cols) == '*') {
            $this->addColumns(current($table), ['*']);
        }
        $this->join[] = $join;
        return true;
    }

    /**
     * @param array $table
     * @param string $cond
     * @param array $cols
     * @return $this
     */
    public function joinLeft($table, $cond, $cols = ['*'])
    {
        $this->_join(self::SQL_LEFT_JOIN, $table, $cond, $cols);
        return $this;
    }

    /**
     * @param array $table
     * @param string $cond
     * @param array $cols
     * @return $this;
     */
    public function joinRight($table, $cond, $cols = ['*'])
    {
        $this->_join(self::SQL_RIGHT_JOIN, $table, $cond, $cols);
        return $this;
    }

    /**
     * @param array $table
     * @param string $cond
     * @param array $cols
     * @return $this;
     */
    public function joinInner($table, $cond, $cols = ['*'])
    {
        $this->_join(self::SQL_INNER_JOIN, $table, $cond, $cols);
        return $this;
    }

    /**
     * @return string|null
     */
    private function getJoin()
    {
        return !empty($this->join) ? implode(' ', $this->join) : null;
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
     * @param array $columns
     * @return $this
     */
    public function group($columns)
    {
        if (is_array($columns)) {
            foreach ($columns as $column) {
                $this->group[] = $column;
            }
        } else {
            $this->group[] = $columns;
        }
        return $this;
    }

    /**
     * @return bool|string
     */
    private function getGroup()
    {
        if (empty($this->group)) {
            return false;
        }
        $columns = self::SQL_GROUP_BY . implode(', ', $this->group);

        return $columns;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public function having($condition)
    {
        $this->having = $condition;
        return $this;
    }

    /**
     * @return bool|string
     */
    private function getHaving()
    {
        if (!empty($this->having) && !empty($this->group)) {
            return self::SQL_HAVING . $this->having;
        }
        return false;
    }

    /**
     * @param string $column
     * @param string $sort
     * @return $this
     */
    public function order($column, $sort = self::SQL_DESC)
    {
        $this->order[$column] = $sort;
        return $this;
    }

    /**
     * @return bool|string
     */
    private function getOrder()
    {
        if (empty($this->order)) {
            return false;
        }

        foreach ($this->order as $column => $sort) {
            $sort = strtoupper(trim($sort));

            if ($sort == trim(self::SQL_ASC) || empty($sort)) {
                $cols[] = $column . self::SQL_ASC;
            } elseif ($sort == trim(self::SQL_DESC)) {
                $cols[] = $column . self::SQL_DESC;
            }
        }
        return !empty($cols) ? self::SQL_ORDER_BY . implode(', ', $cols) : null;
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return $this
     */
    public function limit($offset = 0, $limit = null)
    {
        if ($limit === null) {
            list($offset, $limit) = [0, $offset];
        }

        if (!empty($limit)){
            $this->limit = ['offset' => $offset, 'limit' => $limit];
        }
        return $this;
    }

    /**
     * @return null|string
     */
    private function getLimit()
    {
        if (!empty($this->limit)) {
            $limit = self::SQL_LIMIT . $this->limit['offset'] . ', ' . $this->limit['limit'];
        }
        return !empty($limit) ? $limit : null;
    }

    /**
     * @param string $table
     * @param array $cols
     * @return bool
     */
    public function addColumns($table, $cols)
    {
        $table = self::QUOTE . $table . self::QUOTE . self::DOT;

        if (is_string($cols)) {
            return false;
        }

        if (count($cols) == 1 && is_integer(current(array_keys($cols)))) {
            $cols = explode(',', current($cols));
        }

        foreach ($cols as $col => $alias) {
            /** Notice: trim convert int to string */

            $alias  = trim($alias) != '*' ? self::QUOTE . $alias . self::QUOTE : $alias;
            $column = $table . self::QUOTE . trim($col) . self::QUOTE;

            if (is_integer($col)) {
                $this->columns[] = $table . $alias;
            } else {
                $this->columns[] = $column . self::SQL_AS . $alias;
            }
        }
        return true;
    }

    /**
     * @return string
     */
    private function getColumns()
    {
        return !empty($this->columns) && is_array($this->columns) ? implode(', ', $this->columns) : null;
    }

    /**
     * Remove columns from select
     * @return $this
     */
    public function removeColumns()
    {
        $this->columns = null;
        return $this;
    }

    /**
     * @return bool|string
     */
    public function getSelect()
    {
        return $this->buildQuery();
    }
}