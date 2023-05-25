<?php
/* Проверка прямого доступа*/
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addStyleSheet('modules/mod_spoiler_article/asset/css/style.css');
$doc->addScript('modules/mod_spoiler_article/asset/js/script.js');
?>

<div class="mount-sys <?php echo $params->get('moduleclass_sfx'); ?>">
<?php
if (count($list)) {
	$i = 1;
	foreach($list as $id) {
		if ($params->get('article_description') == '1') {
			if ($params->get('html_clear') == 1) {
				$description = strip_tags($id->introtext);
			} else {
				$description = $id->introtext;
			}
			if ((int)$params->get('count_symbol') > 0) {
				$description = mb_substr($description, 0, $params->get('count_symbol'));
			}
		}
		
		$date_created = strtotime($id->created); // переводит из строки в дату
		$date_created = date('d.m.Y', $date_created);
		
		$link_article = JRoute::_(ContentHelperRoute::getArticleRoute($id->id, $id->catid));
?>
		
		<div class="mount-article <?php echo $params->get('article_class'); ?> <?php if($params->get('first_show') == 1 && $i == 1) { echo 'active'; } ?>">
			<div class="article-title">
				<h2><?php if ($params->get('date_display') == 1) { ?><span class="article-date"><?php echo $date_created; ?></span><?php } ?><?php echo $id->title; ?></h2>
			</div>
			<div class="article-content" style="<?php if($params->get('first_show') == 1 && $i == 1) { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
				<?php
					if ($params->get('article_description') == 1) {
						echo '<div class="article-description">';
							echo $description;
						echo '</div>';
					}
					if ($params->get('article_readmore') == 1) {
						echo '<div class="article-readmore">';
							echo '<a href="' . $link_article . '">' . $params->get('read_more') . '</a>';
						echo '</div>';
					}
				?>
			</div>
		</div>
<?php
		$i++;
	}
	unset($id);
} else {
	echo JText::_('MOD_SPOILER_ARTICLE_NO_ARTICLE');
}
?>
</div>