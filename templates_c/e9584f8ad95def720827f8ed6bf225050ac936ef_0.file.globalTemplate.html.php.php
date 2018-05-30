<?php
/* Smarty version 3.1.32, created on 2018-05-06 14:05:45
  from 'C:\xampp\htdocs\BezpieczenstwoIOchronaDanych-master\templates\globalTemplate.html.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5aeeef996037e1_95916397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9584f8ad95def720827f8ed6bf225050ac936ef' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BezpieczenstwoIOchronaDanych-master\\templates\\globalTemplate.html.php',
      1 => 1525607985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/header.html.php' => 1,
    'file:templates/navigation.html.php' => 1,
    'file:templates/messages.html.php' => 1,
    'file:templates/footer.html.php' => 1,
  ),
),false)) {
function content_5aeeef996037e1_95916397 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:templates/header.html.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:templates/navigation.html.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7413338605aeeef996024e0_67597244', "body");
?>

<?php $_smarty_tpl->_subTemplateRender("file:templates/messages.html.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:templates/footer.html.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block "body"} */
class Block_7413338605aeeef996024e0_67597244 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'body' => 
  array (
    0 => 'Block_7413338605aeeef996024e0_67597244',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "body"} */
}
