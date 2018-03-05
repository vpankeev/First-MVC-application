<!-- Fixed navbar -->
<div class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <!--                <span class="icon-bar"></span>-->
                <span class="glyphicon glyphicon-option-vertical"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo mb_strtoupper($this->get('site_name', 'default')); ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="active"><a href="/">Главная</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-keyboard-o" aria-hidden="true"></i> Список серверов <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Смертельный выстрел</a></li>
                        <li><a href="#">Смертельный прыжок</a></li>
                    </ul>
                </li>
            </ul>
        <?php
            $template = !empty(\core\Session::get('user')) ? 'auth/interface.php' : 'auth/login.php';
            echo $this->getGlobalTemplate($template);
        ?>
        </div><!--/.nav-collapse -->
    </div>
</div>