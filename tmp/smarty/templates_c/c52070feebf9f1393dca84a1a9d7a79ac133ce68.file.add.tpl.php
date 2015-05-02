<?php /* Smarty version Smarty-3.1.6, created on 2015-03-13 01:17:00
         compiled from "../views/admin/articles/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13319731825501e5eba76a58-26145506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c52070feebf9f1393dca84a1a9d7a79ac133ce68' => 
    array (
      0 => '../views/admin/articles/add.tpl',
      1 => 1426191351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13319731825501e5eba76a58-26145506',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5501e5ebb21f3',
  'variables' => 
  array (
    'selectCategory' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5501e5ebb21f3')) {function content_5501e5ebb21f3($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/var/www/testovoe/library/Smarty/libs/plugins/function.html_options.php';
?>	<div id="add_articles_window" class="window-2">
		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win">
					<h1>Добавить статью</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('#add_articles_window', 1); return false;" />
				</div>
				<div class="edit-raz" id="edit_articles_scroll" style="max-height: 400px;">
					<form id="add_articles_form" method="POST" action="action_item(0, 'articles', 'add', '#add_articles_form');">
						<input id="articles_title" type="text" data-alias="title" placeholder="Название статьи" />
                        <br>
                            <?php echo smarty_function_html_options(array('name'=>'category','options'=>$_smarty_tpl->tpl_vars['selectCategory']->value),$_smarty_tpl);?>

						<div style="height: 50px;"></div>
						<textarea id="articles_description" data-alias="description" placeholder="Содержание статьи">Введите текст</textarea>
						<script>
						    CKEDITOR.replace('articles_description');
						</script>
					</form>
					<form class="hide_file_form" id="add_articles_file" enctype="multipart/form-data" method="post">
					    <input id="add_articles_tp_file" type="file" name="file" accept="image/*,image/jpeg" />
					    <input type="submit" class="submit" value="Загрузить!" />
					</form>
					<br />
				</div>	
				<div class="choose">
					<input type="button" class="accept" value="Добавить" OnClick="action_item(0, 'articles', 'add', '#add_articles_form'); return false;" />
					<input type="button" class="cancel" value="Отменить" OnClick="javascript:closeitem('#add_articles_window', 1); return false;" />
				</div>
				<div style="width: 320px; margin-left: 34px; margin-top: -50px;">
				    <div class="msg success" id="addarticles_success">Статья добавлена!</div>
				    <div class="msg error" id="addarticles_error">Неправильно заполнены поля формы!</div>
				</div>
			</div>		
		</div>
	</div>
    <div id="edit_articles_window" class="window-2">
	</div><?php }} ?>