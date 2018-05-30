<?php
/* Smarty version 3.1.32, created on 2018-05-13 12:10:29
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\logForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5af80f15c93204_02222701',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95782588d9350cfe293f7c6d41f54418f86559b6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\logForm.html.php',
      1 => 1526206228,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af80f15c93204_02222701 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9923970285af80f15c7f985_29958772', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_9923970285af80f15c7f985_29958772 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_9923970285af80f15c7f985_29958772',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class = "col-lg-12 col-md-12">
<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
    <form id="logForm" class="centered-form" action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=Verification&action=verificationForm" method="POST">
        <legend class="text-center text-info">Zaloguj się</legend>
        <div class="form-group">
            <label for="Login">Login</label>
            <input type="text" class="form-control" id="Login" name="Login" placeholder="Login" required="required"/>
        </div>
        <div class="form-group">
            <label for="Password">Hasło</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Hasło" required="required"/>
        </div>
        
		<div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LfuYFYUAAAAAOvlwQY1BoE-9S2DlrLEAn0k1nZZ"></div>
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-success">Zaloguj</button>
        </div>
        
    </form>
    <span><a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=User&action=regForm">Jeśli nie masz konta, zarejestruj się!</a></span>
</div>
</div>
<?php
}
}
/* {/block "body"} */
}
