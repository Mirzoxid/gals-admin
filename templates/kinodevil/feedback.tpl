<div class="form-wrap">
<header class="form-title"><h1>�������� �����</h1></header>

[not-logged]
<div class="sep-input clearfix">
<div class="label"><label>���� ���:<span class="impot">*</span></label></div>
<div class="input"><input type="text" maxlength="35" name="name" placeholder="���� ���" /></div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>��� E-Mail:<span class="impot">*</span></label></div>
<div class="input"><input type="text" maxlength="35" name="email" placeholder="��� �����" /></div>
</div>
[/not-logged]

<div class="sep-input clearfix">
<div class="label"><label>�������� ����:</label></div>
<div class="input">{recipient}</div>
</div>

<div class="sep-input clearfix">
<div class="label"><label>���� ���������:</label></div>
<div class="input"><input type="text" maxlength="45" name="subject" placeholder="���� ���������" /></div>
</div>

<div class="sep-textarea">
<div class="textarea-title">���� ������:</div>
<div><textarea name="message" style="height: 160px" class="f_textarea" ></textarea></div>
</div>

[not-group=1]
<div class="sep-input secur clearfix">
<div class="label"><label>������ �� �����:</label></div>
<div class="input">
[question]
<div class="sec-label"><span>������:</span><span class="impot">*</span> {question}</div>
<div class="sec-answer"><input type="text" name="question_answer" id="question_answer" placeholder="������� ����� �� ������" /></div>
[/question]
[sec_code]
<div class="sec-label">������� ��� � ��������:<span class="impot">*</span> </div>
<div class="sec-capcha clearfix"><input type="text" name="sec_code" maxlength="45" />{code}</div>
[/sec_code]
[recaptcha]
<div class="sec-label"><span>������� ��� �����, ���������� �� �����������:</span><span class="impot">*</span></div>
<div>{recaptcha}</div>
[/recaptcha]
</div>
</div>
[/not-group]

<div class="sep-submit">
<button name="send_btn" class="fbutton" type="submit"><span>���������</span></button>
</div>

</div>