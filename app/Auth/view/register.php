<div class="container">
    <div class="row">
        <div class="panel-heading">
            <div class="panel-title text-center">
                <h1 class="title">Регистрация</h1>
            </div>
        </div>
        <?php $errors = \core\Session::getMessage('error');?>
        <div class="main-login main-center">
            <form class="form-horizontal register" method="post" action="">

                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Имя</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="name" id="name"  placeholder="Введите имя" value="<?php echo !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : null; ?>"/>
                        </div>
                    </div>
                </div>
                <p class="error"><?php echo !empty($errors['name']) ? $errors['name'] : null; ?></p>
                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Email</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="email" id="email"  placeholder="Введите Email" value="<?php echo !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : null; ?>"/>
                        </div>
                    </div>
                </div>
                <p class="error"><?php echo !empty($errors['email']) ? $errors['email'] : null; ?></p>
                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">Логин</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="username" id="username"  placeholder="Введите логин" value="<?php echo !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : null; ?>"/>
                        </div>
                    </div>
                </div>
                <p class="error"><?php echo !empty($errors['login']) ? $errors['login'] : null; ?></p>
                <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Пароль</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="password" id="password"  placeholder="Введите пароль"/>
                        </div>
                    </div>
                </div>
                <p class="error"><?php echo !empty($errors['pass']) ? $errors['pass'] : null; ?></p>
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Подтвердите пароль</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Подтвердите пароль"/>
                        </div>
                    </div>
                </div>
                <p class="error"><?php echo !empty($errors['confirm']) ? $errors['confirm'] : null; ?></p>
                <div class="form-group ">
                    <button type="submit" class="btn btn-danger btn-lg btn-block login-button">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>