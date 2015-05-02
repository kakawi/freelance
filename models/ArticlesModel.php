<?php


/**
 * Статьи, в зависимости от категории
 * @param $id
 * @return array
 */
function getArticliesOfCategory($id)
{
    $articles = s('articles', 'category_id = ' . $id);
    return $articles;
}

/**
 * Достаем статьи (определенное количество, взависимости от "страницы") и, если надо, взависимости от категории
 * @param $page
 * @param bool $category
 * @return array
 */
function getArticlesOfPage($page, $category = false)
{
    $limit = 3;
    $where = '';
    if ($category) {
        $where = 'category_id='.$category;
    }
    $articles = s('articles', $where, '', '', '', $limit, ($page - 1) * $limit);

    require_once 'CategoryModel.php';

    if($category) {
        $category = getCategory($category);
        foreach($articles as &$article) {
            $article['category'] = $category;
        }
    } else {
        $allCategories = getAllCategories();
        foreach($articles as &$article) {
            $article['category'] = $allCategories[$article['category_id']];
        }
    }

    return $articles;
}

function updateAnons()
{
    $articles = s('articles');
    foreach ($articles as $article) {
        $anons = substr($article['description'], 0, 500);
        updateAnons2($article['id'], $anons);
    }
}


 