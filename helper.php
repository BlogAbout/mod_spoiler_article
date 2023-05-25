<?php
/* Проверка прямого доступа */
defined('_JEXEC') or die;

class modSpoilerArticleHelper
{
	public static function getList($params)
	{
		$id_category = implode(',',$params->get("com_categories"));
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*')
			->from($db->quoteName('#__content'))
			->where($db->quoteName('catid') . ' IN (' . $id_category . ')')
			->where($db->quoteName('state') . '=1');
		
		switch ($params->get("field_sort")) {
			case '1': {
				$query->order($db->quoteName('id') . ' ' . $params->get("type_sort"));
				break;
			}
			case '2': {
				$query->order($db->quoteName('title') . ' ' . $params->get("type_sort"));
				break;
			}
			case '3': {
				$query->order($db->quoteName('created') . ' ' . $params->get("type_sort"));
				break;
			}
			case '4': {
				$query->order($db->quoteName('ordering') . ' ' . $params->get("type_sort"));
				break;
			}
		}
		
		if ((int)$params->get('article_count') > 0) {
			$query->setLimit((int)$params->get('article_count'));
		}
				
		$db->setQuery($query);
		$list = $db->loadObjectList();
		
		return $list;
	}
}
?>