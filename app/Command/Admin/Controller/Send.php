<?php

namespace Command\Admin\Controller;

use core\Controller;

class Send extends Controller
{
    public function execute()
    {
        $info = 'Произошла ошибка, при отправке комманды!';

        if (!empty($_POST['command'])) {
            /** @var \Command\Admin\Model\Send $model */
            $model = $this->getModel();
            $info  = $model->exec($_POST['command']);
        } else {
            $info = 'Вы ввели пустое поле!';
        }
        echo $info;
    }
}