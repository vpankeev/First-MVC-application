<?php

namespace Privilege\Admin\Model;

use core\Model;

class Edit extends Model
{
    public function getPrivileges()
    {
        $select = $this->getDb()->select();
        $data = $select->from('server_entity',['name' => 'serverName'])
            ->joinLeft(
                ['server_privileges' => 'sp'],
                'sp.server_id = main_table.entity_id'
            );
        foreach ($data->fetchAll() as $privilege) {
            $privileges[$privilege['server_id']][] = $privilege;
        }
        return !empty($privileges) ? $privileges : null;
    }
}