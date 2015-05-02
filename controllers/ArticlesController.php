<?php

require_once '../models/ArticlesModel.php';
require_once '../models/CategoryModel.php';

function indexAction($smarty) {
    $articles = getArticlesOfPage(1);

    $smarty->assign('articles', $articles);
    $smarty->assign('allCategories', getAllCategories());

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
//	echo '<script>document.location.href="/news/";</script>';
}

function getAction($smarty)
{
    // Достаем статью
    $link = sip($_GET['key']);
    $article = sa("articles", $link, "link");
    if($article == 'error') echo '<script>document.location.href="/error/";</script>';

    // Достаем привязанную к ней рубрику
    include_once '../models/CategoryModel.php';
    $category = getCategory($article['category_id']);
    $article['category'] = $category;

    $smarty->assign('article', $article);
    $smarty->assign('article_description', $article['anons']);
    $smarty->assign('allCategories', getAllCategories());
    increaseHit($article['id']);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'breadcrumbs');
    loadTemplate($smarty, 'article');
    loadTemplate($smarty, 'footeryuy



    uiui l
    i
    k ols
    w
    7');

}

function getAnons($description)
{
    return substr($description, 0, 500) . '...';

}



/**
 * Через Ajax получаем еще статьи
 */
function ajaxAction()
{
    $categoryID = '';
    if ((int)$_GET['category']) {
        $categoryID = (int)$_GET['category'];
    }
    $articles = getArticlesOfPage(sip($_GET['page']), $categoryID);
    if ($articles) {
        echo json_encode($articles);
    } else {
        echo json_encode(array('error'=>true));
    }

}
