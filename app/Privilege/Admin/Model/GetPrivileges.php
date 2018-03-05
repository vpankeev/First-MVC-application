<?php

namespace Privilege\Admin\Model;

use core\Model;

class GetPrivileges extends Model
{
    public function getPrivileges($id)
    {
        $select = $this->getDb()->select();
        $select->from('server_privileges')
            ->where('server_id = ?' , $id);
        return $select->fetchAll();
    }
}