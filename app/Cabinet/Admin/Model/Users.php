<?php

namespace Cabinet\Admin\Model;

use core\Model;

class Users extends Model
{
    public function getUsers()
    {
        $select = $this->getDb()->select();
        $select->from('customer_entity')
            ->order('entity_id', 'ASC');
        return $select->fetchAll();
    }
}