<?php

namespace Auth\Model;

use core\Model;
use core\Session;

class Login extends Model
{
    /**
     * Check correct password for user
     * @param $login
     * @param $pass
     * @return bool
     */
    public function checkData($login, $pass)
    {
        if (empty($login) || empty($pass)) {
            return false;
        }
        $select = $this->getDb()->select();
        $data = $select->from('customer_entity')
            ->where('login = ?', $login)
            ->fetch();
        if (empty($data)) {
            return false;
        }
        if (password_verify($pass, $data['password_hash'])) {
            Session::set('user', $data);
            return true;
        }
        return false;
    }
    
}