<div class="form-wrap">
<header class="form-title"><h1>������������ ������</h1></header>

<div class="sep-input clearfix">
<div class="label"><label>��� �����:</label></div>
<div class="input"><input type="text" name="lostname" placeholder="��� ����� ��� E-Mail �� �����" /></div>
</div>

<div class="sep-input secur clearfix">
<div class="label"><label>������ �� �����:</label></div>
<div class="input">
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

<div class="sep-submit">
<button name="submit" class="fbutton" type="submit"><span>���������</span></button>
</div>

</div>