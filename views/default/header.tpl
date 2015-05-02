<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
{if isset($article_description)}
    <meta name="description" content="{$article_description}" />
{/if}

    <link rel="stylesheet" href="{$templateWebPath}css/articles.css" />
	<script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/js/articles.js"></script>
	<script type="text/javascript" src="/js/handlebars-v3.0.0.js"></script>
	{*<script type="text/javascript" src="/js/frontend.js"></script>*}
    <title>{$ss_sitename}</title>
    <!--[if lt IE 9]><!--<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>--><![endif]-->
</head>

<body>
<div id="wrap">
<div id="sidebar">
    {foreach from=$allCategories item=category}
        <a href="/category/get/{$category.id}/">{$category.title}</a>
    {/foreach}
</div>

