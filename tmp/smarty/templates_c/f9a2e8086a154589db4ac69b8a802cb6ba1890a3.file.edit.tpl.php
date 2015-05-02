<?php /* Smarty version Smarty-3.1.6, created on 2015-03-13 01:28:14
         compiled from "../views/admin/articles/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13101062405500a3dbcac261-56103159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9a2e8086a154589db4ac69b8a802cb6ba1890a3' => 
    array (
      0 => '../views/admin/articles/edit.tpl',
      1 => 1426192070,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13101062405500a3dbcac261-56103159',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5500a3dbd1eb5',
  'variables' => 
  array (
    'articles' => 0,
    'selectCategory' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5500a3dbd1eb5')) {function content_5500a3dbd1eb5($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/var/www/testovoe/library/Smarty/libs/plugins/function.html_options.php';
?>		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win">
					<h1>Редактировать статью</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('#edit_articles_window', 1); return false;" />
				</div>
				<div class="edit-raz" id="edit_articles_scroll2" style="max-height: 400px;">
					<form id="add_articles_form2" method="POST" action="action_item(<?php echo $_smarty_tpl->tpl_vars['articles']->value['id'];?>
, 'articles', 'update', '#add_articles_form2');">
						<input id="articles_title2" type="text" data-alias="title" placeholder="Название статьи" value="<?php echo $_smarty_tpl->tpl_vars['articles']->value['title'];?>
" />
                        <br>
                        <?php echo smarty_function_html_options(array('name'=>'category','options'=>$_smarty_tpl->tpl_vars['selectCategory']->value),$_smarty_tpl);?>

						<div style="height: 50px;"></div>
						<textarea id="news_description2" data-alias="description" placeholder="Содержание статьи"><?php echo $_smarty_tpl->tpl_vars['articles']->value['description'];?>
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
					<input type="button" class="accept" value="Изменить" OnClick="action_item(<?php echo $_smarty_tpl->tpl_vars['articles']->value['id'];?>
, 'articles', 'update', '#add_articles_form2'); return false;" />
					<input type="button" class="cancel" value="Отменить" OnClick="javascript:closeitem('#edit_articles_window', 1); return false;" />
				</div>
				<div style="width: 320px; margin-left: 34px; margin-top: -50px;">
				    <div class="msg success" id="updatearticles_success">Статья изменена!</div>
				    <div class="msg error" id="updatearticles_error">Неправильно заполнены поля формы!</div>
				</div>
			</div>		
		</div><?php }} ?>