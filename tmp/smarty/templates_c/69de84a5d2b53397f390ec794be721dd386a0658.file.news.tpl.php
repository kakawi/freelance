<?php /* Smarty version Smarty-3.1.6, created on 2015-03-06 01:55:08
         compiled from "../views/default/news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:115550041954f8c2ac6396d0-17110503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69de84a5d2b53397f390ec794be721dd386a0658' => 
    array (
      0 => '../views/default/news.tpl',
      1 => 1412424858,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '115550041954f8c2ac6396d0-17110503',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'news' => 0,
    'pages' => 0,
    'newsitem' => 0,
    'templateWebPath' => 0,
    'key' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f8c2ac7ba7e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f8c2ac7ba7e')) {function content_54f8c2ac7ba7e($_smarty_tpl) {?>                <?php if (isset($_smarty_tpl->tpl_vars['news']->value[0])){?>
				    <?php  $_smarty_tpl->tpl_vars['newsitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['newsitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['news']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['newsitem']->key => $_smarty_tpl->tpl_vars['newsitem']->value){
$_smarty_tpl->tpl_vars['newsitem']->_loop = true;
?>
				        <?php if (($_smarty_tpl->tpl_vars['pages']->value['per_page']%2==0&&$_smarty_tpl->tpl_vars['pages']->value['per_page']%3!=0)){?>
						    <div class="col_50 newsitem_col_50">
						<?php }else{ ?>
						    <div class="col_33 newsitem_col_33">
					    <?php }?>
				        	<div class="newsitem">
                                <h2 style="text-align: left;"><?php echo $_smarty_tpl->tpl_vars['newsitem']->value['title'];?>
</h2>
                                <img class="poster" src="/documents/news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['poster'];?>
" />
                                <div class="news_small_descr">
        	                        <?php echo $_smarty_tpl->tpl_vars['newsitem']->value['small_description'];?>

        	                    </div>
                                <div style="height: 70px;">
        	                        <div class="newsdate market copyright" style="margin-top: -3px;">
									    <img src="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
images/published.png" style="opacity: 1.0 !important; cursor: default !important;" />
									    <?php echo $_smarty_tpl->tpl_vars['newsitem']->value['whenadd'];?>

									</div>
									<div class="menu_bottom itreadmore">
                                        <a href="/news/<?php echo $_smarty_tpl->tpl_vars['newsitem']->value['link'];?>
/"><span class="readmore">Подробнее...</span></a>
									</div>
        	                    </div>
                            </div>
                        </div>
				    <?php } ?>
                    <div class="clearfix"></div>
                    <div class="spacer" style="height: 10px;"></div>
					<?php if ($_smarty_tpl->tpl_vars['pages']->value['count']>1){?>
                        <div class="clearfix pagination">
                            <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value){
$_smarty_tpl->tpl_vars['page']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['page']->key;
?>
				        	    <?php if ($_smarty_tpl->tpl_vars['key']->value!='current'&&$_smarty_tpl->tpl_vars['key']->value!='count'&&$_smarty_tpl->tpl_vars['key']->value!='per_page'){?>
				        	        <?php if ($_smarty_tpl->tpl_vars['page']->value==$_smarty_tpl->tpl_vars['pages']->value['current']){?>
				        	            <a class="page_active" href="/news/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
/" title="Страница <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
				        	        <?php }else{ ?>
        	                            <a class="page" href="/news/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
/" title="Страница <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
				        	        <?php }?>
				        	    <?php }?>
				        	<?php } ?>
                        </div>
					<?php }?>
				<?php }else{ ?>
				    <div class="col_100 newsitem_col_100">
					    <div class="newsitem">
						    Пока никто ничего не написал...
						</div>
					</div>
				<?php }?><?php }} ?>