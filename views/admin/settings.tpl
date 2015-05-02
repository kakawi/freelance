				<div class="zaglav">
					<h1>{$pageTitle}</h1>
				</div>
				
				<div class="settings_table">
					<form id="add_settings_form2" method="POST" action="action_item(1, 'settings', 'update', '#add_settings_form2'); return false;">
					    <table>
					        <tbody>
					    	    {foreach from=$settings item=item key=key}
									{if $key == 0 || ($key != 0 && $settings[$key].type != $settings[$key-1].type)}
									    <tr>
										    <td colspan="3" style="text-align: left;">
											    <h2>
												{if $item.type == 'contacts'}
												    Контактная информация
												{/if}
												{if $item.type == 'site'}
												    Настройки сайта
												{/if}
												{if $item.type == 'admin'}
												    Административная панель
												{/if}
												</h2>
											</td>
										</tr>
									{/if}
									<tr class="simple_settings">
					    			    <td style="width: 70px;"></td>
					    				<td><h3>{$item.title}:</h3></td>
					    			    <td>
					    				    {if $item.template == 'input'}
					    					    <input type="text" required placeholder="{$item.title}" value="{$item.value}" data-alias="{$item.option_alias}" />
					    					{/if}
					    				    {if $item.template == 'textarea'}
					    					    <textarea required placeholder="{$item.title}" data-alias="{$item.option}">{$item.value}</textarea>
					    					{/if}
					    				</td>
					    			</tr>
					    		{/foreach}
					    		<tr>
					    		    <td style="width: 70px;"></td>
									<td><h3 class="simple_h3">{$sitelogo.title}:</h3></td>
					    			<td>
                                        <input id="settings_hide_input_file2" data-alias="{$sitelogo.option_alias}" type="hidden" value="{$sitelogo.value}" />
                                        <input id="settings_title2" type="hidden" value="{$sitelogo.option_alias}" />
					    				<div class="filestatus">
                                        	<div class="choosen-file">
                                        	    <div class="file">
                                        		    <img src="/templates/admin/images/choosen-file.png" />
                                        			<h3>{$sitelogo.value}</h3>
                                        			<input type="button" value="Заменить" OnClick="upload_file(2, '#add_settings_tp_file2', 'add_settings_file2', 'settings'); return false;" />
                                        		</div>
                                        		<input type="button" class="del-file" OnClick="del_file('{$sitelogo.value}', 'settings', 2);return false;" />
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
				</div>