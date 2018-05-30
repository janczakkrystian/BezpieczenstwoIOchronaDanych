<?php
/* Smarty version 3.1.32, created on 2018-05-06 14:05:45
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\navigation.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5aeeef99733907_19706263',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b49471568697f017be38efd1ffb1aea89764552' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\navigation.html.php',
      1 => 1525607985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aeeef99733907_19706263 (Smarty_Internal_Template $_smarty_tpl) {
?><nav class="navbar navbar-inverse navbar-fixed-top">
    <div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
">Portfel</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right logowanie">
                <?php if (isset($_SESSION['user'])) {?>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown">Hasła : <?php echo $_SESSION['user'];?>

                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=Accounts&action=addform">Dodaj Hasło</a></li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown">Login: <?php echo $_SESSION['user'];?>

                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=User&action=changePasswordForm">Zmień hasło</a></li>
                        <li><a href="#">Zapisane logi</a></li>
                    </ul>
                </li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=User&action=logout">Wyloguj się</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav><?php }
}
