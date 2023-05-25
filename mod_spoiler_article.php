<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

require_once dirname(__FILE__) . '/helper.php';

$list = ModSpoilerArticleHelper::getList($params);

require ModuleHelper::getLayoutPath('mod_spoiler_article', $params->get('layout', 'default'));