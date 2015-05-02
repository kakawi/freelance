<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="{$templateAdminWebPath}css/style.css" />
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
    <title>{$ss_sitename} | Раздел администратора | {$pageTitle}</title>
</head>
<body>
	<div id="del_item" class="window-1">
		<div class="window-bg">
			<div class="window">
				<div class="zaglav-win">
					<h2>Удалить {$pageTitle2}?</h2>
					<input type="button" class="close" OnClick="closeitem('#del_item', 0);" />
				</div>
				<div class="choose">
					<input type="button" class="accept" value="Удалить" OnClick="delete_item(0, 'none');"/>
					<input type="button" class="cancel" value="Отменить" OnClick="closeitem('#del_item', 0);" />
				</div>
			</div>
		</div>
	</div>
	
	{$addModalWindow}
	
	<div class="header-bg">
		<div class="header">
			<div class="header-left">
				<h1><a href="/" target="_blank">{$ss_sitename} <span style="color: #FF0000; background: #FFFFFF; padding: 5px;">{$sitelang}</span></a>Раздел администратора</h1>
			</div>
			<div class="header-right">
				<a id="open-user-menu" href="#" data-pos="0">
					<img src="{$userInfo.photo}" />
					<h2>Вы вошли как {$userInfo.name}</h2>
					<img src="{$templateAdminWebPath}images/arrow-sel.png" class="arrow-sel"/>
				</a>
				<div class="profile-window">
					<img src="{$templateAdminWebPath}images/arrow-top.png" class="arrow-top"/>
					<ul>
						<a href="/admin/settings/">
							<li>
								<img src="{$templateAdminWebPath}images/option.png" />
								<h3>Настройки</h3>
							</li>
						</a>
						<a href="/admin/profile/">
							<li>
								<img src="{$templateAdminWebPath}images/lichno.png" />
								<h3>Личные данные</h3>
							</li>
						</a>
						<a href="#" OnClick="exitPanel();return false;">
							<li>
								<img src="{$templateAdminWebPath}images/exit.png" />
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
                            <img src="{$templateAdminWebPath}images/arrow-act.png"/>
                        </li>
                    </a>
                    <a id="category" href="/admin/category/">
                        <li class="portfolio">
                            <div class="icon"></div>
                            <h2>Рубрики</h2>
                            <img src="{$templateAdminWebPath}images/arrow-act.png"/>
                        </li>
                    </a>
				</ul>
			</div>
			
			<div class="content-right">