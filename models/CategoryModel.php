<?php

/**
 * Получить все категории
 * @return array
 */
function getAllCategories()
{
    $allCategories = s('category');
    $data = array();
    foreach ($allCategories as $category) {
        $data[$category['id']] = $category;
    }

    return $data;
}

/**
 * Специально для формы
 * @return array
 */
function getCategoriesForSelect()
{
    $allCategories = getAllCategories();
    $data = array();
    foreach($allCategories as $category) {
        $data[$category['id']] = $category['title'];
    }

    return $data;
}

/**
 * Получить одну категорию
 * @param $id
 * @return array|bool|string
 */
function getCategory($id) {
    $category = sa('category', $id);
    if(!$category) return false;

    return $category;
}
 