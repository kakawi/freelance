{literal}
<script id="article-template" type="text/x-handlebars-template">
    <article>
        <div class="title">
            <a href="/articles/get/{{link}}/">{{title}}</a>
        </div>
        <div class="top">
            <div class="hits">Просмотров: {{hits}}</div>
                <div class="category">Рубрика: {{category.title}}</div>
        </div>
        {{{anons}}}
        <div class="link">
            <a href="/articles/get/{{link}}/">Читать далее...</a>
        </div>
    </article>
    <hr>
</script>
{/literal}

<div id="container">
{foreach from=$articles item=article}
    <article>
        <div class="title">
            <a href="/articles/get/{$article.link}/">{$article.title}</a>
        </div>
        <div class="top">
            <div class="hits">Просмотров: {$article.hits}</div>
            <div class="category">Рубрика: {$article.category.title}</div>
        </div>
        <p class="anons">{$article.anons}...</p>
        <div class="link">
            <a href="/articles/get/{$article.link}/">Читать далее...</a>
        </div>
    </article>
    <hr>
{/foreach}
</div>
<button name="More">Показать еще...</button>