<?php

/**
 * IndexModel.php
 *
 *
 */


function news($p) {
    $items_per_page = sa("settings", 'news_per_page', 'option_alias');
    $n = $items_per_page['value'];
    $news = s("news", "", "", "id", "DESC", $n, ($p*$n)-$n);

    foreach($news as $key => $val)
    {
        if(isset($val['whenadd'])) $news[$key]['whenadd'] = rusdate($val['whenadd']);
        if(isset($val['description'])) $news[$key]['small_description'] = chop(mb_substr(strip_tags(htmlspecialchars_decode($val['description'])), 0, 200, 'UTF-8')).'...';
    }

    return $news;
}

/**
 * Пагинация для страницы новостей
 *
 * @param integer $p Текущая страница
 * @return array $pages Массив с информацией
 */
function pages($p) {
    $items_per_page = sa("settings", 'news_per_page', 'option_alias');
    $n = $items_per_page['value'];
    $p2 = q("SELECT * FROM `news` ORDER BY `id` DESC", 1);

    if($p2 >= $n) {
        $p2%$n == 0 ? $p3 = $p2/$n : $p3 = (($p2-($p2%$n))/$n)+1;
    } else {
        $p3 = 1;
    }

    if($p > $p3 || $p < 1) echo '<script>document.location.href = "/news/1/"</script>';

    for($i = $p-2; $i <= $p+2; $i++) {
        if($i > 0 && $i <= $p3) $pages[$i] = $i;
    }

    $pages['current'] = $p;
    $pages['count'] = $p3;
    $pages['per_page'] = $n;
    return $pages;
}