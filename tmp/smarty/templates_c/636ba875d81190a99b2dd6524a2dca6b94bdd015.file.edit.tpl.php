<?php /* Smarty version Smarty-3.1.6, created on 2015-03-07 00:05:08
         compiled from "../views/admin/news/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65963990254f9fa64e476a4-71915420%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '636ba875d81190a99b2dd6524a2dca6b94bdd015' => 
    array (
      0 => '../views/admin/news/edit.tpl',
      1 => 1412157310,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65963990254f9fa64e476a4-71915420',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'news' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f9fa64eac05',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9fa64eac05')) {function content_54f9fa64eac05($_smarty_tpl) {?>		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win">
					<h1>Редактировать новость</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('#edit_news_window', 1); return false;" />
				</div>
				<div class="edit-raz" id="edit_news_scroll2" style="max-height: 400px;">
					<form id="add_news_form2" method="POST" action="action_item(<?php echo $_smarty_tpl->tpl_vars['news']->value['id'];?>
, 'news', 'update', '#add_news_form2');">
						<input id="news_title2" type="text" data-alias="title" placeholder="Название новости" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
" />
						<input id="news_hide_input_file2" data-alias="poster" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['poster'];?>
" />
						<br />
						<br />
						<div class="filestatus" style="padding-top: 5px; padding-bottom: 5px;">
                            <div class="choosen-file">
							    <div class="file">
								    <img src="/templates/admin/images/choosen-file.png" />
									<h3><?php echo $_smarty_tpl->tpl_vars['news']->value['poster'];?>
</h3>
									<input type="button" value="Заменить" OnClick="upload_file(2, '#add_news_tp_file2', 'add_news_file2', 'news'); return false;" />
								</div>
								<input type="button" class="del-file" OnClick="del_file('<?php echo $_smarty_tpl->tpl_vars['news']->value['poster'];?>
', 'news', 2);return false;" />
							</div>
						</div>
						<div style="height: 50px;"></div>
						<textarea id="news_description2" data-alias="description" placeholder="Содержание новости"><?php echo $_smarty_tpl->tpl_vars['news']->value['description'];?>
</textarea>
						<script>
						    CKEDITOR.replace('news_description2');
                            $("#edit_news_scroll2").mCustomScrollbar({
                                theme:"dark"
                            });
						</script>
					</form>
					<form class="hide_file_form" id="add_news_file2" enctype="multipart/form-data" method="post">
					    <input id="add_news_tp_file2" type="file" name="file" accept="image/*,image/jpeg" />
					    <input type="submit" class="submit" value="Загрузить!" />
					</form>
					<br />
				</div>	
				<div class="choose">
					<input type="button" class="accept" value="Изменить" OnClick="action_item(<?php echo $_smarty_tpl->tpl_vars['news']->value['id'];?>
, 'news', 'update', '#add_news_form2'); return false;" />
					<input type="button" class="cancel" value="Отменить" OnClick="javascript:closeitem('#edit_news_window', 1); return false;" />
				</div>
				<div style="width: 320px; margin-left: 34px; margin-top: -50px;">
				    <div class="msg success" id="updatenews_success">Новость изменена!</div>
				    <div class="msg error" id="updatenews_error">Неправильно заполнены поля формы!</div>
				</div>
			</div>		
		</div><?php }} ?>