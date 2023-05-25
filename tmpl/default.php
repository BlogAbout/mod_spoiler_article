<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

$webAssetManager = Factory::getApplication()->getDocument()->getWebAssetManager();
$webAssetManager->useScript('jquery');
$webAssetManager->registerAndUseScript('mod_spoiler_article_js', 'modules/mod_spoiler_article/asset/js/script.js', [], [], ['jquery']);
$webAssetManager->registerAndUseStyle('mod_spoiler_article_css', 'modules/mod_spoiler_article/asset/css/style.css', [], [], []);
?>
<div class="mount-sys <?php echo $params->get('moduleclass_sfx'); ?>">
    <?php
    if (count($list)) {
        $i = 1;

        foreach ($list as $id) {
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

            $dateCreated = strtotime($id->created);
            $dateCreated = date('d.m.Y', $dateCreated);

            $linkArticle = Route::_(RouteHelper::getArticleRoute($id->id, $id->catid));

            $classes = 'mount-article ';
            $classes .= $params->get('article_class');
            $params->get('first_show') == 1 && $i == 1 && $classes .= ' active';
            ?>

            <div class="<?php echo $classes; ?>">
                <div class="article-title">
                    <h2>
                        <?php if ($params->get('date_display') == 1) { ?>
                            <span class="article-date"><?php echo $dateCreated; ?></span>
                        <?php } ?><?php echo $id->title; ?>
                    </h2>
                </div>

                <div class="article-content"
                     style="<?php echo ($params->get('first_show') == 1 && $i == 1) ? 'display: block;' : 'display: none;'; ?>"
                >
                    <?php
                    if ($params->get('article_description') == 1) {
                        echo '<div class="article-description">' . $description . '</div>';
                    }

                    if ($params->get('article_readmore') == 1) {
                        echo '<div class="article-readmore"><a href="' . $linkArticle . '">' . $params->get('read_more') . '</a></div>';
                    }
                    ?>
                </div>
            </div>
            <?php
            $i++;
        }

        unset($id);
    } else {
        echo \JText::_('MOD_SPOILER_ARTICLE_NO_ARTICLE');
    }
    ?>
</div>