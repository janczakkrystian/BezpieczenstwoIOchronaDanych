<?php
/* Smarty version 3.1.32, created on 2018-05-06 15:04:32
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\verificationForm.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5aeefd605b7b51_37145972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0f836206e5d4620a8eedc2780d4291a1238e7f1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\verificationForm.html.php',
      1 => 1525607985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aeefd605b7b51_37145972 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12451914695aeefd605ad7a7_53577071', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_12451914695aeefd605ad7a7_53577071 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_12451914695aeefd605ad7a7_53577071',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">
        <form id="verificationForm" class="centered-form" action="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
?controller=Verification&action=verification" method="POST">
            <legend class="text-center text-info">Potwierdź czynność, wpisując KOD przesłany na email.</legend>
            <div class="form-group">
                <input id="IdUser" name="IdUser" required="required" type="hidden" value="<?php if (isset($_SESSION['idUser'])) {
echo $_SESSION['idUser'];
} elseif (isset($_smarty_tpl->tpl_vars['IdUser']->value)) {
echo $_smarty_tpl->tpl_vars['IdUser']->value;
}?>"/>
                <input type="number" class="form-control" id="Code" name="Code" required="required" placeholder="XXXXXXXXXX"/>
            </div>
            <button type="submit" class="btn btn-success">Potwierdź</button>
        </form>
        <span><a href="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
">Wróć</a></span>
    </div>
</div>
<?php
}
}
/* {/block "body"} */
}
