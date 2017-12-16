<div class="user-prof">
	<div class="up-first">
		<h1 class="nowrap">Пользователь: {usertitle}</h1>
		<div class="up-group">Группа: {status} [time_limit]&nbsp;В группе до: {time_limit}[/time_limit]</div>
		<div class="up-img img-box"><img src="{foto}" alt=""/></div>
		<div class="up-status">
			[online]<p class="online">В сети</p>[/online]
			[offline]<p class="offline">Не в сети</p>[/offline]
		</div>
	</div>
	<ul class="up-second flex-row">
		<li>{news-num} <p>Публикаций</p></li>
		<li>{comm-num} <p>Комментариев</p></li>
		<li>{email}</li>
		[not-group=5]<li>{pm}</li>[/not-group]
	</ul>
	<ul class="up-third flex-row">
		<li>Регистрация: {registration}</li>
		<li>Заходил(а): {lastdate}</li>
		[news-num]<li>{news} [rss] RSS [/rss]</li>[/news-num]
		[comm-num]<li>{comments}</li>[/comm-num]
		[not-group=5]
		[fullname]<li>Полное имя: {fullname}</li>[/fullname]
		[land]<li>Место жительства: {land}</li>[/land]
		[/not-group]
		<li>О себе: {info}</li>
	</ul>
	[not-logged]<div class="up-edit"> {edituser} </div>[/not-logged]
</div>
<script>
$(document).ready(function(){
	$(".short-item").wrapAll("<div class='clearfix' />");
	});
</script>
[not-logged]
<div id="options" style="display:none; margin-bottom: 30px" class="form-wrap">
<header class="form-title"><h1>Редактирование профиля:</h1></header>

<div class="sep-input clearfix">
<div class="label"><label>Ваше Имя:</div>
<div class="input"><input type="text" name="fullname" value="{fullname}" placeholder="Ваше Имя" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>Ваш E-Mail:</label></div>
<div class="input"><input type="text" name="email" value="{editmail}" placeholder="Ваш E-Mail: {editmail}" /></div>
</div>

<div class="sep-checks">
{hidemail}
<input style="margin-left: 50px" type="checkbox" id="subscribe" name="subscribe" value="1" /> <label for="subscribe">Отписаться от подписанных новостей</label>
</div>

<div class="sep-input clearfix">
<div class="label"><label>Место жительства:</label></div>
<div class="input"><input type="text" name="land" value="{land}" placeholder="Место жительства" /></div>
</div>

<div class="sep-textarea">
<div class="textarea-title">Список игнорируемых:</div>
{ignore-list}
</div>

<div class="sep-input clearfix">
<div class="label"><label>Старый пароль:</label></div>
<div class="input"><input type="password" name="altpass" placeholder="Старый пароль" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>Новый пароль:</label></div>
<div class="input"><input type="password" name="password1" placeholder="Новый пароль" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>Повторите пароль:</label></div>
<div class="input"><input type="password" name="password2" placeholder="Повторите Новый пароль" /></div>
</div>

<div class="sep-textarea">
<div class="textarea-title">Блокировка по IP (Ваш IP: {ip}):</div>
<div><textarea name="allowed_ip" style="height: 160px" rows="5" class="f_textarea" >{allowed-ip}</textarea></div>
<div style="margin-top: 10px">
					<span class="small" style="color:red;">
					* Внимание! Будьте бдительны при изменении данной настройки.
					Доступ к Вашему аккаунту будет доступен только с того IP-адреса или подсети, который Вы укажете.
					Вы можете указать несколько IP адресов, по одному адресу на каждую строчку.
					<br />
					Пример: 192.48.25.71 или 129.42.*.*</span>
</div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>Аватар:</label></div>
<div class="input"><input type="file" name="image" size="28" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>Сервис <a href="http://www.gravatar.com/" target="_blank">Gravatar</a>:</label></div>
<div class="input"><input type="text" name="gravatar" value="{gravatar}" placeholder="Укажите E-Mail в этом сервисе" /></div>
</div>

<div class="sep-checks"><input type="checkbox" name="del_foto" id="del_foto" value="yes" /> <label for="del_foto">Удалить аватар</label></div>

<div class="sep-input clearfix">
<div class="label"><label>Часовой пояс:</label></div>
<div class="input">{timezones}</div>
</div>

<div class="sep-textarea">
<div class="textarea-title">О себе:</div>
<div><textarea name="info" rows="5" class="f_textarea">{editinfo}</textarea></div>
</div>

<div class="sep-textarea">
<div class="textarea-title">Подпись:</div>
<div><textarea name="signature" rows="5" class="f_textarea">{editsignature}</textarea></div>
</div>

<div class="sep-xfield">
<div><table class="tableform">{xfields}</table></div>
</div>
<div class="sep-checks">{news-subscribe}</div>
<div class="sep-checks">{comments-reply-subscribe}</div>
<div class="sep-checks">{unsubscribe}</div>
<div class="sep-checks">{twofactor-auth}</div>
<div class="sep-submit">
<button name="submit" class="fbutton" type="submit"><span>Отправить</span></button>
<input name="submit" type="hidden" id="submit" value="submit" />
</div>
</div>
[/not-logged]