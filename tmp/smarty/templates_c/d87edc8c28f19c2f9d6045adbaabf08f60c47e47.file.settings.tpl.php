<?php /* Smarty version Smarty-3.1.6, created on 2015-03-07 09:38:07
         compiled from "../views/admin/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32459954754fa80afa33bd7-20090107%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd87edc8c28f19c2f9d6045adbaabf08f60c47e47' => 
    array (
      0 => '../views/admin/settings.tpl',
      1 => 1411650349,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32459954754fa80afa33bd7-20090107',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageTitle' => 0,
    'settings' => 0,
    'key' => 0,
    'item' => 0,
    'sitelogo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_54fa80b03b362',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fa80b03b362')) {function content_54fa80b03b362($_smarty_tpl) {?>				<div class="zaglav">
					<h1><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</h1>
				</div>
				
				<div class="settings_table">
					<form id="add_settings_form2" method="POST" action="action_item(1, 'settings', 'update', '#add_settings_form2'); return false;">
					    <table>
					        <tbody>
					    	    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['settings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
									<?php if ($_smarty_tpl->tpl_vars['key']->value==0||($_smarty_tpl->tpl_vars['key']->value!=0&&$_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->tpl_vars['key']->value]['type']!=$_smarty_tpl->tpl_vars['settings']->value[$_smarty_tpl->tpl_vars['key']->value-1]['type'])){?>
									    <tr>
										    <td colspan="3" style="text-align: left;">
											    <h2>
												<?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='contacts'){?>
												    Контактная информация
												<?php }?>
												<?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='site'){?>
												    Настройки сайта
												<?php }?>
												<?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='admin'){?>
												    Административная панель
												<?php }?>
												</h2>
											</td>
										</tr>
									<?php }?>
									<tr class="simple_settings">
					    			    <td style="width: 70px;"></td>
					    				<td><h3><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
:</h3></td>
					    			    <td>
					    				    <?php if ($_smarty_tpl->tpl_vars['item']->value['template']=='input'){?>
					    					    <input type="text" required placeholder="<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" data-alias="<?php echo $_smarty_tpl->tpl_vars['item']->value['option_alias'];?>
" />
					    					<?php }?>
					    				    <?php if ($_smarty_tpl->tpl_vars['item']->value['template']=='textarea'){?>
					    					    <textarea required placeholder="<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
" data-alias="<?php echo $_smarty_tpl->tpl_vars['item']->value['option'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</textarea>
					    					<?php }?>
					    				</td>
					    			</tr>
					    		<?php } ?>
					    		<tr>
					    		    <td style="width: 70px;"></td>
									<td><h3 class="simple_h3"><?php echo $_smarty_tpl->tpl_vars['sitelogo']->value['title'];?>
:</h3></td>
					    			<td>
                                        <input id="settings_hide_input_file2" data-alias="<?php echo $_smarty_tpl->tpl_vars['sitelogo']->value['option_alias'];?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['sitelogo']->value['value'];?>
" />
                                        <input id="settings_title2" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['sitelogo']->value['option_alias'];?>
" />
					    				<div class="filestatus">
                                        	<div class="choosen-file">
                                        	    <div class="file">
                                        		    <img src="/templates/admin/images/choosen-file.png" />
                                        			<h3><?php echo $_smarty_tpl->tpl_vars['sitelogo']->value['value'];?>
</h3>
                                        			<input type="button" value="Заменить" OnClick="upload_file(2, '#add_settings_tp_file2', 'add_settings_file2', 'settings'); return false;" />
                                        		</div>
                                        		<input type="button" class="del-file" OnClick="del_file('<?php echo $_smarty_tpl->tpl_vars['sitelogo']->value['value'];?>
', 'settings', 2);return false;" />
                                        	</div>
                                        </div>
					    			</td>
					    		</tr>
					        </tbody>
					    </table>
					</form>
					<form class="hide_file_form" id="add_settings_file2" enctype="multipart/form-data" method="post">
					    <input id="add_settings_tp_file2" type="file" name="file" accept="image/*,image/jpeg" />
					    <input type="submit" class="submit" value="Загрузить!" />
					</form>
				    <div class="choose">
				    	<input type="button" class="accept" value="Применить" OnClick="action_item(1, 'settings', 'update', '#add_settings_form2'); return false;" />
				    </div>
				    <div style="margin-top: 10px;">
				        <div class="msg success" id="updatesettings_success">Настройки применены!</div>
				        <div class="msg error" id="updatesettings_error">Неправильно заполнены поля формы!</div>
				    </div>
				</div><?php }} ?>