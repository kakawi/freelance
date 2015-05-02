<?php /* Smarty version Smarty-3.1.6, created on 2015-03-06 01:58:00
         compiled from "../views/default/page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:97565185754f8c358b371c5-80823179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ce75e68c097caaedfda8f819801057369a76e21' => 
    array (
      0 => '../views/default/page.tpl',
      1 => 1412158339,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97565185754f8c358b371c5-80823179',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f8c358b67da',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f8c358b67da')) {function content_54f8c358b67da($_smarty_tpl) {?>                <div class="col_100 newsitem_col_100">
                    <div class="newsitem">
                        <h2 style="height: 30px;">
                            <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
</span>
                        </h2>
                	    <?php echo $_smarty_tpl->tpl_vars['page']->value['description'];?>

                    </div>
                </div><?php }} ?>