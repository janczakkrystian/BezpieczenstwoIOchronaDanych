<?php
/* Smarty version 3.1.32, created on 2018-05-13 12:12:07
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\regForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5af80f774d5012_58536029',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4854a8999e3fc677c3efb76feecfafd8a16a1656' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\regForm.html.php',
      1 => 1526206325,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af80f774d5012_58536029 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11504212765af80f774cd312_33788840', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_11504212765af80f774cd312_33788840 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_11504212765af80f774cd312_33788840',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col">
    <form  id="regForm" class="centered-form" action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=User&action=register" method="POST">
        <legend class="text-center text-info">Zarejestruj się</legend>
        <div class="form-group">
            <label for="FirstName">Imie</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Imie" required>
        </div>
        <div class="form-group">
            <label for="LastName">Nazwisko</label>
            <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Nazwisko" required>
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="Login">Login</label>
            <input type="text" class="form-control" id="Login" name="Login" placeholder="Login" required>
        </div>
        <div class="form-group">
            <label for="Password">Hasło</label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder="Hasło" required>
        </div>
        <div class="form-group">
            <label for="PasswordAgain">Powtórz hasło</label>
            <input type="password" class="form-control" id="PasswordAgain" name="PasswordAgain" placeholder="Powtórz hasło" required>
        </div>
		<div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LfuYFYUAAAAAOvlwQY1BoE-9S2DlrLEAn0k1nZZ"></div>
        </div>
		<div class="form-group">
           <button type="submit" class="btn btn-success">Zarejestruj</button>
        </div>
        
        
    </form>
    <span><a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
">Jeśli masz już konto, zaloguj się!</a></span>
</div>
<?php
}
}
/* {/block "body"} */
}
