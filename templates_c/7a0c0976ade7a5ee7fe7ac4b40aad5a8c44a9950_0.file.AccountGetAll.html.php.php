<?php
/* Smarty version 3.1.32, created on 2018-05-13 12:01:12
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\AccountGetAll.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5af80ce8275b08_02382555',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a0c0976ade7a5ee7fe7ac4b40aad5a8c44a9950' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\AccountGetAll.html.php',
      1 => 1526205671,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5af80ce8275b08_02382555 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17786117535af80ce825e400_75621941', "body");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "templates/globalTemplate.html.php");
}
/* {block "body"} */
class Block_17786117535af80ce825e400_75621941 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_17786117535af80ce825e400_75621941',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="panel-heading">
        <div class="panel-title text-center">
            <h1 class="title">Hasła</h1>
        </div>
		<?php if (count($_smarty_tpl->tpl_vars['accounts']->value) === 0) {?>
			<div class="alert alert-danger" role="alert">Brak haseł w bazie, dodaj hasła!</div>
		<?php } else { ?>
        <div class="row">
			<div>
		
			<ul class="socialIcons">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['accountsdictionaries']->value, 'accountsdictionary', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['accountsdictionary']->value) {
?>
				
				<li data-path="http://<?php echo $_SERVER['HTTP_HOST'];
echo $_smarty_tpl->tpl_vars['subdir']->value;?>
index.php?controller=Accounts&action=getByName&id=" class="<?php echo $_smarty_tpl->tpl_vars['accountsdictionary']->value['Name'];?>
"><a class="#" data-toggle="modal" data-target=".modal"><i class="fa fa-fw fa-<?php echo $_smarty_tpl->tpl_vars['accountsdictionary']->value['Name'];?>
"></i><?php echo $_smarty_tpl->tpl_vars['accountsdictionary']->value['Name'];?>
</a></li>
				
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				
			</ul>
			<?php }?>
			</div>
		</div>
		
        <div class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Login</th>
                                    <th>Hasło</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
			
    </div>
<?php
}
}
/* {/block "body"} */
}
