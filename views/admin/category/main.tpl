				<div class="zaglav">
					<h1>{$pageTitle}</h1>
					<input type="button" value="Добавить" OnClick="javascript:showitem('#add_category_window');" />
				</div>
				
				{if isset($category.0)}
				    <div class="table-cite">
				    	<table>
				    		<thead>
				    			<tr>
				    				<th><h3>Название рубрики</h3></th>
				    				<th colspan="2"></th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			{foreach from=$category item=item key=key}
				    			    {if $key%2 == 0}
				    				    <tr id="sitesections_td-{$item.id}">
				    				{else}
				    				    <tr id="sitesections_td-{$item.id}" class="odd">
				    				{/if}
				    			    	<td>
											<a href="/articles/get/{$item.link}/" target="_blank"><h3>{$item.title}</h3></a>
											<br />
											<span class="small_descr" style="font-size: 10px; color: #888888;">{$item.whenadd}</span>
										</td>
				    			    	<td>
				    			    		<input type="button" class="edit-btn" OnClick="editajax({$item.id}, 'category', '#edit_category_window');return false;" />
				    			    		<input type="button" class="delete-btn" OnClick="del_approve({$item.id}, 'category', '{$pageTitle2}');return false;" />
				    			    	</td>
				    			    </tr>
				    			{/foreach}
				    		</tbody>
				    	</table>
                        <div class="pagination">
                            {foreach from=$pages item=page key=key}
                                {if $key != 'current'}
                                    {if $page == $pages.current}
                                        <a class="page_active" href="/admin/category/{$page}/" title="Страница {$page}">{$page}</a>
                                    {else}
                                        <a class="page" href="/admin/category/{$page}/" title="Страница {$page}">{$page}</a>
                                    {/if}
                                {/if}
                            {/foreach}
                        </div>
				    </div>
				{else}
				    <div class="place-block">
					    <ul>
						    <li>
						        <h3 style="display: inline-block;">Новости ещё не созданы.</h3>
					            <a href="#" OnClick="javascript:showitem('#add_news_window');return false;">
								    <h3 style="display: inline-block;">Создать</h3>
								</a>
						    </li>
						</ul>
					</div>
				{/if}