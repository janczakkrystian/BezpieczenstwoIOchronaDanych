<?php
/* Smarty version 3.1.32, created on 2018-05-13 11:55:25
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\AccountAddForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5af80b8d14d642_15561882',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b21f14e170036f633989fa8d53e3ca32dc29e69' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\AccountAddForm.html.php',
      1 => 1526205309,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af80b8d14d642_15561882 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21134606825af80b8d13dc43_00426970', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_21134606825af80b8d13dc43_00426970 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_21134606825af80b8d13dc43_00426970',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\vendor\\smarty\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>


<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">

        <form action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=Accounts&action=add" id="formularz" method="post">
            <legend class="text-center text-info">Dodaj hasło</legend>


            <div class="form-group">
                <label for="Login">Wybór Serwisu Internetowego</label>
                <?php echo smarty_function_html_options(array('class'=>"form-control",'name'=>"IdAccountDictionary",'options'=>$_smarty_tpl->tpl_vars['listAccount']->value),$_smarty_tpl);?>

            </div>

            <div class="form-group">
                <label for="Login">Login</label>
                <input type="text" class="form-control" name="Login" id="Login"  placeholder="Podaj Login Do Serwisu" required="required"/>
            </div>

            <div class="form-group">
                <label for="Password">Hasło</label>
                <input type="text" class="form-control" name="Password" id="Password" placeholder="Podaj Hasło Do Serwisu" required="required"/>
            </div>
			
			<input type="hidden" name="userId" value="<?php echo $_SESSION['idUser'];?>
"/>
			
            <button type="submit" class="btn btn-success">Dodaj</button>
        </form>
    </div>
</div>
<?php
}
}
/* {/block "body"} */
}
