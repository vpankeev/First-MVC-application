<div class="container">
    <div class="page-header">
        <h1 class="green">Вы успешно зарегистрировались!</h1>
    </div>
    <p class="lead">Вы можете войти в свой личный кабинет, воспользовавшись данными, которые вы ввели при регистрации.</p>
    <p class="lead"><i>Пожалуйста, запишите данные для входа! Если вы забудете пароль, то восстановить его вы не сможете!</i></p>
    <?php if (!empty($_POST['username']) && !empty($_POST['password'])) { ?>
        <table class="table table-responsive table-small">
            <tr>
                <td>Логин</td>
                <td><?php echo htmlspecialchars($_POST['username']); ?></td>
            </tr>
            <tr>
                <td>Пароль</td>
                <td><?php echo htmlspecialchars($_POST['password']); ?></td>
            </tr>
        </table>
    <?php } ?>
</div>
