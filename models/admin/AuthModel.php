<?php

/**
 * AuthModel.php
 * 
 * Модель для работы с авторизацией в административной панели
 */

/**
 * Авторизация
 * 
 * @param array $data Данные с формы
 * @return array $success Сообщение об итоге операции
 */
function auth($data) {
	if(trim($data['login']) != '' && trim($data['password']) != '')
	{
		$user = sa("users", sip($data['login']), "login");
        if(it($user) == 1)
        {
		    if($user['password'] == md5(md5(sip($data['password']))))
		    {
		    	unset($user['password']);
				$_SESSION['user'] = $user;
		    	$_SESSION['session']['id'] = md5(sip($data['login']).sip($data['password']));
		    	q("INSERT INTO `sessions`(
		    	                                       `user_id`, 
		    										   `session_id`
		    								 ) VALUES (
		    								           '{$user['id']}', 
		    										   '".md5(sip($data['login']).sip($data['password']))."'
		    								)");
		    	q("UPDATE `users` SET 
		    								`lastvisit`='".date('Y-m-d H:i:s',time())."' 
		    					WHERE `id`='{$user['id']}'");
		    	$success = 'success';
		    } else {
				$success = 'error';
		    }
		} else {
		    $err = exitPanel();
			$success = 'error';
		}
	} else {
	    $err = exitPanel();
		$success = 'error';
	}
	
	return $success;
	//$loboq = select("users", "`login`='".sip($data['login'])."'");
	//return md5(md5(sip($data['password']))).' - '.$loboq['password'];
}

/**
 * Выход из панели
 * 
 */
function exitPanel() {
    
	$user = userInfo($_SESSION['user']['id']);
	$start = strtotime($user['lastvisit_start']);
	$lastvisit = time();
	$now = date('Y-m-d');
	$worktime = (int)$start - (int)$lastvisit;
	
	q("INSERT INTO `worktime`(
	                                       `user_id`, 
										   `date`, 
										   `worktime`
							     ) VALUES (
								           '{$_SESSION['user']['id']}', 
										   '{$now}', 
										   '{$worktime}'
								 )");
	q("UPDATE `users` SET `lastvisit`='".date('Y-m-d H:i:s',time())."' WHERE `id`='{$_SESSION['user']['id']}'");
	q("DELETE FROM `sessions` WHERE `user_id`='{$_SESSION['user']['id']}'");
	session_destroy();
	return 'success';
}

/**
 * Проверка пароля при изменениях в форме
 * 
 * @param array $data информация с формы
 */
function passCheck($data) {
    $oldpass = sa("users", $data['item']);
	(trim($data['password']) != $oldpass && trim($data['password']) != '') ? $pass = md5(md5(sip($_POST['password']))) : $pass = $oldpass;
	return $pass;
}