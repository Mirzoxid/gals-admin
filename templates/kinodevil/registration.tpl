<div class="form-wrap">
<header class="form-title"><h1>[registration]�����������[/registration]
		[validation]���������� �������[/validation]</h1></header>

<div class="full-text sep-textarea">		
		[registration]
			<b>������������, ��������� ���������� ������ �����!</b><br />
			����������� �� ����� ����� �������� ��� ���� ��� ����������� ����������.
			�� ������� ��������� ������� �� ����, ��������� ���� �����������, ������������� ������� ����� � ������ ������.
			<br />� ������ ������������� ������� � ������������, ���������� � <a href="/index.php?do=feedback">��������������</a> �����.
		[/registration]
		[validation]
			<b>��������� ����������,</b><br />
			��� ������� ��� ��������������� �� ����� �����,
			������ ���������� � ��� �������� ��������, ������� ��������� �������������� ���� � ����� �������.
		[/validation]
</div>		

[registration]
<div class="sep-input clearfix">
<div class="label"><label for="name">�����:</label></div>
<div class="input"><input type="text" name="name" id="name" class="f_input" />
	<input class="register-check" title="��������� ����������� ������ ��� �����������" onclick="CheckLogin(); return false;" type="button" value="��������� ���" />
</div>
</div>

<div class="sep-textarea" id='result-registration'></div>

<div class="sep-input clearfix">
<div class="label"><label for="password1">������:</label></div>
<div class="input"><input type="password" name="password1" id="password1" class="f_input" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label for="password2">��������� ������:</label></div>
<div class="input"><input type="password" name="password2" id="password2" class="f_input" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label for="email">��� E-Mail:</label></div>
<div class="input"><input type="text" name="email" id="email" class="f_input" /></div>
</div>

<div class="sep-input secur clearfix">
<div class="label"><label>������ �� �����:</label></div>
<div class="input">
[question]
<div class="sec-label"><span>������:</span><span class="impot">*</span> {question}</div>
<div class="sec-answer"><input type="text" name="question_answer" placeholder="������� ����� �� ������" /></div>
[/question]
[sec_code]
<div class="sec-label">������� ��� � ��������:<span class="impot">*</span> </div>
<div class="sec-capcha clearfix"><input type="text" name="sec_code" id="sec_code" maxlength="45" />{reg_code}</div>
[/sec_code]
[recaptcha]
<div class="sec-label"><span>������� ��� �����, ���������� �� �����������:</span><span class="impot">*</span></div>
<div>{recaptcha}</div>
[/recaptcha]
</div>
</div>
[/registration]

[validation]
<div class="sep-input clearfix">
<div class="label"><label for="fullname">���� ���:</label></div>
<div class="input"><input type="text" id="fullname" name="fullname" class="f_input" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label for="land">����� ����������:</label></div>
<div class="input"><input type="text" id="land" name="land" class="f_input" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label for="image">����:</label></div>
<div class="input"><input type="file" id="image" name="image" class="f_input" /></div>
</div>

<div class="sep-textarea">
<div class="textarea-title">� ����:</div>
<div><textarea id="info" name="info" rows="8" class="f_textarea" /></textarea></div>
</div>

<div class="sep-xfield">
<div>{xfields}</div>
</div>
[/validation]

<div class="sep-submit">
<button name="submit" class="fbutton" type="submit"><span>���������</span></button>
</div>		

</div>