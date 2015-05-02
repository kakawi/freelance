<?php

/**
 * IndexController.php
 *  
 * Контроллер главной страницы сайта
 * 
 */

require_once '../models/IndexModel.php';

// Переопределение настроек для Smarty
$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);

/**
 * Формирование главной страницы
 * 
 * @param object $smarty Объект шаблонизатора
 */
function indexAction($smarty) {
	echo '<script>document.location.href="/articles/";</script>';
}

/**
 * Формирование кастомной страницы
 * 
 * @param object $smarty Объект шаблонизатора
 */
function custompageAction($smarty) {
	if(count($_GET) > 1) echo '<script>document.location.href="/news/1/";</script>';
	$smarty->assign('sections', site_sections());
	$smarty->assign('current', sip($_GET['controller']));
	$page = sa("pages", sip($_GET['controller']), "link");
	if($page == 'error')  echo '<script>document.location.href="/error/";</script>';
	$smarty->assign('page', $page);
	$smarty->assign('metadescription', 'страница '.$page['title'].'.');
	$smarty->assign('metakeywords', $page['title']);
	loadTemplate($smarty, 'header');
	loadTemplate($smarty, 'page');
	loadTemplate($smarty, 'footer');
}

/**
 * Формирование AJAX-обработчика форм
 * 
 * @param object $smarty Объект шаблонизатора
 */
function ajaxAction($smarty) {
	if(!empty($_POST))
	{
	    foreach($_POST as $key => $val)
		{
		    $data[$key] = sip($val);
		}
		(($data['type'] == 'requests' && $data['action'] == 'add') || ($data['type'] == 'support' && $data['action'] == 'add')) ? $it = doajax($data) : $it = 'fuckyou';
		if(trim($it) != '')
		{
		    sendToAdminEmail($data);
			echo $it;
		};
	} else {
	    echo '<script>document.location.href="/error/";</script>';
	}
}