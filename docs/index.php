<?php
session_start();
//> Подключение конфигурационных файлов
include_once '../config/config.php';
include_once '../config/db.php';
include_once '../config/db_api.php';
//<

// Библиотека функций
include_once '../library/libraryFunctions.php';

// Определяем, с каким контроллером будем работать
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';

if($controllerName == 'Admin')
{
    $cur_page = explode("/", $_SERVER['REQUEST_URI']);
    $_SESSION['user']['cur_page'] = $cur_page[2];
};

// Определяем используемый экшн
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Получаем список всех экшнов для корректной работы страницы ошибки 404. Проверить ../config/actions.ini на корректность, отключить.
// actions_list('Admin', $controllers, '../config/actions.ini');

// Функционал страницы ошибки 404. Ошибка 404 по умолчанию показывается только во фронтенде.
// error_404('Admin', 'Page', $controllerName, $actionName, $controllers);

if($controllerName == 'Page' &&
    isset($actionName) &&
    trim($actionName) != '' &&
   trim($actionName) != 'questions' &&
    trim($actionName) != 'letter' &&
    trim($actionName) != 'about')
    $actionName = 'index';

loadPage($smarty, $controllerName, $actionName);