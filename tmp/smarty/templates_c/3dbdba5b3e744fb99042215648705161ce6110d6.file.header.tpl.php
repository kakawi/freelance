<?php /* Smarty version Smarty-3.1.6, created on 2015-03-15 20:42:13
         compiled from "../views/default/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57812118054f8c2a989cf70-49015803%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3dbdba5b3e744fb99042215648705161ce6110d6' => 
    array (
      0 => '../views/default/header.tpl',
      1 => 1426360887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57812118054f8c2a989cf70-49015803',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f8c2a9a7584',
  'variables' => 
  array (
    'article_description' => 0,
    'templateWebPath' => 0,
    'ss_sitename' => 0,
    'allCategories' => 0,
    'category' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f8c2a9a7584')) {function content_54f8c2a9a7584($_smarty_tpl) {?><!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
<?php if (isset($_smarty_tpl->tpl_vars['article_description']->value)){?>
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['article_description']->value;?>
" />
<?php }?>

    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/articles.css" />
	<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/js/articles.js"></script>
	<script type="text/javascript" src="/js/handlebars-v3.0.0.js"></script>
    <title><?php echo $_smarty_tpl->tpl_vars['ss_sitename']->value;?>
</title>
    <!--[if lt IE 9]><!--<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>--><![endif]-->
</head>

<body>
<div id="wrap">
<div id="sidebar">
    <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['allCategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
        <a href="/category/get/<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
</a>
    <?php } ?>
</div>

<?php }} ?>