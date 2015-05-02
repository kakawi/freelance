<?php /* Smarty version Smarty-3.1.6, created on 2015-03-14 23:51:23
         compiled from "../views/admin/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:176914934254f9f9d327d459-40203006%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8777564b54c99a12dc7572e8e460517df77a3465' => 
    array (
      0 => '../views/admin/header.tpl',
      1 => 1426359080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176914934254f9f9d327d459-40203006',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f9f9d355551',
  'variables' => 
  array (
    'templateAdminWebPath' => 0,
    'ss_sitename' => 0,
    'pageTitle' => 0,
    'pageTitle2' => 0,
    'addModalWindow' => 0,
    'sitelang' => 0,
    'userInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9f9d355551')) {function content_54f9f9d355551($_smarty_tpl) {?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
css/style.css" />
	<link rel="stylesheet" href="/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css" />
    <link rel="stylesheet" href="/js/bgrins-spectrum-3926bd0/spectrum.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1" />
	<meta name="robots" content="noindex,nofollow" />
	<script type="text/javascript" src="/js/scriptjava.js"></script>
	<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="/js/admin/functions.js"></script>
	<script type="text/javascript" src="/js/admin/main.js"></script>
    <script src="/js/bgrins-spectrum-3926bd0/spectrum.js"></script>
	<script src="/js/jquery.animate-colors-min.js"></script>
    <title><?php echo $_smarty_tpl->tpl_vars['ss_sitename']->value;?>
 | Раздел администратора | <?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
</head>
<body>
	<div id="del_item" class="window-1">
		<div class="window-bg">
			<div class="window">
				<div class="zaglav-win">
					<h2>Удалить <?php echo $_smarty_tpl->tpl_vars['pageTitle2']->value;?>
?</h2>
					<input type="button" class="close" OnClick="closeitem('#del_item', 0);" />
				</div>
				<div class="choose">
					<input type="button" class="accept" value="Удалить" OnClick="delete_item(0, 'none');"/>
					<input type="button" class="cancel" value="Отменить" OnClick="closeitem('#del_item', 0);" />
				</div>
			</div>
		</div>
	</div>
	
	<?php echo $_smarty_tpl->tpl_vars['addModalWindow']->value;?>

	
	<div class="header-bg">
		<div class="header">
			<div class="header-left">
				<h1><a href="/" target="_blank"><?php echo $_smarty_tpl->tpl_vars['ss_sitename']->value;?>
 <span style="color: #FF0000; background: #FFFFFF; padding: 5px;"><?php echo $_smarty_tpl->tpl_vars['sitelang']->value;?>
</span></a>Раздел администратора</h1>
			</div>
			<div class="header-right">
				<a id="open-user-menu" href="#" data-pos="0">
					<img src="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['photo'];?>
" />
					<h2>Вы вошли как <?php echo $_smarty_tpl->tpl_vars['userInfo']->value['name'];?>
</h2>
					<img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/arrow-sel.png" class="arrow-sel"/>
				</a>
				<div class="profile-window">
					<img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/arrow-top.png" class="arrow-top"/>
					<ul>
						<a href="/admin/settings/">
							<li>
								<img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/option.png" />
								<h3>Настройки</h3>
							</li>
						</a>
						<a href="/admin/profile/">
							<li>
								<img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/lichno.png" />
								<h3>Личные данные</h3>
							</li>
						</a>
						<a href="#" OnClick="exitPanel();return false;">
							<li>
								<img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/exit.png" />
								<h3>Выход</h3>
							</li>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="karkas">
		<div class="content">
			<div class="content-left">
				<ul>
                    <a id="articles" href="/admin/articles/">
                        <li class="portfolio">
                            <div class="icon"></div>
                            <h2>Статьи</h2>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/arrow-act.png"/>
                        </li>
                    </a>
                    <a id="category" href="/admin/category/">
                        <li class="portfolio">
                            <div class="icon"></div>
                            <h2>Рубрики</h2>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/arrow-act.png"/>
                        </li>
                    </a>
				</ul>
			</div>
			
			<div class="content-right"><?php }} ?>