<?php

namespace Cabinet\Model;

use config\Config;
use core\Model;

class Profile extends Model
{
    /**
     * Get user data
     * @return array|bool|null
     */
    public function getUserData()
    {
        return Config::getSetting('user');
    }

    /**
     * Save user data from form
     * @return bool
     */
    public function save()
    {
        $user = $this->getUserData();
        $id =  $user['entity_id'];
        $data = [];

        if (!$id) {
            return false;
        }
        if (!empty($_POST['name'])) {
            $data['name'] = $_POST['name'];
        }
        if (!empty($_POST['email'])) {
            $data['email'] = $_POST['email'];
        }
        if (!empty($_POST['steam'])) {
            $data['steam_id'] = $_POST['steam'];
        }
        if (!empty($_POST['password'])) {
            $data['password_hash'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        $update = $this->getDb()->update('customer_entity');
        $update->setData($data)->where('entity_id = ?', $id);
        $update->save();
        Config::addSetting('user','array', $data);

        return true;
    }
}