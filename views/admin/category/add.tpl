	<div id="add_category_window" class="window-2">
		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win">
					<h1>Добавить рубрику</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('#add_category_window', 1); return false;" />
				</div>
				<div class="edit-raz" id="edit_category_scroll" style="max-height: 400px;">
					<form id="add_category_form" method="POST" action="action_item(0, 'category', 'add', '#add_category_form');">
						<input id="category_title" type="text" data-alias="title" placeholder="Название рубрики" />
					</form>
				</div>
				<div class="choose">
					<input type="button" class="accept" value="Добавить" OnClick="action_item(0, 'category', 'add', '#add_category_form'); return false;" />
					<input type="button" class="cancel" value="Отменить" OnClick="javascript:closeitem('#add_category_window', 1); return false;" />
				</div>
				<div style="width: 320px; margin-left: 34px; margin-top: -50px;">
				    <div class="msg success" id="addcategory_success">Статья добавлена!</div>
				    <div class="msg error" id="addcategory_error">Неправильно заполнены поля формы!</div>
				</div>
			</div>		
		</div>
	</div>
    <div id="edit_category_window" class="window-2">
	</div>