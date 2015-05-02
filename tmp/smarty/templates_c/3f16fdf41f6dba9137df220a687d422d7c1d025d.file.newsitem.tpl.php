<?php /* Smarty version Smarty-3.1.6, created on 2015-03-06 01:57:33
         compiled from "../views/default/newsitem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117025022654f8c33d1f6ac5-92460799%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f16fdf41f6dba9137df220a687d422d7c1d025d' => 
    array (
      0 => '../views/default/newsitem.tpl',
      1 => 1413348543,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117025022654f8c33d1f6ac5-92460799',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'newsitem' => 0,
    'templateWebPath' => 0,
    'siteurl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f8c33d2c42e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f8c33d2c42e')) {function content_54f8c33d2c42e($_smarty_tpl) {?>                <div class="col_100 newsitem_col_100">
                    <div class="newsitem">
                        <h2 style="height: 30px;">
                            <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['newsitem']->value['title'];?>
</span>
                        </h2>
                	    <img class="col_33 bigposter" src="/documents/news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['poster'];?>
" />
                        <div class="news_full_descr">
                	        <?php echo $_smarty_tpl->tpl_vars['newsitem']->value['description'];?>

                	    </div>
                        <div style="height: 70px; padding-left: 10px; padding-right: 10px;">
                	        <div class="newsdate market copyright">
							    <img src="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
images/published.png" style="opacity: 1.0 !important; cursor: default !important;" />
							    <?php echo $_smarty_tpl->tpl_vars['newsitem']->value['whenadd'];?>

							</div>
                            <div class="menu_bottom">
							    
                                <script type="text/javascript">(function() {
                                  if (window.pluso)if (typeof window.pluso.start == "function") return;
                                  if (window.ifpluso==undefined) { window.ifpluso = 1;
                                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                    var h=d[g]('body')[0];
                                    h.appendChild(s);
                                  }})();
							    </script>
							    
                                <div class="pluso" style="margin: 0; padding: 0; margin-left: -10px !important;" data-background="transparent" data-options="small,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,facebook,twitter,google,email" data-url="http://<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['link'];?>
/" data-title="<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['title'];?>
" data-description="<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['small_description'];?>
"></div>
                		    </div>
                	    </div>
                    </div>
                </div><?php }} ?>