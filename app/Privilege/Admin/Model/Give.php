<?php

namespace Privilege\Admin\Model;

use core\Model;

class Give extends Model
{
    public function getPrivilegeData()
    {
        $select = $this->getDb()->select();
        $select->from('server_entity');
        foreach ($select->fetchAll() as $server) {
            $servers[$server['entity_id']] = $server['name'];
        }
        $data['server'] = $servers;

        $select = $this->getDb()->select();
        $select->from('server_privileges');
        foreach ($select->fetchAll() as $privilege) {
            $privileges[$privilege['server_id']][$privilege['entity_id']] = [
                'name' => $privilege['name'],
                'flags' => $privilege['flags']
            ];
        }
        $data['privilege'] = $privileges;
        return $data;
    }
}