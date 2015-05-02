		<div class="window-bg">
			<div class="window" style="width: 960px;">
				<div class="zaglav-win">
					<h1>Редактировать статью</h1>
					<input type="button" class="close" OnClick="javascript:closeitem('#edit_articles_window', 1); return false;" />
				</div>
				<div class="edit-raz" id="edit_articles_scroll2" style="max-height: 400px;">
					<form id="add_articles_form2" method="POST" action="action_item({$articles.id}, 'articles', 'update', '#add_articles_form2');">
						<input id="articles_title2" type="text" data-alias="title" placeholder="Название статьи" value="{$articles.title}" />
                        <br>
                        {html_options name=category options=$selectCategory }
						<div style="height: 50px;"></div>
						<textarea id="news_description2" data-alias="description" placeholder="Содержание статьи">{$articles.description}</textarea>
						<script>
						    CKEDITOR.replace('news_description2');
                            $("#edit_news_scroll2").mCustomScrollbar({
                                theme:"dark"
                            });
						</script>
					</form>
					<form class="hide_file_form" id="add_news_file2" enctype="multipart/form-data" method="post">
					    <input id="add_news_tp_file2" type="file" name="file" accept="image/*,image/jpeg" />
					    <input type="submit" class="submit" value="Загрузить!" />
					</form>
					<br />
				</div>	
				<div class="choose">
					<input type="button" class="accept" value="Изменить" OnClick="action_item({$articles.id}, 'articles', 'update', '#add_articles_form2'); return false;" />
					<input type="button" class="cancel" value="Отменить" OnClick="javascript:closeitem('#edit_articles_window', 1); return false;" />
				</div>
				<div style="width: 320px; margin-left: 34px; margin-top: -50px;">
				    <div class="msg success" id="updatearticles_success">Статья изменена!</div>
				    <div class="msg error" id="updatearticles_error">Неправильно заполнены поля формы!</div>
				</div>
			</div>		
		</div>