<div class='container-fluid'>
    <div class='row'>
        <?php $this->getGlobalTemplate('admin_menu.php'); ?>
        <div class='col-sm-9 col-sm-offset-3 col-md-offset-2 col-md-10 main'>
            <h1 class='page-header green'>Выполнение команд</h1>
            <div class="alert alert-danger">
                <strong>Внимание! </strong>Это страница, на которой можно отправить любую команду на удалённый сервер.
            </div>
            <div class='content'>
                <form id="form_privilege" class='form-horizontal' action='' method='post'>
                    <div class="form-group">
                        <label for="command" class="col-sm-2 control-label">Введите команду:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inp_command" placeholder="pwd">
                        </div>
                        <button type="button" id="execute" class="btn btn-danger">Отправить</button>
                    </div>
                </form>
                <pre style="background: transparent;border:none;">
                    <div class="alert alert-info info_command">Здесь будет выведена информация об отправке комманды.</div>
                </pre>
            </div>
        </div>
    </div>
</div>
<script>
    $('#execute').click(function(){
        command  = $('#inp_command').val();
        info_field = $('.info_command');

        $.ajax({
            url: '/<?php echo $this->get('admin_route');?>/command/send/',
            type: 'POST',
            data: {
                'command' : command
            },
            success: function (data) {
                info_field.html(data);
            }
        });
    });
</script>

