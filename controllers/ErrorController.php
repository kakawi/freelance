<?php

/**
 * ErrorController.php
 *  
 * Контроллер страницы ошибки 404
 * 
 */

// Переопределение настроек для Smarty
$smarty->setTemplateDir(TEMPLATE_PREFIX);
$smarty->assign('templateWebPath', TEMPLATE_WEB_PATH);

/**
 * Формирование главной страницы
 * 
 * @param object $smarty Объект шаблонизатора
 */
function indexAction($smarty) {
	$smarty->assign('metadescription', 'ошибка 404. Такой страницы не существует.');
	$smarty->assign('metakeywords', 'ошибка, 404, страница не существует');
	$smarty->assign('sections', site_sections());
	$smarty->assign('current', 'error');
	
	loadTemplate($smarty, 'header');
	loadTemplate($smarty, 'error');
	loadTemplate($smarty, 'footer');
}