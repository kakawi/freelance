<?php /* Smarty version Smarty-3.1.6, created on 2015-03-07 00:03:58
         compiled from "../views/admin/sections/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154386197054f9fa1ec2a7e6-42545980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc8b93e5b09fb9e387605c737b0cb881f5c1af7b' => 
    array (
      0 => '../views/admin/sections/main.tpl',
      1 => 1411738666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154386197054f9fa1ec2a7e6-42545980',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageTitle' => 0,
    'sections' => 0,
    'key' => 0,
    'item' => 0,
    'pageTitle2' => 0,
    'pages' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f9fa1ecf04f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9fa1ecf04f')) {function content_54f9fa1ecf04f($_smarty_tpl) {?>				<div class="zaglav">
					<h1><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</h1>
					<input type="button" value="Добавить" OnClick="javascript:showitem('#add_sections_window');" />
				</div>
				
				<?php if (isset($_smarty_tpl->tpl_vars['sections']->value[0])){?>
				    <div class="table-cite">
				    	<table>
				    		<thead>
				    			<tr>
				    				<th style="width: 200px;"><h3>Название пункта меню</h3></th>
				    				<th><h3>Ссылка</h3></th>
				    				<th colspan="2"></th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
				    			    	<td style="width: 200px;">
										    <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" target="_blank"><h3><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h3></a>
										</td>
				    			    	<td>
										    <span class="small_descr"><?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
</span>
										</td>
				    			    	<td>
				    			    		<input type="button" class="edit-btn" OnClick="editajax(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
, 'sections', '#edit_sections_window');return false;" /> 
				    			    		<input type="button" class="delete-btn" OnClick="del_approve(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
, 'sections', '<?php echo $_smarty_tpl->tpl_vars['pageTitle2']->value;?>
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
									    <a class="page_active" href="/admin/sections/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
/" title="Страница <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
									<?php }else{ ?>
									    <a class="page" href="/admin/sections/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
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
						        <h3 style="display: inline-block;">Пункты меню ещё не созданы.</h3>
					            <a href="#" OnClick="javascript:showitem('#add_sections_window');return false;">
								    <h3 style="display: inline-block;">Создать</h3>
								</a>
						    </li>
						</ul>
					</div>
				<?php }?><?php }} ?>