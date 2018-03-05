<div class="container-fluid">
    <div class="row">
        <?php $this->getGlobalTemplate('menu.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-offset-2 col-md-10 main">
            <h1 class="page-header">Профиль</h1>
            <div class="content">
                <br/>
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label for="forName" class="col-sm-2 control-label">Логин</label>
                        <div class="col-sm-4">
                            <p class="form-control-static green"><?php echo $this->get('login','user'); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="forName" class="col-sm-2 control-label">Роль</label>
                        <div class="col-sm-4">
                            <p class="form-control-static green"><?php echo $this->get('role','user'); ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="forName" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Имя" value="<?php echo $this->get('name', 'user'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="forSteam" class="col-sm-2 control-label">Steam ID</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="steam" id="steam" placeholder="steam_id" value="<?php echo $this->get('steam_id','user'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $this->get('email','user'); ?>">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Новый пароль</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Новый пароль">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <button type="submit" class="btn btn-success btn-block">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
