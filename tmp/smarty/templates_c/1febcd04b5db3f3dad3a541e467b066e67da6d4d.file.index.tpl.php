<?php /* Smarty version Smarty-3.1.6, created on 2015-03-15 20:27:35
         compiled from "../views/default/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96023946454ff4b8a1e5883-19214525%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1febcd04b5db3f3dad3a541e467b066e67da6d4d' => 
    array (
      0 => '../views/default/index.tpl',
      1 => 1426433247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96023946454ff4b8a1e5883-19214525',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54ff4b8a1f939',
  'variables' => 
  array (
    'articles' => 0,
    'article' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ff4b8a1f939')) {function content_54ff4b8a1f939($_smarty_tpl) {?>
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


<div id="container">
<?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value){
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
    <article>
        <div class="title">
            <a href="/articles/get/<?php echo $_smarty_tpl->tpl_vars['article']->value['link'];?>
/"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</a>
        </div>
        <div class="top">
            <div class="hits">Просмотров: <?php echo $_smarty_tpl->tpl_vars['article']->value['hits'];?>
</div>
            <div class="category">Рубрика: <?php echo $_smarty_tpl->tpl_vars['article']->value['category']['title'];?>
</div>
        </div>
        <p class="anons"><?php echo $_smarty_tpl->tpl_vars['article']->value['anons'];?>
...</p>
        <div class="link">
            <a href="/articles/get/<?php echo $_smarty_tpl->tpl_vars['article']->value['link'];?>
/">Читать далее...</a>
        </div>
    </article>
    <hr>
<?php } ?>
</div>
<button name="More">Показать еще...</button><?php }} ?>