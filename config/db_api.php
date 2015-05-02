<?php

$mysqli = new mysqli(DB_LOCATION, DB_USER, DB_PASSWORD, DB_NAME);
$mysqli->set_charset("utf8");

if ($mysqli->connect_errno)
{
    printf("Ошибка подключения к БД <b>".DB_NAME."</b>: %s\n", $mysqli->connect_error);
    exit();
}

/*
 * Общая функция для выборки из базы данных (s = select)
 *
 * @param string $tbl Имя таблицы в БД
 * @param string $where Условие выборки полностью, но без WHERE
 * @param string $items Конкретные поля(если нет - берутся все)
 * @param string $order По какому полю сортировать выборку
 * @param string $reverse пустое или DESC
 * @param string $limit LIMIT(если пустое - берутся все записи)
 * @param integer $start С какой записи начинать выборку
 *
 * @return array/string $info Массив с информацией/Строка
 */
function s($tbl, $where="", $items="", $order="id", $reverse="", $limit="", $start="") {
    global $mysqli;
	$i = 0;
	$q = "SELECT";
    if(trim($items) == "")
	{
	    $q .= " * ";
	} else {
	    $q .= " ".$items." ";
	}
	$q .= "FROM `".$tbl."`";
	if(trim($where) != "") $q .= " WHERE ".$where;
	if(trim($order) != "") $q .= " ORDER BY `".$order."`";
	if(trim($reverse) != "") $q .= " ".$reverse;
	if(trim($limit) != "") {
	    if(trim($start) != "") {
		    $q .= " LIMIT ".$start.", ".$limit;
		} else {
		    $q .= " LIMIT ".$limit;
		}
	};
	$res = $mysqli->query($q);
	if((int)$res->num_rows > 0) {
	    while($row = $res->fetch_assoc())
		{
		    $info[$i] = $row;
			$i++;
		}
		$res->close();
	} else {
	    $info = array();
	}
	return $info;
}

/*
 * Функция выборки конкретной строки из БД (s = select_alone)
 *
 * @param string $tbl - Название таблицы
 * @param string $val - значение столбца
 * @param string $row - Столбец, по которому делаем выборку (по умолчанию ID);
 *
 * @return array $info - Возвращаем строку в виде массива
 */ 
function sa($tbl, $val, $row="id") {
    global $mysqli;
	$res = $mysqli->query("SELECT * FROM `{$tbl}` WHERE `{$row}`='{$val}'");
	if((int)$res->num_rows == 1) {
	    $info = $res->fetch_assoc();
	} else {
	    $info = 'error';
	}
	$res->close();
	return $info;
}

/*
 * Тупо исполнение sql-запроса (q = query)
 *
 * @param string $q sql-запрос
 * @param integer $cnt Вернуть кол-во строк 0/1
 * @param integer/rsarray $res Число полей/rsarray с информацией
 */
function q($q, $cnt=0, $only_res="none") {
    global $mysqli;
	$i = 0;
	if($cnt == 0)
	{
	    $mysqli->query($q);
	} else {
	    if($cnt == 'res')
		{
		    $rs = $mysqli->query($q);
			$count = (int)$res->num_rows;
			if($count > 1 && $only_res == "none") {
			    while($row = $rs->fetch_assoc())
			    {
			        $res[$i] = $row;
			    	$i++;
			    }
			} else {
			    while($row = $rs->fetch_assoc())
			    {
			        $res = $row;
			    }
			}
			$rs->close();
			return $res;
		} else {
		    $rs = $mysqli->query($q);
		    $res = (int)$rs->num_rows;
		    $rs->close();
		    return $res;
		}
	}
}

/**
 * обработчик запросов (doq = do query)
 * 
 * @param array $data Данные с формы
 * @return string $success Сообщение об итоге операции
 */
function doq($data) {

	$act = explode("_", $data['action']);
	((int)count($act) == 3 && trim($act[0]) == 'del' && trim($act[2]) == 'file' && trim($act[1]) != '') ? $type = $act[1] : $type = 'none';
	
	$dir = $type.'/';
	
	switch($data['action'])
	{
	        case('auth'):
			                $success = auth($data);
							break;
	        case('exit'):
			                $success = exitPanel();
							break;
	        case('add'):
			                $success = add($data);
							break;
	        case('update'):
			                $success = upd($data);
							break;
	        case('delete'):
			                $success = del($data);
							break;
	        case('del_'.$type.'_file'):
			                if($type != 'none') unlink('documents/'.$dir.$data['img']);
							$success = 'success';
							break;
	        case('settings'):
			                $success = addsettings($data);
							break;
	}

	return $success;
}

/**
 * Добавление в бд
 * 
 * @param array $data Данные для добавления
 * @return string $success сообщение об итоге операции
 */
function add($data) {

	unset($data['action']);
	$tbl = $data['type'];
	unset($data['type']);
	$cells = "";
	$values = "";
	
	$healthy = array("-0-0-", "-1-1-", "-2-2-", "-3-3-", "-4-4-", "-5-5-");
    $yummy   = array("&", "<", ">", '"', "'", "+");

	if($tbl != 'keys') {
	    if(isset($data['password']) && $data['password'] != '')
	    {
	        $data['password_current'] = sip($data['password']);
	    	$data['password'] = md5(md5(sip($data['password'])));
	    };
	    
	    if(!it($data['link']) || trim(sip($data['link'])) == '') $data['link'] = str2url(sip(str_replace($healthy, $yummy, $data['title'])));
        if($tbl == 'articles') $data['anons'] = substr($data['description'], 0, 500);
	};
	if(it($data))
	{
        foreach($data as $key => $val)
        {
            if($key != 'item')
            {
                $cells .= "`{$key}`, ";
                $values .= "'".str_replace($healthy, $yummy, $val)."', ";
            }
        }

        $cells = substr($cells, 0, (strlen($cells) - 2));
        $values = substr($values, 0, (strlen($values) - 2));

        q("INSERT INTO `{$tbl}`({$cells}) VALUES ({$values})");
        $success = 'success';

	} else {
	    $success = 'error';
	}
	
	return $success;
}

/**
 * Обновление данных в бд
 * 
 * @param array $data Данные для обновления
 * @return string $success сообщение об итоге операции
 */
function upd($data) {

	unset($data['action']);
	$tbl = $data['type'];
	unset($data['type']);
	$update = "";

	$healthy = array("-0-0-", "-1-1-", "-2-2-", "-3-3-", "-4-4-", "-5-5-");
    $yummy   = array("&", "<", ">", '"', "'", "+");
	
	if($tbl != 'keys') {
	    if(isset($data['password']) && $data['password'] != '')
	    {
	        $data['password_current'] = sip($data['password']);
	    	$data['password'] = md5(md5(sip($data['password'])));
	    };
	    
	    if(!it($data['play_market']) || trim(sip($data['play_market'])) == '') unset($data['play_market']);
	    if(!it($data['istore']) || trim(sip($data['istore'])) == '') unset($data['istore']);
	    if(!it($data['steam_store']) || trim(sip($data['steam_store'])) == '') unset($data['steam_store']);
	    if(!it($data['yardteam_store']) || trim(sip($data['yardteam_store'])) == '') unset($data['yardteam_store']);
		if(!it($data['weblink']) || trim(sip($data['weblink'])) == '') unset($data['weblink']);
	    if(!it($data['link']) || trim(sip($data['link'])) == '') $data['link'] = str2url(sip(str_replace($healthy, $yummy, $data['title'])));
    };
	
	if(it($data))
	{
	    if($tbl == 'keys') {
		    $keys = explode("\n", $data['keys']);
			q("DELETE FROM `keys` WHERE `game`='{$data['game']}' AND `used`='0'");
			foreach($keys as $item) {
			    if(chop(trim($item)) != '') q("INSERT INTO `keys`(`steam_key`,`game`) VALUES ('".chop(trim($item))."', '{$data['game']}')");
			}
			$success = 'success';
		} else {
		    foreach($data as $key => $val)
	        {
	            if($key != 'item')
	        	{
		    	    $update .= "`{$key}`='".str_replace($healthy, $yummy, $val)."', ";
	        	}
	        }
	        
		    $update = substr($update, 0, (strlen($update) - 2));
		    
		    if($tbl == 'users' && isset($data['login']) && trim($data['login']) != '')
		    {
		        $it = sa("users", $data['login'], "login");
		    	if($it['id'] == $data['item'])
		    	{
		            q("UPDATE `{$tbl}` SET {$update} WHERE `id`='{$data['item']}'");
		            $success = 'success';
		    	} else {
		    	    $success = 'invalid_login';
		    	}
		    } else {
		    	q("UPDATE `{$tbl}` SET {$update} WHERE `id`='{$data['item']}'");
		        $success = 'success';
		    }
		}
	} else {
	    $success = 'error';
	}
	
	return $success;
}

/**
 * Удаление данных из бд
 * 
 * @param array $data Содержит имя таблицы и ID удаляемой записи
 * @return string $success сообщение об итоге операции
 */
function del($data) {
	$tbl = $data['type'];
	unset($data['type']);
	
	if(it($data['item']))
	{		
		if($tbl == 'keys') {
		    if((int)$data['item'] == 0) {
			    q("DELETE FROM `{$tbl}` WHERE `used`='1'");
			} else {
			    q("DELETE FROM `{$tbl}` WHERE `game`='{$data['item']}'");
			}
		} else {
		    q("DELETE FROM `{$tbl}` WHERE `id`='{$data['item']}'");
		}
		$success = 'success';
	} else {
	    $success = 'error';
	}
	if($tbl != 'keys') del_files($data['type'], $data['item'], 'poster', 'documents/'.$data['type']);
	return $success;
}

/**
 * Удаление связанных с бд файлов
 * 
 * @param string $tbl Название таблицы
 * @param string $row Поле с именем файла
 * @param string $path Путь от корня сайта до файла, не включая имя файла и расширение(в начале и конце слэшей быть не должно)
 */
function del_files($tbl, $id, $row, $path) {
	$img = sa($tbl, $id);
	unlink($path.'/'.$img[$row]);
}

/**
 * Применение настроек сайта
 * 
 * @param array $data Данные для применения
 * @return string $success сообщение об итоге операции
 */
function addsettings($data) {
    $i = 0;
	$ok = 1;
	$healthy = array("-0-0-", "-1-1-", "-2-2-", "-3-3-", "-4-4-", "-5-5-");
    $yummy   = array("&", "<", ">", '"', "'", "+");
	$tbl = $data['type'];
	unset($data['action']);
	unset($data['type']);
	foreach($data as $key => $val)
	{
		if(trim($val) == '')
		{
		    $ok = 0;
			break;
		} else {
			$query[$i] = "UPDATE `{$tbl}` SET `value`='".str_replace($healthy, $yummy, $val)."' WHERE `option_alias`='{$key}'";
		    $i++;
		}
	}
	if($ok == 0)
	{
	    $success = 'error';
	} else {
	    $success = 'success';
		foreach($query as $item) : q($item);
		endforeach;
	}
	return $success;
}


function increaseHit($articleID)
{
    global $mysqli;

    $query = 'UPDATE articles SET hits = hits + 1 WHERE id = ' . $articleID;
    return $mysqli->query($query);
}

function updateAnons2($id, $anons){
    $query = "UPDATE articles SET anons = '" .  $anons . "' WHERE id = " . $id;
    global $mysqli;
    $mysqli->query($query);

}