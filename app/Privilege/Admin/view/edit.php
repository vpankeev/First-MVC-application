<div class='container-fluid'>
    <div class='row'>
        <?php $this->getGlobalTemplate('admin_menu.php'); ?>
        <div class='col-sm-9 col-sm-offset-3 col-md-offset-2 col-md-10 main'>
            <h1 class='page-header green'>Управление привилегиями</h1>
            <div class='content'>
                <?php foreach ($this->get('privileges') as $server) { ?>
                    <h3 class="text-center"><?php echo $server[0]['serverName']; ?></h3>
                    <?php foreach ($server as $privilege) { ?>
                        <p><?php echo $privilege['name']; ?></p>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


