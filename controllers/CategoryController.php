<?php
include_once '../models/ArticlesModel.php';
include_once '../models/CategoryModel.php';

/**
 * Отображение страницы определенной категории
 * @param $smarty
 */
function getAction($smarty)
{
    $id = sip($_GET['id']);
    $articles = getArticliesOfCategory($id);
    $category = getCategory($id);

    foreach($articles as &$article) {
        $article['category'] = $category;
    }

    $smarty->assign('articles', $articles);
    $smarty->assign('allCategories', getAllCategories());

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}
 