<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle" aria-hidden="true"></i>
            <?php echo $this->get('name', 'user'); ?> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="/cabinet/profile/"><i class="fa fa-id-card"></i> Профиль</a>
            </li>
            <?php if ($this->get('type_id', 'user') == 1) { ?>
                <li>
                    <a href="/<?php echo $this->get('admin_route'); ?>"><i class="fa fa-eye"></i> Админка</a>
                </li>
            <?php } ?>
            <li>
                <a href="/auth/logout/"><i class="fa fa-sign-out"></i> Выйти</a>
            </li>
        </ul>
    </li>
</ul>