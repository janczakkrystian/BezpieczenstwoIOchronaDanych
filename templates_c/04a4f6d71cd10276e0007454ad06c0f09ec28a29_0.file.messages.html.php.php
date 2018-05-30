<?php
/* Smarty version 3.1.32, created on 2018-05-06 14:05:45
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\messages.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5aeeef997a9400_45409824',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04a4f6d71cd10276e0007454ad06c0f09ec28a29' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\messages.html.php',
      1 => 1525607985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aeeef997a9400_45409824 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
    <div class="text-center alert alert-danger messages" role="alert">
        <strong><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</strong>
    </div>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
    <div class="text-center alert alert-info messages" role="alert">
        <strong><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</strong>
    </div>
<?php }
}
}
