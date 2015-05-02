	<div id="add_articles_window" class="window-2">
		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win">
					<h1>Добавить статью</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('#add_articles_window', 1); return false;" />
				</div>
				<div class="edit-raz" id="edit_articles_scroll" style="max-height: 400px;">
					<form id="add_articles_form" method="POST" action="action_item(0, 'articles', 'add', '#add_articles_form');">
						<input id="articles_title" type="text" data-alias="title" placeholder="Название статьи" />
                        <br>
                            {html_options name=category options=$selectCategory }
						{*<div class="filestatus" style="padding-top: 5px; padding-bottom: 5px;">*}
							{*<div id="no_icon_uploaded" class="file">*}
								{*<img src="/templates/admin/images/file.png" />*}
								{*<h3>Нет файла...</h3>*}
								{*<input id="choose_news_icon" type="button" value="Выбрать файл" OnClick="upload_file(0, '#add_articles_tp_file', 'add_articles_file', 'articles');return false;"/>*}
							{*</div>*}
						{*</div>*}
						<div style="height: 50px;"></div>
						<textarea id="articles_description" data-alias="description" placeholder="Содержание статьи">Введите текст</textarea>
						<script>
						    CKEDITOR.replace('articles_description');
						</script>
					</form>
					<form class="hide_file_form" id="add_articles_file" enctype="multipart/form-data" method="post">
					    <input id="add_articles_tp_file" type="file" name="file" accept="image/*,image/jpeg" />
					    <input type="submit" class="submit" value="Загрузить!" />
					</form>
					<br />
				</div>	
				<div class="choose">
					<input type="button" class="accept" value="Добавить" OnClick="action_item(0, 'articles', 'add', '#add_articles_form'); return false;" />
					<input type="button" class="cancel" value="Отменить" OnClick="javascript:closeitem('#add_articles_window', 1); return false;" />
				</div>
				<div style="width: 320px; margin-left: 34px; margin-top: -50px;">
				    <div class="msg success" id="addarticles_success">Статья добавлена!</div>
				    <div class="msg error" id="addarticles_error">Неправильно заполнены поля формы!</div>
				</div>
			</div>		
		</div>
	</div>
    <div id="edit_articles_window" class="window-2">
	</div>