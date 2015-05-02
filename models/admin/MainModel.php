<?php

/**
 * MainModel.php
 * 
 * Модель с набором общих функций для административной панели
 */

/**
 * Проверка авторизации пользователя
 * 
 * @param integer $rank Допустимый ранг
 */
function userAuth($rank=1)
{
	if((int)$_SESSION['user']['id'] >= 1 || $rank == -1)
	{
	    $ssid = sa("sessions", $_SESSION['user']['id'], "user_id");
		if(it($ssid['session_id']) == 1 || $rank == -1)
		{
		    if($ssid['session_id'] == $_SESSION['session']['id'] || $rank == -1)
			{
		        if($_SESSION['user']['rank'] >= $rank || $rank == -1)
				{
				    if($rank != -1) return $_SESSION['user']['id'];
				} else {
				    echo '<script>document.location.href = "/admin/";</script>';
				}
			} else {
			    unset($_SESSION);
				session_destroy();
				echo '<script>document.location.href = "/admin/";</script>';
			}
		} else {
			unset($_SESSION);
			session_destroy();
			echo '<script>document.location.href = "/admin/";</script>';
		}
	} else {
		unset($_SESSION);
		session_destroy();
		echo '<script>document.location.href = "/admin/";</script>';
	}
}

/**
 * Информация о пользователе по его ID
 * 
 * @param integer $id ID пользователя
 * @return array $userInfo возвращаем массив с информацией
 */
function userInfo($id) {
	$userInfo = sa("users", $id);
	unset($userInfo['password_current']);
	unset($userInfo['password']);
	unset($userInfo['login']);
	return $userInfo;
}

/**
 * Актуализация сведений о пользователе, находящимся в административной панели
 * 
 */
function user_session_current() {

    if((int)$_SESSION['user']['id'] >= 1)
	{
	    q("UPDATE `sessions` SET `lastvisit`='".date('Y-m-d H:i:s',time())."' WHERE `user_id`='{$_SESSION['user']['id']}'");
		q("UPDATE `users` SET `lastvisit`='".date('Y-m-d H:i:s',time())."' WHERE `id`='{$_SESSION['user']['id']}'");
        $vk = explode("/", $_SESSION['user']['vk']);
        $url = 'http://api.vkontakte.ru/method/users.get?user_ids='.$vk[count($vk)-1].'&fields=photo_200';
        $json = json_decode(file_get_contents($url), true);
        q("UPDATE `users` SET `photo`='{$json['response'][0]['photo_200']}' WHERE `id`='{$_SESSION["user"]["id"]}'");
	};
	
    $session = sa("sessions", $_SESSION['user']['id'], "user_id");
    $last = strtotime($session['lastvisit']);
	$now = time();

    if(((int)$now - (int)$last) > 900)
    {
        q("DELETE FROM `sessions` WHERE `id`='{$session['id']}'");
        q("UPDATE `users` SET `lastvisit`='".date('Y-m-d H:i:s',$last)."' WHERE `id`='{$_SESSION['user']['id']}'");
    } else {
        q("UPDATE `users` SET `lastvisit`='".date('Y-m-d H:i:s',$now)."' WHERE `id`='{$_SESSION['user']['id']}'");
    }
}

/**
 * Отправка ответов пользователю от службы поддержки
 *
 * @param array $data Входные данные
 *
 */
function sendToEmail($data) {
	$healthy = array("-0-0-", "-1-1-", "-2-2-", "-3-3-", "-4-4-", "-5-5-");
    $yummy   = array("&", "<", ">", '"', "'", "+");
	
	$user_letter = sa("support", $data['item']);
	
	$sitename_full = sa("settings", "sitename", "option_alias");
	$sitename = $sitename_full['value'];
	
	$admin_email_full = sa("settings", "admin_email", "option_alias");
	$admin_email = $admin_email_full['value'];
	
	$support_email_full = sa("settings", "support_email", "option_alias");
	$support_email = $support_email_full['value'];
	
	$support_name_full = sa("settings", "support_name", "option_alias");
	$support_name = $support_name_full['value'];
	
	$subject = 'RE: '.$user_letter['thread'];
    $message = '<!DOCTYPE html>
                <html>
    			<head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    				<title>'.$sitename.' | '.$subject.'</title>
    			</head>
    			<body style="margin: 0; padding: 0; font-family: arial; font-weight: normal; font-size: 12px; color: #333333;">
    			<div id="all" style="padding: 10px; width: 500px;">
    			    <H3 style="color: #0088DD; font-size: 16px;">'.$subject.'</H3>
                    <div style="margin-top: 10px; margin-bottom: 10px; padding: 10px; font-size: 14px; background: #EEEEEE; display: block; width: 100%; font-family: arial; font-weight: lighter;">
						'.str_replace($healthy, $yummy, $data['answer']).'
                    </div>
					'.$support_name.'
					<br />
					<br />
                    <a href="http://itcenter.me" target="_blank" style="text-decoration: none !important; color: #0088DD !important; display: block; margin: 0 auto; text-align: center;">Центр IT Решений</a>
    			</div>
    			</body>
    			</html>';
    $to = $user_letter['email'];
    $headers  = "Content-type: text/html; charset=utf-8\r\n"; 
    $headers .= "From: ".$support_name." <".$support_email.">" . "\r\n"; 
    $headers .= "Bcc: ".$subject."\r\n";
			
    mail($to, $subject, $message, $headers);
	//file_put_contents('new.html', $message);
}

/**
 * Список элементов контента для раздела админки с общим экшном
 * 
 * @return array $content Массив с информацией
 */
function content($tbl, $p) {
	$items_per_page = sa("settings", 'admin_items_per_page', 'option_alias');
	$n = $items_per_page['value'];
	$content = s($tbl, "", "", "id", "DESC", $n, ($p*$n)-$n);
	
	foreach($content as $key => $val)
	{
		if(isset($val['whenadd'])) $content[$key]['whenadd'] = rusdate($val['whenadd']);
		if(isset($val['description'])) $content[$key]['small_description'] = croptext(strip_tags(htmlspecialchars_decode($val['description'])), 36);
	}

	return $content;
}

/**
 * Пагинация для разделов админки с общим экшном
 * 
 * @return array $pages Массив с информацией
 */
function pages($tbl, $p) {
	$items_per_page = sa("settings", 'admin_items_per_page', 'option_alias');
	$n = $items_per_page['value'];
	$p2 = q("SELECT * FROM `{$tbl}` ORDER BY `id` DESC", 1);
	
	if($p2 >= $n) {
	    $p2%$n == 0 ? $p3 = $p2/$n : $p3 = (($p2-($p2%$n))/$n)+1;
	} else {
	    $p3 = 1;
	}
	
	if($p > $p3 || $p < 1) echo '<script>document.location.href = "/admin/'.$tbl.'/1/"</script>';
	
	for($i = $p-2; $i <= $p+2; $i++) {
	    if($i > 0 && $i <= $p3) $pages[$i] = $i;
	}
	
	$pages['current'] = $p;
	return $pages;
}