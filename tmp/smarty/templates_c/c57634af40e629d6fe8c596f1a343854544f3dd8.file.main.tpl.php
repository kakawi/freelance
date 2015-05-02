<?php /* Smarty version Smarty-3.1.6, created on 2015-03-15 20:02:34
         compiled from "../views/admin/category/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16751881675501f9f71938d6-41181825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c57634af40e629d6fe8c596f1a343854544f3dd8' => 
    array (
      0 => '../views/admin/category/main.tpl',
      1 => 1426394839,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16751881675501f9f71938d6-41181825',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5501f9f7250e4',
  'variables' => 
  array (
    'pageTitle' => 0,
    'category' => 0,
    'key' => 0,
    'item' => 0,
    'pageTitle2' => 0,
    'pages' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5501f9f7250e4')) {function content_5501f9f7250e4($_smarty_tpl) {?>				<div class="zaglav">
					<h1><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</h1>
					<input type="button" value="Добавить" OnClick="javascript:showitem('#add_category_window');" />
				</div>
				
				<?php if (isset($_smarty_tpl->tpl_vars['category']->value[0])){?>
				    <div class="table-cite">
				    	<table>
				    		<thead>
				    			<tr>
				    				<th><h3>Название рубрики</h3></th>
				    				<th colspan="2"></th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				    			    <?php if ($_smarty_tpl->tpl_vars['key']->value%2==0){?>
				    				    <tr id="sitesections_td-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
				    				<?php }else{ ?>
				    				    <tr id="sitesections_td-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="odd">
				    				<?php }?>
				    			    	<td>
											<a href="/articles/get/<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
/" target="_blank"><h3><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h3></a>
											<br />
											<span class="small_descr" style="font-size: 10px; color: #888888;"><?php echo $_smarty_tpl->tpl_vars['item']->value['whenadd'];?>
</span>
										</td>
				    			    	<td>
				    			    		<input type="button" class="edit-btn" OnClick="editajax(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
, 'category', '#edit_category_window');return false;" />
				    			    		<input type="button" class="delete-btn" OnClick="del_approve(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
, 'category', '<?php echo $_smarty_tpl->tpl_vars['pageTitle2']->value;?>
');return false;" />
				    			    	</td>
				    			    </tr>
				    			<?php } ?>
				    		</tbody>
				    	</table>
                        <div class="pagination">
                            <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value){
$_smarty_tpl->tpl_vars['page']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['page']->key;
?>
                                <?php if ($_smarty_tpl->tpl_vars['key']->value!='current'){?>
                                    <?php if ($_smarty_tpl->tpl_vars['page']->value==$_smarty_tpl->tpl_vars['pages']->value['current']){?>
                                        <a class="page_active" href="/admin/category/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
/" title="Страница <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
                                    <?php }else{ ?>
                                        <a class="page" href="/admin/category/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
/" title="Страница <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
                                    <?php }?>
                                <?php }?>
                            <?php } ?>
                        </div>
				    </div>
				<?php }else{ ?>
				    <div class="place-block">
					    <ul>
						    <li>
						        <h3 style="display: inline-block;">Новости ещё не созданы.</h3>
					            <a href="#" OnClick="javascript:showitem('#add_news_window');return false;">
								    <h3 style="display: inline-block;">Создать</h3>
								</a>
						    </li>
						</ul>
					</div>
				<?php }?><?php }} ?>