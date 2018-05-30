<?php
/* Smarty version 3.1.32, created on 2018-05-06 14:11:47
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\changePasswordForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5aeef103604ee5_12496483',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '79d2b2281b91e7e20869c99b066981a6126d409f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\changePasswordForm.html.php',
      1 => 1525607985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aeef103604ee5_12496483 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10177968695aeef1035fe752_36905867', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_10177968695aeef1035fe752_36905867 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_10177968695aeef1035fe752_36905867',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
        <form id="changePasswordForm" class="centered-form" action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=Verification&action=verificationForm" method="POST">
            <legend class="text-center text-info">Zmiana hasła</legend>
            <div class="form-group">
                <label for="OldPassword">Stare hasło</label>
                <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Stare hasło" required="required"/>
            </div>
            <div class="form-group">
                <label for="NewPassword">Nowe hasło</label>
                <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="Nowe hasło" required="required"/>
            </div>
            <div class="form-group">
                <label for="NewPasswordAgain">Powtórz nowe hasło</label>
                <input type="password" class="form-control" id="NewPasswordAgain" name="NewPasswordAgain" placeholder="Powtórz nowe hasło" required="required"/>
            </div>
            <button type="submit" class="btn btn-success">Zmień hasło</button>
        </form>
    </div>
</div>
<?php
}
}
/* {/block "body"} */
}
