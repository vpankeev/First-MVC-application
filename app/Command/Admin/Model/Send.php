<?php

namespace Command\Admin\Model;

use core\Model;
use core\SSH;

class Send extends Model
{
    public function exec($command)
    {
        $ssh = new SSH();

        if (!$ssh->connection) {
            return 'Хост или порт введен не верно!';
        }
        if (!$ssh->authentication) {
            return 'Логин или пароль введен неверно!';
        }

        /**
         * Execute the command
         */
        $data = $ssh->exec($command);

        if (!empty($data['errors'])) {
            return 'Ошибка! ' . $data['errors'];
        }
        if (!empty($data['output'])) {
            return 'Ответ от сервера:<br/>' . $data['output'];
        }

        return 'Произошла какая-то не понятная ошибка...';
    }
}