<?php

/**
 * SettingsModel.php
 * 
 * Модель для работы со страницей настроек
 */

/**
 * Список всех настроек
 * 
 * @return array $settings Массив с информацией
 */
function settings() {
	$settings = s("settings", "`visible`='1'", "", "type`, `title");
	return $settings;
}