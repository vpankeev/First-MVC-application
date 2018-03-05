<?php

namespace core;

use config\Config;
use config\Database;
use core\Session;

class Model
{
    /** @var DB\Database */
    private $db;

    /** @var  array */
    private $data = [];

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = new \core\DB\Database();
        $this->db->create(Database::getSettings());
        $this->getDefaultData();
    }

    /**
     * @return DB\Database
     */
    protected function getDb()
    {
        return $this->db;
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function setData($data)
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $value) {
                $this->data[$key] = $value;
            }
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get Default data for site from db and set to $this->data
     * for page rendering further
     * @return bool
     */
    protected function getDefaultData()
    {
        /**
         * Get session id
         */
        $session = Session::get('user');
        $id = $session['entity_id'];
        if (empty($id)) {
            return false;
        }

        /**
         * Get user data from session id
         */
        $select = $this->db->select();
        $select->from('customer_entity')
            ->joinLeft(
                ['customer_type' => 'type'],
                'main_table.type_id = type.entity_id',
                ['name' => 'role']
            )
            ->where('main_table.entity_id = ?', $id);
        $data = $select->fetch();

        /**
         * Set data to default_data
         */
        return Config::addSetting('user', 'array', $data);
    }
}