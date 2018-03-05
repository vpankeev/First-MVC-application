<div class="container-fluid">
    <div class="row">
        <?php $this->getGlobalTemplate('admin_menu.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-offset-2 col-md-10 main">
            <h1 class="page-header">Профиль</h1>
            <div class="content">
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-condensed">
                            <tr>
                                <td>Логин</td>
                                <td><?php echo $this->get('login', 'user'); ?></td>
                            </tr>
                            <tr>
                                <td>Роль</td>
                                <td><?php echo $this->get('role', 'user'); ?></td>
                            </tr>
                            <tr>
                                <td>Имя</td>
                                <td><?php echo $this->get('name','user'); ?></td>
                            </tr>
                            <tr>
                                <td>Steam ID</td>
                                <td><?php echo $this->get('steam_id', 'user'); ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $this->get('email', 'user'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
