<?php

/**
 * config.php
 * Конфигурационный файл сайта
 * 
 */

// Константы для обращения к контроллерам
define('PATH_PREFIX', '../controllers/');
define('PATH_POSTFIX', 'Controller.php');

//> Используемый шаблон
$template = 'default';
$templateAdmin = 'admin';

// Адрес сайта
define('SITEURL', $_SERVER['SERVER_NAME']);

// Временная зона сайта
date_default_timezone_set('Asia/Yekaterinburg');

// Пути к файлам шаблонов (.tpl)
define('TEMPLATE_PREFIX', "../views/{$template}/");
define('TEMPLATE_ADMIN_PREFIX', "../views/{$templateAdmin}/");
define('TEMPLATE_POSTFIX', '.tpl');

// Пути к файлам шаблонов в веб-пространстве
define('TEMPLATE_WEB_PATH', "/templates/{$template}/");
define('TEMPLATE_ADMIN_WEB_PATH', "/templates/{$templateAdmin}/");
//<

//> Инициализация Smarty
require '../library/Smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../library/Smarty/configs');

$smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);
$smarty->assign('siteurl', SITEURL);

//$smarty->clearAllCache();
//<

//> Список всех контроллеров для использования страницы ошибки 404
$allfiles = scandir('../controllers');
$i = 0;
foreach($allfiles AS $key => $val)
{
    if($val != '.' && $val != '..')
	{
	    $controllers[$i] = $val;
		$i++;
	};
}
//<