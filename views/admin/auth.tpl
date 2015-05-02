<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="display: none;">
<head>
    <link rel="stylesheet" type="text/css" href="{$templateAdminWebPath}css/style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="robots" content="noindex,nofollow" />
    <title>{$ss_sitename} | Раздел администратора | {$pageTitle}</title>
</head>
<body style="display: none;">
	<div class="karkas-min-bg">
		<div class="karkas-min">
			<h1>Раздел администратора</br>
			<a href="/" target="_blank">© {$ss_sitename}</h1></a>
			<div class="autorizatsia">
				<div class="zaglav-auto">
					<img src="{$templateAdminWebPath}images/wait.png" />
					<h2>Пожалуйста, введите свои данные</h2>
				</div>
				<div class="auto-in">
					<form method="POST" action="javascript:auth();">
						<div class="form">
							<input id="login" type="text" placeholder="Логин"/>
							<img src="{$templateAdminWebPath}images/login.png" />
						</div>
						<div class="form">
							<input id="password" type="password" placeholder="Пароль"/>
							<img src="{$templateAdminWebPath}images/pass.png" />
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
</html>