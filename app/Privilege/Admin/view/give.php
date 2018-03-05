<div class='container-fluid'>
    <div class='row'>
        <?php $this->getGlobalTemplate('admin_menu.php'); ?>
        <div class='col-sm-9 col-sm-offset-3 col-md-offset-2 col-md-10 main'>
            <h1 class='page-header green'>Выдача привилегий</h1>
            <div class='content'>
                <form id="form_privilege" class='form-horizontal' action='' method='post'>
                    <div class='form-group'>
                        <label for='forRole' class='col-sm-2 control-label'>Выберите сервер:</label>
                        <div class='col-sm-4'>
                            <select id='getPrivilege' name="server" class='form-control'>
                                <option selected></option>
                                <?php foreach ($this->get('server') as $k => $v) {?>
                                    <option value='<?php echo $k; ?>'><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div id='g_type' class='form-group collapse'>
                        <label class='col-sm-2 control-label'>Выберите тип:</label>
                        <div class='col-sm-4'>
                            <select name="type" class='form-control'>
                                <option value='0' selected></option>
                                <option value='ca'>Steam ID + пароль</option>
                                <option value='ce'>Steam ID</option>
                                <option value='da'>IP + пароль</option>
                                <option value='de'>IP</option>
                                <option value='a'>Ник + пароль</option>
                                <option value='ae'>Ник</option>
                            </select>
                        </div>
                    </div>
                    <div id='g_value' class='form-group collapse'>
                        <label class='col-sm-2 control-label'>Значение</label>
                        <div class='col-sm-4'>
                            <input type='text' class='form-control' name='value'>
                        </div>
                    </div>
                    <div id='g_password' class='form-group collapse'>
                        <label class='col-sm-2 control-label'>Пароль</label>
                        <div class='col-sm-4'>
                            <input type='text' class='form-control' name='password'>
                        </div>
                    </div>
                    <br/>
                    <div id='load'></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#getPrivilege').change(function () {
        var server_id = $('#getPrivilege').find('option:selected').val();

        if (server_id > 0) {
            showItems();
        } else {
            hideItems();
        }
        getContent();
    });

    $('#g_type').change(function () {
        showItems();
    });

    function hideItems(){
        $('#g_type').hide();
        $('#g_value').hide();
        $('#g_password').hide();
    }

    function showItems()
    {
        var server_id   = $('#getPrivilege').find('option:selected').val();
        var type        = $('#g_type').find('option:selected').val();
        var value       = $('#g_value');
        var placeholder = null;

        if (server_id > 0) {
            $('#g_type').show();
        }
        if (type !== '0') {
            value.show();
            if (type.indexOf('e') === -1) {
                $('#g_password').show();
            } else {
                $('input[name=password]').val('');
                $('#g_password').hide();

            }
        } else {
            value.hide();
            $('#g_password').hide();
        }

        if (type.charAt(0) === 'c') {
            placeholder = 'STEAM_0:0:123456';
        } else if (type.charAt(0) === 'd') {
            placeholder = '127.0.0.1';
        } else if (type.charAt(0) === 'a') {
            placeholder = 'Nickname';
        }

        value.find('input').attr('placeholder', placeholder);
    }

    function getContent()
    {
        var server_id = $('#getPrivilege').find('option:selected').val();
        $.ajax({
            url: '/<?php echo $this->get('admin_route');?>/privilege/getPrivileges/',
            type: 'POST',
            data: {
                'id' : server_id
            },
            success: function (data) {
                $('#load').empty();
                $('#load').append(data);
            }
        });
    }
    
    $('#form_privilege').submit(function(e) {
        var url = '/<?php echo $this->get('admin_route');?>/privilege/Set/';

        $.ajax({
            type: 'POST',
            url: url,
            data: $('#form_privilege').serialize(),
            beforeSend : function () {
                $('.info').empty();
            },
            success: function(data) {
                $('.info').append(data);
            }
        });
        e.preventDefault();
    });
</script>

