<?php

/**
 * MainModel.php
 * 
 * Общая модель для фронтенда
 */

/**
 * Список всех разделов сайта
 * 
 * @return array $sections Массив с информацией
 */
function site_sections() {
	$sections = s("sections");
	foreach($sections as $key => $val) {
	    if(count(explode("http", $val['link'])) == 1) $sections[$key]['linkid'] = implode("", explode("/", $val['link']));
	}
	return $sections;
}