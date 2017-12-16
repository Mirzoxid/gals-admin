<!--noindex-->
<div class="add-comm-form clearfix" id="add-comm-form">

	<div class="ac-title">Прокомментировать <span class="fa fa-chevron-down"></span></div>
	<div class="ac-av img-box" id="ac-av">[not-group=5]<img src="{foto}" title="{login}" alt="{login}">[/not-group]</div>		

			[not-logged]
			<div class="ac-inputs clearfix">
				<input type="text" maxlength="35" name="name" id="name" placeholder="Ваше имя">
				<input type="text" maxlength="35" name="mail" id="mail" placeholder="Ваш e-mail (необязательно)">
			</div>
			[/not-logged]
			
			<div class="ac-textarea">{editor}</div>

[not-group=1]
			<div class="ac-protect">
				[question]
				<div class="sep-input clearfix">
					<div class="label"><span>Вопрос:</span><span class="impot">*</span> {question}</div>
					<div class="input"><input type="text" name="question_answer" id="question_answer" placeholder="Впишите ответ на вопрос" /></div>
				</div>
				[/question]
				[sec_code]
				<div class="sep-input clearfix">
					<div class="label">Введите код с картинки:<span class="impot">*</span></div>
					<div class="input"><input type="text" name="sec_code" id="sec_code" maxlength="45" />{sec_code}</div>
				</div>
				[/sec_code]
				[recaptcha]
				<div class="sep-input clearfix">
					<div class="label"><span>Подвердите, что вы не робот:</span><span class="impot">*</span></div>
					<div class="input">{recaptcha}</div>
				</div>
				[/recaptcha]
			</div>
[/not-group]

	<div class="ac-submit"><button name="submit" type="submit">Отправить</button></div>
</div>
<!--/noindex-->