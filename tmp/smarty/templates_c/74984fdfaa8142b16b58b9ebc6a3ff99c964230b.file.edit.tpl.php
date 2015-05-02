<?php /* Smarty version Smarty-3.1.6, created on 2015-03-15 02:02:06
         compiled from "../views/admin/category/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20980144025504a09bcbf8f9-47701910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74984fdfaa8142b16b58b9ebc6a3ff99c964230b' => 
    array (
      0 => '../views/admin/category/edit.tpl',
      1 => 1426366758,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20980144025504a09bcbf8f9-47701910',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5504a09bdc494',
  'variables' => 
  array (
    'category' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5504a09bdc494')) {function content_5504a09bdc494($_smarty_tpl) {?>		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win">
					<h1>Редактировать рубрику</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('#edit_category_window', 1); return false;" />
				</div>
				<div class="edit-raz" id="edit_category_scroll2" style="max-height: 400px;">
					<form id="add_category_form2" method="POST" action="action_item(<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
, 'category', 'update', '#add_category_form2');">
						<input id="category_title2" type="text" data-alias="title" placeholder="Название статьи" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
" />
					</form>
				</div>	
				<div class="choose">
					<input type="button" class="accept" value="Изменить" OnClick="action_item(<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
, 'category', 'update', '#add_category_form2'); return false;" />
					<input type="button" class="cancel" value="Отменить" OnClick="javascript:closeitem('#edit_category_window', 1); return false;" />
				</div>
				<div style="width: 320px; margin-left: 34px; margin-top: -50px;">
				    <div class="msg success" id="updatecategory_success">Рубрика изменена!</div>
				    <div class="msg error" id="updatecategory_error">Неправильно заполнены поля формы!</div>
				</div>
			</div>		
		</div><?php }} ?>