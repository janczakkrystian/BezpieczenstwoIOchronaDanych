<?php
/* Smarty version 3.1.32, created on 2018-05-07 23:03:00
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\AccountEditForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5af0bf0478cc86_01202244',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4fa72e0090ce05a4c8c3b00a9f097833f6404414' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\AccountEditForm.html.php',
      1 => 1525726961,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af0bf0478cc86_01202244 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20785470545af0bf04787467_98799561', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_20785470545af0bf04787467_98799561 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_20785470545af0bf04787467_98799561',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="panel-heading">
    <div class="panel-title text-center">
        <h1 class="title">Zmiana Danych</h1>
    </div>
    <form action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=Accounts&action=update" id="formularz" method="post">

        <div class="main-login main-center">

            <div class="form-group">
                <div class="cols-sm-10">
                    <div class="form-group">
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="IdAccount" id="IdAccount" value="<?php echo $_smarty_tpl->tpl_vars['IdAccount']->value;?>
"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="IdAccountDictionary" id="IdAccountDictionary" value="<?php echo $_smarty_tpl->tpl_vars['IdAccountDictionary']->value;?>
"/>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="Login" class="cols-sm-2 control-label">Login</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="Login" id="Login"  placeholder="Wprowadz Nowy Login" value="<?php echo $_smarty_tpl->tpl_vars['Login']->value;?>
"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Password" class="cols-sm-2 control-label">Hasło</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-flask" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="Password" id="Password" placeholder="Wprowadz Nowe Hasło" value="<?php echo $_smarty_tpl->tpl_vars['Password']->value;?>
"/>
                            </div>
                        </div>
                    </div>

            <div class="form-group ">
                <button type="sumbit"  class="btn btn-success btn-lg btn-block login-button">Zapisz Nowe Dane</button>
            </div>


        </div>

    </form>
</div>






<?php
}
}
/* {/block "body"} */
}
