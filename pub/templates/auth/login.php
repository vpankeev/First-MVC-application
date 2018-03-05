<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sign-in" aria-hidden="true"></i> Войти <span class="caret"></span></a>
        <ul id="login-dp" class="dropdown-menu">
            <li>
                <div class="row">
                    <div class="col-md-12">
                        <form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-nav">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                    <input class="form-control" placeholder="Логин / Steam ID" name="login" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </span>
                                    <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="error-hide">Вы ввели неверно логин или пароль!</p>
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Войти">
                            </div>
                            <hr class="black-separator">
                            <div class="form-group">
                                <a class="btn btn-sm btn-primary btn-block" href="/auth/register/">Регистрация</a>
                            </div>
                        </form>
                        <script>
                            var form = $('#login-nav');

                            form.find('input[type="submit"]').click(function() {
                                login = form.find("input[name=login]").val();
                                pass = form.find("input[name=password]").val();

                                $.ajax({
                                    url: '/auth/login/',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        'login' : login,
                                        'password' : pass
                                    },
                                    beforeSend: function () {
                                        $('.form-group p.error-hide').hide();
                                    },
                                    success: function (data) {
                                        if (data.status !== false) {
                                            window.location.replace('/');
                                        } else {
                                            setTimeout(function () {
                                                $('.form-group p.error-hide').show();
                                            }, 100);
                                        }
                                    }
                                });
                                return false;
                            });
                        </script>
                    </div>
                </div>
            </li>
        </ul>
    </li>
</ul>