<?php /* Smarty version Smarty-3.1.6, created on 2015-03-15 20:29:57
         compiled from "../views/default/article.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149967092055032c169e93d4-33075734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f07aa1ae9d5a3cb5297471eb4359a859c20d2a1c' => 
    array (
      0 => '../views/default/article.tpl',
      1 => 1426433393,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149967092055032c169e93d4-33075734',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_55032c16a0bae',
  'variables' => 
  array (
    'article' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55032c16a0bae')) {function content_55032c16a0bae($_smarty_tpl) {?><div id="container">
    <article>
        <div class="title"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</div>

        <div class="description"><?php echo $_smarty_tpl->tpl_vars['article']->value['description'];?>
</div>
    </article>
</div>
<?php }} ?>