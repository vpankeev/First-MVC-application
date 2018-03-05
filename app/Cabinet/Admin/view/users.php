<div class="container-fluid">
    <div class="row">
        <?php $this->getGlobalTemplate('admin_menu.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-offset-2 col-md-10 main">
            <h1 class="page-header">Пользователи</h1>
            <div class="content">
                <br/>
                <table class="table table-hover">
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th>Логин</th>
                        <th>Имя</th>
                        <th>Steam ID</th>
                    </tr>
                    <?php foreach ($this->get('users') as $user) { ?>
                    <tr>
                        <td><?php echo $user['entity_id']; ?></td>
                        <td><?php echo $user['login']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['steam_id']; ?></td>
                        <td class="col-md-1"><a href="/<?php echo $this->get('admin_route');?>/cabinet/user/id/<?php echo $user['entity_id']; ?>" class="btn btn-success">Edit</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
