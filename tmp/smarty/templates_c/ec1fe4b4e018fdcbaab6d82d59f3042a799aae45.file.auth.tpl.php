<?php /* Smarty version Smarty-3.1.6, created on 2015-03-07 00:02:47
         compiled from "../views/admin/auth.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151190016654f9f9d7e17416-56132489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec1fe4b4e018fdcbaab6d82d59f3042a799aae45' => 
    array (
      0 => '../views/admin/auth.tpl',
      1 => 1411581972,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151190016654f9f9d7e17416-56132489',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templateAdminWebPath' => 0,
    'ss_sitename' => 0,
    'pageTitle' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f9f9d7ed31f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9f9d7ed31f')) {function content_54f9f9d7ed31f($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="display: none;">
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
css/style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="robots" content="noindex,nofollow" />
    <title><?php echo $_smarty_tpl->tpl_vars['ss_sitename']->value;?>
 | Раздел администратора | <?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
</head>
<body style="display: none;">
	<div class="karkas-min-bg">
		<div class="karkas-min">
			<h1>Раздел администратора</br>
			<a href="/" target="_blank">© <?php echo $_smarty_tpl->tpl_vars['ss_sitename']->value;?>
</h1></a>
			<div class="autorizatsia">
				<div class="zaglav-auto">
					<img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/wait.png" />
					<h2>Пожалуйста, введите свои данные</h2>
				</div>
				<div class="auto-in">
					<form method="POST" action="javascript:auth();">
						<div class="form">
							<input id="login" type="text" placeholder="Логин"/>
							<img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/login.png" />
						</div>
						<div class="form">
							<input id="password" type="password" placeholder="Пароль"/>
							<img src="<?php echo $_smarty_tpl->tpl_vars['templateAdminWebPath']->value;?>
images/pass.png" />
						</div>
						<input type="submit" class="enter" value=""/>
					</form>
				</div>
				<div style="margin-top: 60px;">
				    <div class="msg success" id="login_success">Добро пожаловать!</div>
				    <div class="msg error" id="login_error">Неправильный логин или пароль!</div>
				</div>
			</div>
		</div>
	</div>
    <script src="/js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/admin/main.js"></script>
	<script type="text/javascript" src="/js/admin/functions.js"></script>
	<script>$('html, body').fadeIn(250);</script>
</body>
</html><?php }} ?>