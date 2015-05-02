<?php /* Smarty version Smarty-3.1.6, created on 2015-03-14 23:52:05
         compiled from "../views/admin/show_description.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1402296561550483552f2dd8-22173107%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7076c43683709fffbc209418eabb58117a1fcb0' => 
    array (
      0 => '../views/admin/show_description.tpl',
      1 => 1412599745,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1402296561550483552f2dd8-22173107',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'showText' => 0,
    'item' => 0,
    'target_window' => 0,
    'keys_current' => 0,
    'keys_used' => 0,
    'keyinfo' => 0,
    'keyinfo2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_550483553a576',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550483553a576')) {function content_550483553a576($_smarty_tpl) {?>		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win" style="border-bottom: 1px solid #DDDDDD;">
					<h1><?php echo $_smarty_tpl->tpl_vars['showText']->value;?>
 "<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
"</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('<?php echo $_smarty_tpl->tpl_vars['target_window']->value;?>
', 0); return false;" />
				</div>
				<div id="descr_scroll" class="edit-raz" style="max-height: 480px; padding-top: 0; padding-bottom: 0; overflow: hidden; overflow-x: hidden; overflow-y: auto;">
					<div style="padding: 20px;">
					    <?php if (isset($_smarty_tpl->tpl_vars['item']->value['keys'][0])&&$_smarty_tpl->tpl_vars['item']->value['keys'][0]['steam_key']!=''){?>
					        <div class="show_game_keys_link">
							    <a id="keys_current_link" href="#" OnClick="show_game_keys('#keys_current', '#keys_used');return false;" style="background: #00AAFF; color: #FFFFFF;">На продажу <span class="keys_cnt"><?php echo $_smarty_tpl->tpl_vars['keys_current']->value;?>
</span></a>
								<a id="keys_used_link" href="#" OnClick="show_game_keys('#keys_used', '#keys_current');return false;">Проданные <span class="keys_cnt"><?php echo $_smarty_tpl->tpl_vars['keys_used']->value;?>
</span></a>
							</div>
							<div class="show_game_keys" id="keys_current" style="display: block; opacity: 1.0;">
							    <?php  $_smarty_tpl->tpl_vars['keyinfo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['keyinfo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['keys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['keyinfo']->key => $_smarty_tpl->tpl_vars['keyinfo']->value){
$_smarty_tpl->tpl_vars['keyinfo']->_loop = true;
?>
					    	        <?php echo $_smarty_tpl->tpl_vars['keyinfo']->value['steam_key'];?>
<br />
					    	    <?php } ?>
							</div>
							<div class="show_game_keys" id="keys_used">
					            <?php  $_smarty_tpl->tpl_vars['keyinfo2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['keyinfo2']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['keys_used']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['keyinfo2']->key => $_smarty_tpl->tpl_vars['keyinfo2']->value){
$_smarty_tpl->tpl_vars['keyinfo2']->_loop = true;
?>
					    	        <?php echo $_smarty_tpl->tpl_vars['keyinfo2']->value['steam_key'];?>
 <?php if ($_smarty_tpl->tpl_vars['keyinfo2']->value['email']!=''){?><span class="small_descr"><?php echo $_smarty_tpl->tpl_vars['keyinfo2']->value['email'];?>
</span><?php }?><br />
					    	    <?php } ?>
							</div>
					    <?php }else{ ?>
					        <?php echo $_smarty_tpl->tpl_vars['item']->value['description'];?>

					    <?php }?>
					</div>
				</div>
                <script>
                    $("#descr_scroll").mCustomScrollbar({
                        theme:"dark"
                    });
                </script>
				<div style="height: 100px;"></div>
			</div>		
		</div><?php }} ?>