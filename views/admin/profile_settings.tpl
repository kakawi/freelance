				<div class="zaglav">
					<h1>{$pageTitle}</h1>
				</div>
				
				<div class="settings_table">
					<form id="add_profile_form2" method="POST" action="action_item({$user.id}, 'users', 'update', '#add_profile_form2'); return false;">
					    <table>
					        <tbody>
									<tr class="simple_settings">
					    			    <td style="width: 70px;"></td>
					    				<td><h3>Никнейм или имя:</h3></td>
					    			    <td>
					    					<input type="text" required placeholder="Имя" value="{$user.name}" data-alias="name" />
					    				</td>
					    			</tr>
									<tr class="simple_settings">
					    			    <td style="width: 70px;"></td>
					    				<td><h3>E-mail:</h3></td>
					    			    <td>
					    					<input type="text" required placeholder="E-mail" value="{$user.email}" data-alias="email" />
					    				</td>
					    			</tr>
									<tr class="simple_settings">
					    			    <td style="width: 70px;"></td>
					    				<td><h3>Страница ВКонтакте:</h3></td>
					    			    <td>
					    					<input type="text" required placeholder="Страница ВКонтакте" value="{$user.vk}" data-alias="vk" />
					    				</td>
					    			</tr>
									<tr class="simple_settings">
					    			    <td style="width: 70px;"></td>
					    				<td><h3>Логин:</h3></td>
					    			    <td>
					    					<input type="text" required placeholder="Логин" value="{$user.login}" data-alias="login" />
					    				</td>
					    			</tr>
									<tr class="simple_settings">
					    			    <td style="width: 70px;"></td>
					    				<td><h3>Пароль:</h3></td>
					    			    <td>
					    					<input type="text" required placeholder="Пароль" value="{$user.password_current}" data-alias="password" />
					    				</td>
					    			</tr>
					        </tbody>
					    </table>
					</form>
				    <div class="choose">
				    	<input type="button" class="accept" value="Применить" OnClick="action_item({$user.id}, 'users', 'update', '#add_profile_form2'); return false;" />
				    </div>
				    <div style="margin-top: 10px;">
				        <div class="msg success" id="updateusers_success">Личные данные изменены!</div>
				        <div class="msg error" id="updateusers_error">Неправильно заполнены поля формы!</div>
						<div class="msg error" id="updateusers_invalidlogin">Недопустимый логин!</div>
				    </div>
				</div>