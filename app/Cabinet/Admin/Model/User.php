<?php

namespace Cabinet\Admin\Model;

use core\Model;

class User extends Model
{
    /**
     * @param $id
     * @return array|mixed
     */
    public function getUserData($id)
    {
        $select = $this->getDb()->select();
        $select->from('customer_entity')
            ->where('entity_id = ?', $id);
        $data['user'] = $select->fetch();

        $select = $this->getDb()->select();
        $select->from('customer_type');

        foreach ($select->fetchAll() as $type) {
            $types[$type['entity_id']] = $type['name'];
        }
        $data['type'] = $types;
        return $data;
    }
}