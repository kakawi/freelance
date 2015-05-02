<?php

/**
 * UploadModel.php
 * 
 * Модель для работы с механизмом загрузки файлов на сервер
 */

/**
 * Загрузка файла
 * 
 * @param string/integer $key Тип файла
 * @param array $file Массив с данными о файле
 */
function upload($key, $file, $title="") {

	$filename = explode(".", $file['name']);
	$info = explode("-0-", $key);
	
	$name = $info[1];
    uploadFile($name, $file, $filename[1], $info[0]);
	
	return $name.'.'.$filename[1];
}