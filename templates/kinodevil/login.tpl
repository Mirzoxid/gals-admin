<!--noindex--> 
[not-group=5]
    <div class="login-box" id="login-box" title="{login}">
		<div class="login-avatar">
				<div class="avatar-box" id="avatar-box">
					<img src="{foto}" title="{login}" alt="{login}" />
				</div>
				[group=1]<a href="{admin-link}" target="_blank">�����������</a>[/group]
             [group=2]<a href="{admin-link}" target="_blank">�����������</a>[/group]
		</div>
		<ul class="login-menu">
						<li><a href="{addnews-link}">�������� ����</a></li>
						<li><a href="{profile-link}">��� �������</a></li>
						<li><a href="{pm-link}">���������: ({new-pm})</a></li>
						<li><a href="{favorites-link}">��� �������� ({favorite-count})</a></li>
						<li><a href="{stats-link}">����������</a></li>
						<li><a href="{newposts-link}">�������������</a></li>
						<li><a href="/?do=lastcomments">��������� �����������</a></li>
						<li><a href="{logout-link}">�����</a></li>
		</ul>
	</div>
[/not-group]
[group=5]
    <div class="login-box" id="login-box" title="�����������">
		<div class="login-social clearfix">
			[vk]<a href="{vk_url}" target="_blank"><img src="{THEME}/images/social/vkontakte.png" /></a>[/vk]
			[odnoklassniki]<a href="{odnoklassniki_url}" target="_blank"><img src="{THEME}/images/social/odnoklassniki.jpg" /></a>[/odnoklassniki]
			[facebook]<a href="{facebook_url}" target="_blank"><img src="{THEME}/images/social/facebook.jpg" /></a>[/facebook]
			[mailru]<a href="{mailru_url}" target="_blank"><img src="{THEME}/images/social/mailru.gif" /></a>[/mailru]
			[google]<a href="{google_url}" target="_blank"><img src="{THEME}/images/social/google.jpg" /></a>[/google]
			[yandex]<a href="{yandex_url}" target="_blank"><img src="{THEME}/images/social/yandex.png" /></a>[/yandex]
		</div>
		<div class="login-form">
			<form method="post">
				<div class="login-input">
					<input type="text" name="login_name" id="login_name" placeholder="��� �����"/>
				</div>
				<div class="login-input">
					<input type="password" name="login_password" id="login_password" placeholder="��� ������" />
				</div>
				<div class="login-button">
					<button onclick="submit();" type="submit" title="����">����� �� ����</button>
					<input name="login" type="hidden" id="login" value="submit" />
				</div>
				<div class="login-checkbox">
					<input type="checkbox" name="login_not_save" id="login_not_save" value="1"/>
					<label for="login_not_save">&nbsp;����� ���������</label> 
				</div>
				<div class="login-links clearfix">
					<a href="{lostpassword-link}">������ ������?</a>
					<a href="/?do=register" class="log-register">�����������</a>
				</div>
			</form>
		</div>		
	</div>
[/group]
<!--/noindex-->