		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win">
					<h1>Редактировать рубрику</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('#edit_category_window', 1); return false;" />
				</div>
				<div class="edit-raz" id="edit_category_scroll2" style="max-height: 400px;">
					<form id="add_category_form2" method="POST" action="action_item({$category.id}, 'category', 'update', '#add_category_form2');">
						<input id="category_title2" type="text" data-alias="title" placeholder="Название статьи" value="{$category.title}" />
					</form>
				</div>	
				<div class="choose">
					<input type="button" class="accept" value="Изменить" OnClick="action_item({$category.id}, 'category', 'update', '#add_category_form2'); return false;" />
					<input type="button" class="cancel" value="Отменить" OnClick="javascript:closeitem('#edit_category_window', 1); return false;" />
				</div>
				<div style="width: 320px; margin-left: 34px; margin-top: -50px;">
				    <div class="msg success" id="updatecategory_success">Рубрика изменена!</div>
				    <div class="msg error" id="updatecategory_error">Неправильно заполнены поля формы!</div>
				</div>
			</div>		
		</div>