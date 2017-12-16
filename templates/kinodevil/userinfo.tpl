<div class="user-prof">
	<div class="up-first">
		<h1 class="nowrap">������������: {usertitle}</h1>
		<div class="up-group">������: {status} [time_limit]&nbsp;� ������ ��: {time_limit}[/time_limit]</div>
		<div class="up-img img-box"><img src="{foto}" alt=""/></div>
		<div class="up-status">
			[online]<p class="online">� ����</p>[/online]
			[offline]<p class="offline">�� � ����</p>[/offline]
		</div>
	</div>
	<ul class="up-second flex-row">
		<li>{news-num} <p>����������</p></li>
		<li>{comm-num} <p>������������</p></li>
		<li>{email}</li>
		[not-group=5]<li>{pm}</li>[/not-group]
	</ul>
	<ul class="up-third flex-row">
		<li>�����������: {registration}</li>
		<li>�������(�): {lastdate}</li>
		[news-num]<li>{news} [rss] RSS [/rss]</li>[/news-num]
		[comm-num]<li>{comments}</li>[/comm-num]
		[not-group=5]
		[fullname]<li>������ ���: {fullname}</li>[/fullname]
		[land]<li>����� ����������: {land}</li>[/land]
		[/not-group]
		<li>� ����: {info}</li>
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
<header class="form-title"><h1>�������������� �������:</h1></header>

<div class="sep-input clearfix">
<div class="label"><label>���� ���:</div>
<div class="input"><input type="text" name="fullname" value="{fullname}" placeholder="���� ���" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>��� E-Mail:</label></div>
<div class="input"><input type="text" name="email" value="{editmail}" placeholder="��� E-Mail: {editmail}" /></div>
</div>

<div class="sep-checks">
{hidemail}
<input style="margin-left: 50px" type="checkbox" id="subscribe" name="subscribe" value="1" /> <label for="subscribe">���������� �� ����������� ��������</label>
</div>

<div class="sep-input clearfix">
<div class="label"><label>����� ����������:</label></div>
<div class="input"><input type="text" name="land" value="{land}" placeholder="����� ����������" /></div>
</div>

<div class="sep-textarea">
<div class="textarea-title">������ ������������:</div>
{ignore-list}
</div>

<div class="sep-input clearfix">
<div class="label"><label>������ ������:</label></div>
<div class="input"><input type="password" name="altpass" placeholder="������ ������" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>����� ������:</label></div>
<div class="input"><input type="password" name="password1" placeholder="����� ������" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>��������� ������:</label></div>
<div class="input"><input type="password" name="password2" placeholder="��������� ����� ������" /></div>
</div>

<div class="sep-textarea">
<div class="textarea-title">���������� �� IP (��� IP: {ip}):</div>
<div><textarea name="allowed_ip" style="height: 160px" rows="5" class="f_textarea" >{allowed-ip}</textarea></div>
<div style="margin-top: 10px">
					<span class="small" style="color:red;">
					* ��������! ������ ��������� ��� ��������� ������ ���������.
					������ � ������ �������� ����� �������� ������ � ���� IP-������ ��� �������, ������� �� �������.
					�� ������ ������� ��������� IP �������, �� ������ ������ �� ������ �������.
					<br />
					������: 192.48.25.71 ��� 129.42.*.*</span>
</div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>������:</label></div>
<div class="input"><input type="file" name="image" size="28" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>������ <a href="http://www.gravatar.com/" target="_blank">Gravatar</a>:</label></div>
<div class="input"><input type="text" name="gravatar" value="{gravatar}" placeholder="������� E-Mail � ���� �������" /></div>
</div>

<div class="sep-checks"><input type="checkbox" name="del_foto" id="del_foto" value="yes" /> <label for="del_foto">������� ������</label></div>

<div class="sep-input clearfix">
<div class="label"><label>������� ����:</label></div>
<div class="input">{timezones}</div>
</div>

<div class="sep-textarea">
<div class="textarea-title">� ����:</div>
<div><textarea name="info" rows="5" class="f_textarea">{editinfo}</textarea></div>
</div>

<div class="sep-textarea">
<div class="textarea-title">�������:</div>
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
<button name="submit" class="fbutton" type="submit"><span>���������</span></button>
<input name="submit" type="hidden" id="submit" value="submit" />
</div>
</div>
[/not-logged]