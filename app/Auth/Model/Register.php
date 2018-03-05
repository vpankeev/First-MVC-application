<?php

namespace Auth\Model;

use core\Model;
use core\Session;

class Register extends Model
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $email;

    /** @var string */
    protected $login;

    /** @var string */
    protected $pass;

    /** @var string */
    protected $confirm;

    /** @var array|null */
    protected $error;

    /**
     * Check user data and insert user to db
     * @return bool
     */
    public function insertUser()
    {
        $this->name     = $_POST['name'];
        $this->email    = $_POST['email'];
        $this->login    = $_POST['username'];
        $this->pass     = $_POST['password'];
        $this->confirm  = $_POST['confirm'];

        if ($this->validateData()) {
            return $this->success();
        } else {
            return false;
        }
    }

    /**
     * validate user data from registration form
     * @return bool
     */
    protected function validateData()
    {
        $data = $this->getDb()->select()
            ->from('customer_entity')
            ->where('login = ?', $this->login)
            ->where('email = ?', $this->email, 'OR')
            ->fetch();

        if (strlen($this->name) < 5) {
            $this->error['name'] = 'Имя должно быть больше 5 символов!';
        }
        if (!preg_match('/^[a-zA-Z][a-zA-Z0-9-_\.]{4,20}$/s', $this->login)) {
            $this->error['login'] = 'Логин должен быть не меньше 5 символов и не больше 20!';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error['email'] = 'Вы ввели не верный email!';
        }
        if (strlen($this->pass) < 6) {
            $this->error['pass'] = 'Пароль должен быть больше 6 символов!';
        }
        if ($this->pass != $this->confirm) {
            $this->error['confirm'] = 'Пароли не совпадают!';
        }

        if (!empty($data)) {
            if ($this->login == $data['login']) {
                $this->error['login'] = 'Пользователь с таким логином уже существует!';
            }
            if ($this->email == $data['email']) {
                $this->error['email'] = 'Пользователь с таким email уже существует!';
            }
        }
        if ($this->error) {
            Session::setMessage('error', $this->error);
            return false;
        }
        return true;
    }

    /**
     * Insert user to db
     */
    protected function success()
    {
        $hash = password_hash($this->pass, PASSWORD_BCRYPT);

        $insert = $this->getDb()->insert('customer_entity');
        $insert->setData([
            'name' => $this->name,
            'email' => $this->email,
            'login' => $this->login,
            'password_hash' => $hash
        ]);
        return $insert->save();
    }
}