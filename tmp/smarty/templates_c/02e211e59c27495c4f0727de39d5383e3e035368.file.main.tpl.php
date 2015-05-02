<?php /* Smarty version Smarty-3.1.6, created on 2015-03-07 00:03:42
         compiled from "../views/admin/keys/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:148263935354f9fa0e6e93f5-15018091%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02e211e59c27495c4f0727de39d5383e3e035368' => 
    array (
      0 => '../views/admin/keys/main.tpl',
      1 => 1412668319,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '148263935354f9fa0e6e93f5-15018091',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageTitle' => 0,
    'pageTitle2' => 0,
    'games' => 0,
    'key' => 0,
    'item' => 0,
    'pages' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54f9fa0e7ec3d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9fa0e7ec3d')) {function content_54f9fa0e7ec3d($_smarty_tpl) {?>				<div class="zaglav">
					<h1><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</h1>
					<input type="button" value="Добавить" OnClick="javascript:showitem('#add_keys_window');" />
					<input type="button" value="Удалить проданные" OnClick="javascript:del_approve(0, 'keys', '<?php echo $_smarty_tpl->tpl_vars['pageTitle2']->value;?>
');" style="width: 160px; margin-top: -33px; margin-right: 84px;" />
				</div>
				
				<?php if (isset($_smarty_tpl->tpl_vars['games']->value[0])){?>
				    <div class="table-cite">
				    	<table>
				    		<thead>
				    			<tr>
				    				<th><h3>Название игры</h3></th>
				    				<th><h3>Ключи</h3></th>
									<th><h3>Обложка</h3></th>
				    				<th colspan="2"></th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['games']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
											<a href="/games/<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
/" target="_blank"><h3><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h3></a>
										</td>
				    			    	<td>
											<?php if ($_smarty_tpl->tpl_vars['item']->value['keys']==0||$_smarty_tpl->tpl_vars['item']->value['keys']=='0'){?>
											    <span class="small_descr" style="color: #AA0000;">
												    Нет ключей.
												</span>
											<?php }else{ ?>
												<span class="small_descr">
												    Ключей на продажу: <?php echo $_smarty_tpl->tpl_vars['item']->value['keys'];?>

												</span>
											    <br />
											    <a href="#" OnClick="show_description(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
, 'keys', '#edit_keys_window', 'Просмотр ключей для игры');return false;"><h3>Показать ключи</h3></a>
											<?php }?>
										</td>
				    			    	<td>
				    					    <a href="/documents/games/<?php echo $_smarty_tpl->tpl_vars['item']->value['poster'];?>
" target="_blank">
				    						    <img class="section_icon" src="/documents/games/<?php echo $_smarty_tpl->tpl_vars['item']->value['poster'];?>
" data-item="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
				    						</a>
				    						<div class="section_icon_big" id="section_icon_big-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
				    						    <div class="section_icon_big_wrapper">
				    							    <img class="big_section_icon" src="/documents/games/<?php echo $_smarty_tpl->tpl_vars['item']->value['poster'];?>
" />
				    							</div>
				    						</div>
				    					</td>
				    			    	<td>
				    			    		<input type="button" class="edit-btn" OnClick="editajax(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
, 'keys', '#edit_keys_window');return false;" /> 
				    			    		<input type="button" class="delete-btn" OnClick="del_approve(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
, 'keys', '<?php echo $_smarty_tpl->tpl_vars['pageTitle2']->value;?>
');return false;" title="Это действие удалит ВСЕ ключи" />
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
									    <a class="page_active" href="/admin/keys/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
/" title="Страница <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
									<?php }else{ ?>
									    <a class="page" href="/admin/keys/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
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
						        <h3 style="display: inline-block;">Ключи ещё не добавлены.</h3>
					            <a href="#" OnClick="javascript:showitem('#add_games_window');return false;">
								    <h3 style="display: inline-block;">Добавить</h3>
								</a>
						    </li>
						</ul>
					</div>
				<?php }?><?php }} ?>