<?php

/**
 * AdminController.php
 *  
 * Контроллер главной страницы административной панели
 * 
 */

require_once '../models/admin/MainModel.php';

// Переопределение настроек для Smarty
$smarty->setTemplateDir(TEMPLATE_ADMIN_PREFIX);
$smarty->assign('templateAdminWebPath', TEMPLATE_ADMIN_WEB_PATH);
if(isset($_SESSION["user"]["id"]) && trim($_SESSION["user"]["id"]) != '') $smarty->assign('userInfo', userInfo($_SESSION["user"]["id"]));

// Актуализация сведений об авторизованном пользователе
if(isset($_SESSION["user"]["id"]) && trim($_SESSION["user"]["id"]) != '') user_session_current();

// Язык сайта
$smarty->assign('sitelang', 'RU');

/**
 * Формирование главной страницы
 * 
 * @param object $smarty Объект шаблонизатора
 */
function indexAction($smarty) {
	echo '<script>document.location.href = "/admin/login/";</script>';
}

/**
 * Формирование страницы входа
 * 
 * @param object $smarty Объект шаблонизатора
 */
function loginAction($smarty) {
//	if((int)$_SESSION['user']['id'] >= 1) echo '<script>document.location.href = "/admin/news/";</script>';
	if((int)$_SESSION['user']['id'] >= 1) echo '<script>document.location.href = "/admin/articles/";</script>';
	$smarty->assign('pageTitle', 'Вход');
    loadTemplate($smarty, 'auth');
}

/**
 * Формирование ajax-обработчика запросов
 * 
 * @param object $smarty Объект шаблонизатора
 */
function ajaxAction($smarty) {
	require_once '../models/admin/AuthModel.php';
	if((int)$_SESSION['user']['id'] >= 1 || (isset($_POST['login']) && isset($_POST['password']) && trim($_POST['login']) != '' && trim($_POST['password']) != ''))
	{
	    $data = $_POST;
		if((int)$_SESSION['user']['id'] >= 1)
		{
			echo doq($data);
		} else {
			if(trim($data['action']) == 'auth')
			{
			    echo doq($data);
			} else {
	            echo '<script>document.location.href = "/admin/";</script>';
			}
		}
	} else {
	    echo '<script>document.location.href = "/admin/";</script>';
	}
}

/**
 * Формирование окна редактирования
 * 
 * @param object $smarty Объект шаблонизатора
 */
function editwindowAction($smarty) {
    userAuth(0);
	if(it($_POST))
	{
		if(sip($_POST['type'] == 'keys')) {
		    $it = sa('games', sip($_POST['item']));
			$content = sa('games', sip($_POST['item']));
			$it['keys'] = s("keys", "`game`='{$_POST['item']}' AND `used`='0'");
			$content['keys'] = $it['keys'];
		} else {
		    $it = sa(sip($_POST['type']), sip($_POST['item']));
		    $content = sa(sip($_POST['type']), sip($_POST['item']));
		}

        if(sip($_POST['type']) == 'articles') {
            require_once '../models/CategoryModel.php';
            $selectCategory = getCategoriesForSelect();
            $smarty->assign('selectCategory', $selectCategory);
        }
//            $fetch = $smarty->fetch(''.sip($_GET['action']).'/edit.tpl');
//            $smarty->assign('addModalWindow', $fetch);
//
//        } else {
//            $smarty->assign('addModalWindow', $add);
//        }

		$smarty->assign(sip($_POST['type']), $it);
		$smarty->assign('content', $content);
		loadTemplate($smarty, sip($_POST['type']).'/edit');
	} else {
	    echo '<script>document.location.href = "/admin/";</script>';
	}
}

/**
 * Формирование окна показа описания
 * 
 * @param object $smarty Объект шаблонизатора
 */
function descriptionwindowAction($smarty) {
    userAuth(0);
	if(it($_POST['item']))
	{
		if(sip($_POST['type']) == 'keys') {
		    $item = sa('games', sip($_POST['item']));
		    $keys = s(sip($_POST['type']), "`game`='".sip($_POST['item'])."' AND `used`='0'");
			$keys_used = s(sip($_POST['type']), "`game`='".sip($_POST['item'])."' AND `used`='1'");
			$smarty->assign('keys_current', count($keys));
			$smarty->assign('keys_used', count($keys_used));
			(count($keys) >= 1) ? $item['keys'] = $keys : $item['keys'][0]['steam_key'] = 'Нет ключей для продажи.';
			(count($keys_used) >= 1) ? $item['keys_used'] = $keys_used : $item['keys_used'][0]['steam_key'] = 'Не продано ни одного ключа.';
		} else {
		    $item = sa(sip($_POST['type']), sip($_POST['item']));
		}
		$smarty->assign('item', $item);
		$smarty->assign('target_window', sip($_POST['to']));
		$smarty->assign('showText', sip($_POST['title']));
		loadTemplate($smarty, 'show_description');
	} else {
	    echo '<script>document.location.href = "/admin/";</script>';
	}
}

/**
 * Формирование ajax-загрузчика файлов
 * 
 * @param object $smarty Объект шаблонизатора
 */
function uploadAction($smarty) {
	userAuth(0);
	require_once '../models/admin/UploadModel.php';
	$info = explode("-0-", $_GET['key']);
	if(trim($info[1]) == '' || trim($info[1]) == 'undefined') $info[1] = time();
	$info2 = implode("-0-", $info);
	$newvalue = upload($info2, $_FILES['file']);

	echo '<script type="text/javascript">
				  parent.window.document.getElementById("'.$info[2].'").value = "'.$newvalue.'";
		  </script>';
}

/**
 * Формирование страниц админ-панели
 * 
 * @param object $smarty Объект шаблонизатора
 */
function adminpageAction($smarty) {
	userAuth(1);
	if($_SESSION['user']['rank'] < 1) echo '<script>document.location.href = "/admin/";</script>';
    if(!it($_GET['id'])) echo '<script>document.location.href="/admin/'.sip($_GET['action']).'/1/";</script>';
	require_once '../config/lang/admin.php';
	$page = sip($_GET['action']).'_h';
	(sip($_GET['action']) == 'pages') ? $content = 'cpages' : $content = sip($_GET['action']);
	if(sip($_GET['action']) == 'keys') {
	    $tbl = 'games';
		$content = 'games';
		$cont = content($tbl, (int)sip($_GET['id']));
		$game_select = '';
		foreach($cont as $key => $val) {
		    $cont[$key]['keys'] = count(s("keys", "`game`='{$val['id']}' AND `used`='0'"));
			$game_select .= '<li OnClick="selected_select(\''.$val['id'].'\', \''.$val['title'].'\', \'#game_id\', \'\');"><h4>'.$val['title'].'</h4></li>';
		}
		$add = str_replace('ADMIN_GAME_SELECT', $game_select, file_get_contents('../views/admin/'.sip($_GET['action']).'/add.tpl'));
	} else {
	    $tbl = sip($_GET['action']);
		$cont = content($tbl, (int)sip($_GET['id']));
		$add = file_get_contents('../views/admin/'.sip($_GET['action']).'/add.tpl');
	}
	$smarty->assign('pageTitle', $admin_lang[$page]);
	$smarty->assign('pageTitle2', $admin_lang[$page.'2']);
	$smarty->assign($content, $cont);
	$smarty->assign('pages', pages($tbl, (int)sip($_GET['id'])));


    if(sip($_GET['action']) == 'articles') {
        require_once '../models/CategoryModel.php';
        $selectCategory = getCategoriesForSelect();
        $smarty->assign('selectCategory', $selectCategory);

        $fetch = $smarty->fetch(''.sip($_GET['action']).'/add.tpl');
        $smarty->assign('addModalWindow', $fetch);

    } else {
        $smarty->assign('addModalWindow', $add);
    }

    loadTemplate($smarty, 'header');
	loadTemplate($smarty, ''.sip($_GET['action']).'/main');
	loadTemplate($smarty, 'footer');
}

/**
 * Формирование главной страницы настроек сайта
 * 
 * @param object $smarty Объект шаблонизатора
 */
function settingsAction($smarty) {
	userAuth(1);
	if($_SESSION['user']['rank'] < 1) echo '<script>document.location.href = "/admin/";</script>';
    require_once '../models/admin/SettingsModel.php';
	$smarty->assign('settings', settings());
	$smarty->assign('sitelogo', sa("settings", "sitelogo", "option_alias"));

	loadTemplate($smarty, 'header');
	loadTemplate($smarty, 'settings');
	loadTemplate($smarty, 'footer');
}

/**
 * Формирование главной страницы настроек профиля
 * 
 * @param object $smarty Объект шаблонизатора
 */
function profileAction($smarty) {
	userAuth(1);

	$smarty->assign('pageTitle', 'Личные данные');
	$smarty->assign('pageTitle2', '');
	$smarty->assign('user', sa("users", $_SESSION["user"]["id"]));

	if($_SESSION['user']['rank'] == 1)
	{
	    loadTemplate($smarty, 'header');
	    loadTemplate($smarty, 'profile_settings');
	    loadTemplate($smarty, 'footer');
	};
	if($_SESSION['user']['rank'] == 0)
	{
	    loadTemplate($smarty, 'author_profile_settings');
	};
}