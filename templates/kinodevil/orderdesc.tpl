<link media="screen" href="{THEME}/images/orderdesc/style.css" type="text/css" rel="stylesheet" />
<!-- <script src="{THEME}/images/orderdesc/script.js"></script> -->

<div id="orderdesc-area">
	<h1 title="Стол заказов">Стол заказов</h1>
	<p>Наш сайт предлагает удобную услугу по поиску жалемого вами материала. Вам достаточно заполнить необходимые поля для поиска фильма/мультфильма/сериала/игры и мы постараемся в ближайшее время его найти и выложить на сайте.<br/>Помните, чем более подробную информацию вы укажете, тем быстрее фильм/мультфильм/сериал/игра будет найден и выложен у нас на сайте!</p>
	<div id="orderdesc-actions">
		[guest]<a href="#" id="orderdesc-add">Добавить заявку</a>[/guest]
		<form id="orderdesc-search-area" method="get">
			{searchqueries}
			<input type="text" value="Что ищем?" onfocus="if(this.value=='Что ищем?')this.value='';" onblur="if(this.value=='') this.value='Что ищем?';" MAXLENGTH="50" name="search" id="orderdesc-search-input" /><input type="submit" value="" id="orderdesc-search-find" />
		</form>
	</div>
	<div class="odclear"></div>
[guest]	<div id="orderdesc-add-area">
		<form method="post">
			<h4>Название на русском языке(*):</h4>
			<input type="text" name="title" id="orderdesc_title" class="orderdesc-add-input orderdesc-inputclass" />
			<ul id="orderdesc_related"></ul>
			<h4>Название на оригинальном языке:</h4>
			<input type="text" name="orig_title" class="orderdesc-add-input orderdesc-inputclass" />
			<h4>Что заказываем?:</h4>
			<select name="category" class="orderdesc-inputclass">{catlist}</select>
			<h4>Движок:</h4>
			<select name="year" class="orderdesc-inputclass">
				
				<option value="DLE">DLE</option>
				<option value="LB">LogicBoard</option>
				<option value="BE">Bullet Energy</option>
				<option value="FAPOS">FAPOS</option>
				<option value="" selected></option>
			</select>
			<h4>Ваши пожелания:</h4>
			<textarea name="descr" class="orderdesc-inputclass"></textarea>
			<input type="hidden" name="do" value="orderdesc" /><input type="hidden" name="action" value="addorder" />
			<input type="submit" value="Добавить" id="orderdesc-add-submit" />
		</form>
	</div>
[/guest]
[filters]	<div id="orderdesc-filters">{filters}<div class="odclear"></div></div>[/filters]
	<table id="orderdesc-table">
		<thead><tr>
			<td title="Статус заявки" width="16px"><i class="orderdesc-icon"></i></td>
			<td><a href="{url}&amp;sort=title" title="Сортировать по заголовку">Название</a></td>
			<td width="85px">Категория</td>
			<td width="90px">Заказчик</td>
			<td class="odtdcenter" width="75px"><a href="{url}&amp;sort=date" title="Сортировать по дате подачи заявки">Дата заказа</a></td>
			<td class="odtdcenter" width="30px"><a href="{url}&amp;sort=year" title="Сортировать по дате выхода">Версия</a></td>
			<td class="odtdcenter" width="40px" title="Рейтинг"><a class="orderdesc-icon orderdesc-rating-td" href="{url}&amp;sort=rating" title="Сортировать по рейтингу"></a></td>
		</tr></thead>
		<tbody>{list}</tbody>
	</table>
	
	[navigation]<div id="orderdesc-navigation">{navigation}</div>[/navigation]
</div>