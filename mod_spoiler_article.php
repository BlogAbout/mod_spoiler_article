<?php

// No direct access to this file
defined('_JEXEC') or die;

// Подключаем файл помошника
require_once dirname(__FILE__).'/helper.php';

// Выполняем getList метод из помошника
$list = modSpoilerArticleHelper::getList($params);

// Подключаем файл шаблона с помощью класса JModuleHelper
require JModuleHelper::getLayoutPath('mod_spoiler_article', $params->get('layout', 'default'));

?>
