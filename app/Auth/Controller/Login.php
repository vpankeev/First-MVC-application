<?php

namespace Auth\Controller;

use core\Controller;

class Login extends Controller
{
    /** @var string */
    protected $login;

    /** @var string */
    protected $password;

    /**
     * Default method for controller
     */
    public function execute()
    {
        $this->login = !empty($_POST['login']) ? $_POST['login'] : null;
        $this->password = !empty($_POST['password']) ? $_POST['password'] : null;
        echo json_encode($this->checkData());
    }

    /**
     * check user password and return status
     * @return array
     */
    protected function checkData()
    {
        /** @var \Auth\Model\Login $model */
        $model = $this->getModel();
        $verify = $model->checkData($this->login, $this->password);
        if ($verify) {
            return ['status' => true];
        } else {
            return ['status' => false];
        }
    }
}