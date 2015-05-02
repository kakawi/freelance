<?php /* Smarty version Smarty-3.1.6, created on 2015-03-15 20:34:43
         compiled from "../views/default/breadcrumbs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1404318557550333e15473b3-15868446%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d101b3a03e304db9999e3bdeba2950d85fb2e06' => 
    array (
      0 => '../views/default/breadcrumbs.tpl',
      1 => 1426433681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1404318557550333e15473b3-15868446',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_550333e15749e',
  'variables' => 
  array (
    'article' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550333e15749e')) {function content_550333e15749e($_smarty_tpl) {?><div class="breadcrumbs">
    <a href="/">Главная</a> |
    <a href="/category/get/<?php echo $_smarty_tpl->tpl_vars['article']->value['category']['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['article']->value['category']['title'];?>
</a> |
    <a href="/article/get/<?php echo $_smarty_tpl->tpl_vars['article']->value['link'];?>
/"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</a>
</div><?php }} ?>