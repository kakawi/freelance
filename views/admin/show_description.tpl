		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win" style="border-bottom: 1px solid #DDDDDD;">
					<h1>{$showText} "{$item.title}"</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('{$target_window}', 0); return false;" />
				</div>
				<div id="descr_scroll" class="edit-raz" style="max-height: 480px; padding-top: 0; padding-bottom: 0; overflow: hidden; overflow-x: hidden; overflow-y: auto;">
					<div style="padding: 20px;">
					    {if isset($item.keys.0) && $item.keys.0.steam_key != ''}
					        <div class="show_game_keys_link">
							    <a id="keys_current_link" href="#" OnClick="show_game_keys('#keys_current', '#keys_used');return false;" style="background: #00AAFF; color: #FFFFFF;">На продажу <span class="keys_cnt">{$keys_current}</span></a>
								<a id="keys_used_link" href="#" OnClick="show_game_keys('#keys_used', '#keys_current');return false;">Проданные <span class="keys_cnt">{$keys_used}</span></a>
							</div>
							<div class="show_game_keys" id="keys_current" style="display: block; opacity: 1.0;">
							    {foreach from=$item.keys item=keyinfo}
					    	        {$keyinfo.steam_key}<br />
					    	    {/foreach}
							</div>
							<div class="show_game_keys" id="keys_used">
					            {foreach from=$item.keys_used item=keyinfo2}
					    	        {$keyinfo2.steam_key} {if $keyinfo2.email != ''}<span class="small_descr">{$keyinfo2.email}</span>{/if}<br />
					    	    {/foreach}
							</div>
					    {else}
					        {$item.description}
					    {/if}
					</div>
				</div>
                <script>
                    $("#descr_scroll").mCustomScrollbar({
                        theme:"dark"
                    });
                </script>
				<div style="height: 100px;"></div>
			</div>		
		</div>