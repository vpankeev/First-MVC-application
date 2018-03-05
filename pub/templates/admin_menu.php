<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li <?php echo $this->checkActivePage(''); ?>><a href="<?php echo $this->getAdminUrl(''); ?>">Информация</a></li>
        <li <?php echo $this->checkActivePage('users'); ?>><a href="<?php echo $this->getAdminUrl('cabinet/users/'); ?>">Пользователи</a></li>
        <li <?php echo $this->checkActivePage('edit'); ?>><a href="<?php echo $this->getAdminUrl('privilege/edit/'); ?>">Управление привилегиями</a></li>
        <li <?php echo $this->checkActivePage('give'); ?>><a href="<?php echo $this->getAdminUrl('privilege/give/'); ?>">Выдать привилегию</a></li>
        <li><a href="/auth/logout/">Выйти</a></li>
    </ul>
</div>