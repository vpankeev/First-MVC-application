<?php foreach ($this->get('privilege') as $privilege) {?>
<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $privilege['name'] ?></label>
    <div class="col-sm-4">
        <?php if (!empty($privilege['value'])) { ?>
            <select name="<?php echo $privilege['entity_id'] ?>" class="form-control select_privileges">
                <option value="0" selected>Нет</option>
                <option value="<?php echo $privilege['flags'] ?>">Да</option>
            </select>
        <?php } else { ?>
            <select name="<?php echo $privilege['entity_id'] ?>" class="form-control select_privileges">
                <option value="0" selected>Нет</option>
                <option value="<?php echo $privilege['flags'] ?>">Да</option>
            </select>
        <?php } ?>
    </div>
</div>
<div class='form-group collapse' id='day_<?php echo $privilege['entity_id'] ?>'>
    <label class='col-sm-2 control-label green'>Количество дней</label>
    <div class='col-sm-4'>
        <input type='text' class='form-control' name='day_<?php echo $privilege['entity_id'] ?>' value="0">
    </div>
</div>
<?php } if ($this->get('privilege')) { ?>
    <div class='form-group'>
        <label class='col-sm-2 control-label'>Контакты</label>
        <div class='col-sm-4'>
            <input type='text' class='form-control' name='contact' value="">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Активировать</label>
        <div class="col-sm-4">
            <select name="active" class="form-control">
                <option value="0" selected>Нет</option>
                <option value="1">Да</option>
            </select>
        </div>
    </div>
    <p class="text-success info"></p>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" class="btn btn-success btn-block">Добавить привилегию</button>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        <strong>Извините!</strong> Привилегии для данного сервера не найдены!
    </div>
    <script>
        $('#g_type').hide();
        $('#g_value').hide();
        $('#g_password').hide();
    </script>
<?php } ?>
<script>
    $('.select_privileges').change(function () {
        select      = $(this);
        value       = select.find('option:selected').val();
        title        = select.attr('name');
        input_day   = $('#day_' + name);

        if (value !== '0') {
            input_day.css('margin-bottom', '20px');
            input_day.css('margin-top', '-10px');
            input_day.show();
        } else {
            input_day.hide();
        }
    });
</script>