<?php

$module = "Parser Kino Poisk for DLE v6.1"; 

define('DATALIFEENGINE', true);
define('ROOT_DIR', "..");
define('ENGINE_DIR', ROOT_DIR . '/engine');

require_once(ENGINE_DIR . '/data/config.php');

@header("Content-type: text/html; charset={$config['charset']}");

$site = $config['http_home_url'];

$year = date('Y');

echo <<<HTML
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="{$config['charset']}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow" />
    <title>Установка: {$module}</title>
    <!-- Bootstrap -->
    <link href="{$site}parserkinopoisk/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<style type="text/css">
    .blockInform { position: fixed; right: 0px; top: 0px; margin: 5px; padding: 5px; z-index: 1100; }
</style>
    
<!-- Окно запроса SQL -->

<div id="updateSQL" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
 <div class="modal-header">
  <h4 id="myModalLabel">Выполнение запроса в базу данных</h4>
 </div>
 <div class="modal-body" id="updateSQLinfo">
 
 <div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 100%">

 </div>
</div>
 
  
 </div>
 <div class="modal-footer">
  <button class="btn btn-primary" id="createdb_btn" data-dismiss="modal" aria-hidden="true" data-loading-text="Выполнение...">Закрыть</button>
 </div>
  </div>
 </div>
</div>

<!-- Окно запроса SQL закрыли -->
   
<div class="container">
<!-- Контейнер -->
			<div class="row">
			<!-- Row -->
				<div class="callout-block fade-in-b">
				<!-- Фон -->
				  <p class="text-center"><img src="{$site}parserkinopoisk/bootstrap/kinopoisk_dle.png" class="img-circle center-block" alt="{$module}"></p>
					<h1 class="text-center">{$module}</h1>
					<p class="text-center">Copyright (c) 2013-{$year} PspVolt</p>
	
	<p class="text-center"><a href="http://parser-kino.ru/" class="btn btn-danger" target="_blank">Другие наши модули <span class="glyphicon glyphicon-share" aria-hidden="true"></span></a></p>
				
				
		<div class="alert alert-success alert-dismissible fade in" role=alert> <button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button>		
       <p class="text-center"><strong>Спасибо за покупку!</strong> С уважением к Вам, Администрация сайта parser-kino.ru</p>
    </div>

   <div class="alert alert-info alert-dismissible fade in" role=alert> <button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button>		
      <p class="text-center">Устанавливая модуль Вы принимаете условия <a href="http://parser-kino.ru/licenzionnoe-soglashenie.html" target="_blank">лицензионного соглашения</a>.</p>
   </div>
   
  
  <div class="alert alert-danger alert-dismissible fade in" role=alert> <button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button>
  
 <blockquote><p>Проверка настроек сервера:</p>
HTML;

 if (version_compare(PHP_VERSION, '5.2.0') >= 0) {
 
  echo '<footer><span class="text-success">PHP '.PHP_VERSION.' - ok</span></footer>';
  
} else {

	echo '<footer><span class="text-warning">'.PHP_VERSION.' - рекомендуется использовать версию PHP не ниже 5.2</span></footer>';
	
}

if (extension_loaded('curl')) {
 
  echo '<footer><span class="text-success">curl - ok</span></footer>';
  
} else {

	echo '<footer><span class="text-warning">curl - не найдено, обратитесь к администратору для установки данной библиотеке</span></footer>';
	
}

if (function_exists( 'exif_imagetype' )) {
 
  echo '<footer><span class="text-success">exif_imagetype - ok</span></footer>';
  
} else {

	echo '<footer><span class="text-warning">exif_imagetype - не найдено, обратитесь к администратору для установки данной библиотеке</span></footer>';
	
}

if (extension_loaded('iconv')) {
 
  echo '<footer><span class="text-success">iconv - ok</span></footer>';
  
} else {

	echo '<footer><span class="text-warning">iconv - не найдено, обратитесь к администратору для установки данной библиотеке</span></footer>';
	
}

if (extension_loaded('mbstring')) {
 
  echo '<footer><span class="text-success">mbstring - ok</span></footer>';
  
} else {

	echo '<footer><span class="text-warning">mbstring - не найдено, обратитесь к администратору для установки данной библиотеке</span></footer>';
	
}

if (extension_loaded('ionCube Loader')) {

	echo '<footer><span class="text-success">ionCube - ok</span></footer>';
	
} else {

	echo '<footer><span class="text-warning">ionCube - не найдено, обратитесь к администратору для установки данной библиотеке</span></footer>';
	
}

echo <<<HTML
<p>Дополнительная проверка настроек сервера:</p>
<footer><span class="text-success"><a href="{$site}parserkinopoisk/test_ioncube.php" target="_blank">Проверить работу Ioncube</a> - выполнение по шагово.</span></footer>
<footer><span class="text-success"><a href="{$site}parserkinopoisk/test_curl.php" target="_blank">Проверить работу Curl</a> - перейдя по ссылки Вы увидели ответ - Curl работает. Если белый экран - Curl у вас не работает!</span></footer>
<footer><span class="text-success"><a href="{$site}parserkinopoisk/test_php.php" target="_blank">Проверка настроек php</a> - для разработчика.</span></footer>
 </blockquote>
 </div>
HTML;

echo <<<HTML

 <div class="well">
 
   <ul class="nav nav-tabs" role="tablist">
    <li style="width:50%; text-align:center;" role="presentation" class="active"><a href="#install" aria-controls="install" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Установка модуля на DLE v{$config['version_id']}</a></li>
    <li style="width:50%; text-align:center;" role="presentation"><a href="#update" aria-controls="update" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Обновление модуля на DLE v{$config['version_id']}</a></li>
   </ul>
   
   
   
   

  <div class="tab-content" style="border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; -webkit-border-radius: 0 0 4px 4px; -moz-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px; background-color:#fff; padding: 8px; margin-bottom: 8px;">

<!-- Установка -->

<div role="tabpanel" class="tab-pane fade in active" id="install">

HTML;
 
echo <<<HTML
<p><span class="badge">1</span>  Внести изменения в базу данных: <a href="#" class="btn btn-danger btn-lg" onclick="createdb(); return !1;">выполнить <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></p>
HTML;

if($config['version_id']<="10.1") {

echo <<<HTML
<p><span class="badge">2</span>  Открыть файл <strong>/engine/inc/addnews.php</strong></p>
<p><strong>Найти:</strong></p>
<pre>
echo "&lt;form method=post name=\"addnews\" id=\"addnews\" onsubmit=\"if(checkxf()=='fail') return false;\" action=\"\$PHP_SELF\"&gt;";
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
include (ENGINE_DIR . '/modules/parser-kinopoisk/js.php');
</pre>
<p><strong>Найти дальше примерно такой код:</strong></p>
<pre>
&lt;tr&gt;
&lt;td width="140" height="29" style="padding-left:5px;"&gt;{\$lang['addnews_title']}&lt;/td&gt;
&lt;td&gt;&lt;input class="edit bk" type="text" style="width:350px;" name="title" id="title"&gt;  &lt;input class="btn btn-mini" type="button" onClick="find_relates(); return false;" style="width:160px;" value="{\$lang['b_find_related']}"&gt; &lt;a href="#" class="hintanchor" onMouseover="showhint('{\$lang[hint_title]}', this, event, '220px')"&gt;[?]&lt;/a&gt;&lt;span id="related_news"&gt;&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
&lt;tr&gt;
&lt;td width="140" height="29" style="padding-left:5px"&gt;Парсер Кино Поиск:&lt;/td&gt;
&lt;td&gt;&lt;input class="edit bk" type="text" style="width:350px;" name="film_title" id="film_title" onkeypress="clickButton(event);"&gt;  &lt;input class="btn btn-danger" type="button" id="button_kp" onClick="films_kinopoisk(); return false;" style="width:160px;" value="Найти фильм"&gt;&lt;div id="torrent_info"&gt;&lt;/div&gt;&lt;/td&gt;
&lt;/tr&gt;

&lt;tr&gt;
&lt;td width="140" height="29" style="padding-left:5px"&gt;ID Кино Поиск:&lt;/td&gt;
&lt;td&gt;&lt;input class="edit bk" type="text" style="width:100px;" name="pspvolt_id" id="pspvolt_id"&gt; &lt;/td&gt;
&lt;/tr&gt;
</pre>
<p><strong>Найти дальше:</strong></p>
<pre>
\$row = \$db->insert_id();
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
// kinopoisk Start	
	
include (ENGINE_DIR . '/modules/parser-kinopoisk/addnews.php');	
	
// kinopoisk End
</pre>
<p><strong>Сохранить</strong></p>
<p><strong>Если у Вас версия DLE UTF-8 - после сохранения перекодируйте этот файл в UTF-8</strong></p>
HTML;
 
echo <<<HTML
<p><span class="badge">3</span>  Открыть файл <strong>/engine/inc/editnews.php</strong></p>
<p><strong>Найти:</strong></p>
<pre>
echo "&lt;form method=post name=\"addnews\" id=\"addnews\" onsubmit=\"if(checkxf()=='fail') return false;\" action=\"\"&gt;";
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
include (ENGINE_DIR . '/modules/parser-kinopoisk/js.php');
</pre>
<p><strong>Найти дальше примерно такой код:</strong></p>
<pre>
&lt;tr&gt;
&lt;td width="140" height="29" style="padding-left:5px;"&gt;{\$lang['edit_et']}&lt;/td&gt;
&lt;td&gt;&lt;input class="edit bk" type="text" style="width:350px;" name="title" id="title" value="{\$row['title']}"&gt; &lt;input class="btn btn-mini" type="button" onClick="find_relates(); return false;" style="width:160px;" value="{\$lang['b_find_related']}"&gt; &lt;a href="#" class="hintanchor" onMouseover="showhint('{\$lang[hint_title]}', this, event, '220px')"&gt;[?]&lt;/a&gt;&lt;span id="related_news"&gt;&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
&lt;tr&gt;
&lt;td width="140" height="29" style="padding-left:5px"&gt;Парсер Кино Поиск:&lt;/td&gt;
&lt;td&gt;&lt;input class="edit bk" type="text" style="width:350px;" name="film_title" id="film_title" value="{\$row['title']}" onkeypress="clickButton(event);"&gt;  &lt;input class="btn btn-danger" type="button" id="button_kp" onClick="films_kinopoisk(); return false;" style="width:160px;" value="Найти фильм"&gt;&lt;div id="torrent_info"&gt;&lt;/div&gt;&lt;/td&gt;
&lt;/tr&gt;

&lt;tr&gt;
&lt;td width="140" height="29" style="padding-left:5px"&gt;Парсер Кино Поиск:&lt;/td&gt;
&lt;td&gt;&lt;input class="edit bk" type="text" style="width:100px;" name="pspvolt_id" id="pspvolt_id" value="{\$row['kp_id_movie']}"&lt;/td&gt;
&lt;/tr&gt;
</pre>
<p><strong>Найти дальше:</strong></p>
<pre>
if( \$add_vote ) {
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
// kinopoisk Start	
	
include (ENGINE_DIR . '/modules/parser-kinopoisk/editnews.php');	
	
// kinopoisk End
</pre>
<p><strong>Сохранить</strong></p>
<p><strong>Если у Вас версия DLE UTF-8 - после сохранения перекодируйте этот файл в UTF-8</strong></p>
HTML;

} elseif($config['version_id']<="11.3") {
 
echo <<<HTML
<p><span class="badge">2</span>  Открыть файл <strong>/engine/inc/addnews.php</strong></p>
<p><strong>Найти:</strong></p>
<pre>
\$categories_list = CategoryNewsSelection( 0, 0 );
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
include (ENGINE_DIR . '/modules/parser-kinopoisk/js.php');
</pre>
<p><strong>Найти дальше примерно такой код:</strong></p>
<pre>
&lt;div class="form-group"&gt;
&lt;label class="control-label col-lg-2"&gt;{\$lang['addnews_title']}&lt;/label&gt;
&lt;div class="col-lg-10"&gt;
&lt;input type="text" style="width:100%;max-width:437px;" name="title" id="title"&gt; &lt;button onclick="find_relates(); return false;" class="btn btn-sm btn-black"&gt;{\$lang['b_find_related']}&lt;/button&gt; &lt;span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="{\$lang['hint_title']}" &gt;?&lt;/span&gt;&lt;span id="related_news"&gt;&lt;/span&gt;
&lt;/div&gt;
&lt;/div&gt;
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
&lt;div class="form-group"&gt;
&lt;label class="control-label col-lg-2"&gt;Парсер Кино Поиск:&lt;/label&gt;
&lt;div class="col-lg-10"&gt;
&lt;input type="text" style="width:100%;max-width:437px;" name="film_title" id="film_title" onkeypress="clickButton(event);"&gt; &lt;button id="button_kp" onClick="films_kinopoisk(); return false;" class="btn btn-sm btn-danger"&gt;Найти фильм&lt;/button&gt;&lt;span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Введите название фильма или ID Кино Поиска. После чего нажмите кнопку Найти фильм." &gt;?&lt;/span&gt;&lt;span id="torrent_info"&gt;&lt;/span&gt;
&lt;/div&gt;
&lt;/div&gt;

&lt;div class="form-group"&gt;
&lt;label class="control-label col-lg-2"&gt;ID Кино Поиск:&lt;/label&gt;
&lt;div class="col-lg-10"&gt;
&lt;input type="text" style="width:100%;max-width:100px;" name="pspvolt_id" id="pspvolt_id"&gt;
&lt;/div&gt;
&lt;/div&gt;
</pre>
<p><strong>Найти дальше:</strong></p>
<pre>
\$row = \$db->insert_id();
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
// kinopoisk Start	
	
include (ENGINE_DIR . '/modules/parser-kinopoisk/addnews.php');	
	
// kinopoisk End
</pre>
<p><strong>Сохранить</strong></p>
<p><strong>Если у Вас версия DLE UTF-8 - после сохранения перекодируйте этот файл в UTF-8</strong></p>
HTML;
 
echo <<<HTML
<p><span class="badge">3</span>  Открыть файл <strong>/engine/inc/editnews.php</strong></p>
<p><strong>Найти:</strong></p>
<pre>
\$categories_list = CategoryNewsSelection( \$cat_list, 0 );
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
include (ENGINE_DIR . '/modules/parser-kinopoisk/js.php');
</pre>
<p><strong>Найти дальше примерно такой код:</strong></p>
<pre>
&lt;div class="form-group"&gt;
&lt;label class="control-label col-lg-2"&gt;{\$lang['edit_et']}&lt;/label&gt;
&lt;div class="col-lg-10"&gt;
&lt;input type="text" style="width:437px;" name="title" id="title" value="{\$row['title']}"&gt; &lt;button onclick="find_relates(); return false;" class="btn btn-sm btn-black"&gt;{\$lang['b_find_related']}&lt;/button&gt; &lt;span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="{\$lang['hint_title']}" &gt;?&lt;/span&gt;&lt;span id="related_news"&gt;&lt;/span&gt;
&lt;/div&gt;
&lt;/div&gt;
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
&lt;div class="form-group"&gt;
&lt;label class="control-label col-lg-2"&gt;Парсер Кино Поиск:&lt;/label&gt;
&lt;div class="col-lg-10"&gt;
&lt;input type="text" style="width:100%;max-width:437px;" name="film_title" id="film_title" value="{\$row['title']}" onkeypress="clickButton(event);"&gt; &lt;button id="button_kp" onClick="films_kinopoisk(); return false;" class="btn btn-sm btn-danger"&gt;Найти фильм&lt;/button&gt;&lt;span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Введите название фильма или ID Кино Поиска. После чего нажмите кнопку Найти фильм." &gt;?&lt;/span&gt;&lt;span id="torrent_info"&gt;&lt;/span&gt;
&lt;/div&gt;
&lt;/div&gt;

&lt;div class="form-group"&gt;
&lt;label class="control-label col-lg-2"&gt;ID Кино Поиск:&lt;/label&gt;
&lt;div class="col-lg-10"&gt;
&lt;input type="text" style="width:100%;max-width:100px;" name="pspvolt_id" id="pspvolt_id" value="{\$row['kp_id_movie']}"&gt;
&lt;/div&gt;
&lt;/div&gt;
</pre>
<p><strong>Найти дальше:</strong></p>
<pre>
if( \$add_vote ) {
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
// kinopoisk Start	
	
include (ENGINE_DIR . '/modules/parser-kinopoisk/editnews.php');	
	
// kinopoisk End
</pre>
<p><strong>Сохранить</strong></p>
<p><strong>Если у Вас версия DLE UTF-8 - после сохранения перекодируйте этот файл в UTF-8</strong></p>
HTML;

} elseif($config['version_id']>="12.0") {
 
echo <<<HTML
<p><span class="badge">2</span>  Открыть файл <strong>/engine/inc/addnews.php</strong></p>
<p><strong>Найти:</strong></p>
<pre>
\$categories_list = CategoryNewsSelection( 0, 0 );
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
include (ENGINE_DIR . '/modules/parser-kinopoisk/js.php');
</pre>
<p><strong>Найти дальше примерно такой код:</strong></p>
<pre>
&lt;div class="form-group"&gt;
&lt;label class="control-label col-sm-2"&gt;{\$lang['edit_et']}&lt;/label&gt;
&lt;div class="col-sm-10"&gt;
&lt;input type="text" class="form-control width-550 position-left" name="title" id="title" maxlength="250" &gt;&lt;button onclick="find_relates(); return false;" class="visible-lg-inline-block btn bg-info-800 btn-sm btn-raised"&gt;{\$lang['b_find_related']}&lt;/button&gt;&lt;i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right" data-rel="popover" data-trigger="hover" data-placement="right" data-content="{\$lang['hint_title']}"&gt;&lt;/i&gt; &lt;span id="related_news"&gt;&lt;/span&gt;
&lt;/div&gt;	
&lt;/div&gt;
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
&lt;div class="form-group"&gt;
&lt;label class="control-label col-sm-2"&gt;Парсер Кино Поиск:&lt;/label&gt;
&lt;div class="col-sm-10"&gt;
&lt;input type="text" class="form-control width-550 position-left" name="film_title" id="film_title" maxlength="90" onkeypress="clickButton(event);"&gt; &lt;button id="button_kp" onClick="films_kinopoisk(); return false;" class="visible-lg-inline-block btn bg-info-800 btn-sm btn-danger"&gt;Найти фильм&lt;/button&gt;&lt;i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Введите название фильма или ID Кино Поиска. После чего нажмите кнопку Найти фильм."&gt;&lt;/i&gt;&lt;span id="torrent_info"&gt;&lt;/span&gt;
&lt;/div&gt;
&lt;/div&gt;

&lt;div class="form-group"&gt;
&lt;label class="control-label col-sm-2"&gt;ID Кино Поиск:&lt;/label&gt;
&lt;div class="col-sm-10"&gt;
&lt;input type="text" class="form-control" style="width:100px;" name="pspvolt_id" id="pspvolt_id" maxlength="11"&gt;
&lt;/div&gt;
&lt;/div&gt;
</pre>
<p><strong>Найти дальше:</strong></p>
<pre>
\$row = \$db->insert_id();
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
// kinopoisk Start	
	
include (ENGINE_DIR . '/modules/parser-kinopoisk/addnews.php');	
	
// kinopoisk End
</pre>
<p><strong>Сохранить</strong></p>
<p><strong>Если у Вас версия DLE UTF-8 - после сохранения перекодируйте этот файл в UTF-8</strong></p>
HTML;
 
echo <<<HTML
<p><span class="badge">3</span>  Открыть файл <strong>/engine/inc/editnews.php</strong></p>
<p><strong>Найти:</strong></p>
<pre>
\$categories_list = CategoryNewsSelection( \$cat_list, 0 );
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
include (ENGINE_DIR . '/modules/parser-kinopoisk/js.php');
</pre>
<p><strong>Найти дальше примерно такой код:</strong></p>
<pre>
&lt;div class="form-group"&gt;
&lt;label class="control-label col-sm-2"&gt;{\$lang['edit_et']}&lt;/label&gt;
&lt;div class="col-sm-10"&gt;
&lt;input type="text" class="form-control width-550 position-left" name="title" id="title" value="{\$row['title']}" maxlength="250"&gt;&lt;button onclick="find_relates(); return false;" class="visible-lg-inline-block btn bg-info-800 btn-sm btn-raised"&gt;{\$lang['b_find_related']}&lt;/button&gt;&lt;i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right" data-rel="popover" data-trigger="hover" data-placement="right" data-content="{\$lang['hint_title']}" &gt;&lt;/i&gt;&lt;span id="related_news"&gt;&lt;/span&gt;
&lt;/div&gt;
&lt;/div&gt;
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
&lt;div class="form-group"&gt;
&lt;label class="control-label col-sm-2"&gt;Парсер Кино Поиск:&lt;/label&gt;
&lt;div class="col-sm-10"&gt;
&lt;input type="text" class="form-control width-550 position-left" name="film_title" id="film_title" value="{\$row['title']}" maxlength="90" onkeypress="clickButton(event);"&gt; &lt;button id="button_kp" onClick="films_kinopoisk(); return false;" class="visible-lg-inline-block btn bg-info-800 btn-sm btn-danger"&gt;Найти фильм&lt;/button&gt;&lt;i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Введите название фильма или ID Кино Поиска. После чего нажмите кнопку Найти фильм."&gt;&lt;/i&gt;&lt;span id="torrent_info"&gt;&lt;/span&gt;
&lt;/div&gt;
&lt;/div&gt;

&lt;div class="form-group"&gt;
&lt;label class="control-label col-sm-2"&gt;ID Кино Поиск:&lt;/label&gt;
&lt;div class="col-sm-10"&gt;
&lt;input type="text" class="form-control" style="width:100px;" name="pspvolt_id" id="pspvolt_id" maxlength="11" value="{\$row['kp_id_movie']}"&gt;
&lt;/div&gt;
&lt;/div&gt;
</pre>
<p><strong>Найти дальше:</strong></p>
<pre>
if( \$add_vote ) {
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
// kinopoisk Start	
	
include (ENGINE_DIR . '/modules/parser-kinopoisk/editnews.php');	
	
// kinopoisk End
</pre>
<p><strong>Сохранить</strong></p>
<p><strong>Если у Вас версия DLE UTF-8 - после сохранения перекодируйте этот файл в UTF-8</strong></p>
HTML;

}

echo <<<HTML
<p><span class="badge">4</span>  Открыть файл <strong>/engine/modules/addnews.php</strong></p>
<p><strong>Найти:</strong></p>
<pre>
\$row['id'] = \$db->insert_id();
</pre>
<p><strong>Ниже добавить:</strong></p>
<pre>
// kinopoisk Start	
	
include (ENGINE_DIR . '/modules/parser-kinopoisk/addnews_m.php');	
	
// kinopoisk End
</pre>
<p><strong>Найти дальше:</strong></p>
<pre>
\$script .= "&lt;form method=\"post\" name=\"entryform\" id=\"entryform\" onsubmit=\"if(checkxf()=='fail') return false;\" action=\"\"&gt;";
</pre>
<p class="text-danger"><strong>Выше добавить:</strong></p>
<pre>
include (ENGINE_DIR . '/modules/parser-kinopoisk/js_s.php');
\$script .= \$parsing_script;
</pre>
<p><strong>Сохранить</strong></p>
HTML;

echo <<<HTML
<p><span class="badge">5</span>  Открыть файл <strong>/templates/{$config['skin']}/addnews.tpl</strong></p>
<p><strong>Вставить в любое место:</strong></p>
<pre>
&lt;tr&gt;
&lt;td&gt;Парсер Кино Поиск:&lt;/td&gt;
&lt;td&gt;&lt;input class="f_input" type="text" style="width:350px;" name="film_title" id="film_title" onkeypress="clickButton(event);"&gt;  &lt;input class="btn btn-danger btn-small" type="button" id="button_kp" onClick="films_kinopoisk(); return false;" style="width:160px;" value="Найти фильм" title="Введите название фильма или ID Кино Поиска. После чего нажмите кнопку Найти фильм."&gt;&lt;div id="torrent_info"&gt;&lt;/div&gt;&lt;/td&gt;
&lt;/tr&gt;

&lt;tr&gt;
&lt;td&gt;ID Кино Поиск:&lt;/td&gt;
&lt;td&gt;&lt;input type="text" name="pspvolt_id" id="pspvolt_id" onkeypress="clickButton(event);" style="width:100px;" class="f_input"&gt;&lt;/td&gt;
&lt;/tr&gt;
</pre>
<p><strong>Сохранить</strong></p>
HTML;

echo <<<HTML
<p><span class="badge">6</span>  Открыть файл <strong>/uploads/files/.htaccess</strong></p>
<p><strong>Найти:</strong></p>
<pre>
&lt;FilesMatch "\.(avi|divx|mp3|mp4|flv|swf|wmv|m4v|m4a|mov|mkv|3gp|f4v)$|^$"&gt;
</pre>
<p><strong>Заменить на:</strong></p>
<pre>
&lt;FilesMatch "\.(avi|divx|mp3|mp4|flv|swf|wmv|m4v|m4a|mov|mkv|3gp|f4v|torrent)$|^$"&gt;
</pre>
<p><strong>Сохранить</strong></p>
HTML;

echo <<<HTML
<p><span class="badge">7</span>  Скачайте файл лицензии в вашем профиле на сайте <strong>parser-kino.ru</strong></p>
<p>Распакуйте архив. Убедитесь что файл license.php не пустой. <strong class="text-danger">Если пустой скачайте повторно.</strong></p>
<p><strong>Скопируйте файл license.php в папку:</strong></p>
<pre>
/engine/modules/parser-kinopoisk/
</pre>
HTML;

echo <<<HTML
<p><span class="badge">8</span>  В панели управления DLE : <a href="{$site}{$config['admin_path']}?mod=usergroup" class="btn btn-danger" target="_blank">настройка групп пользователей <span class="glyphicon glyphicon-share" aria-hidden="true"></span></a></p>
<p>Каждой группе, на вкладке <strong class="text-danger">Новости</strong> добавляем в поле <strong class="text-danger">Расширение файлов, допустимых к загрузке</strong>: torrent</p>
HTML;

echo <<<HTML
<p><span class="badge">9</span>  Внести все настройки в: <a href="{$site}{$config['admin_path']}?mod=kinopoisk_dle" class="btn btn-danger" target="_blank">админ панели <span class="glyphicon glyphicon-share" aria-hidden="true"></span></a></p>
HTML;

echo <<<HTML

</div>

<!-- Установка закрыли -->

<!-- Обновление -->
   
<div role="tabpanel" class="tab-pane fade" id="update">

HTML;
 
echo <<<HTML
<p><span class="badge">1</span>  Внести изменения в базу данных: <a href="#" class="btn btn-danger btn-lg" onclick="createdb(); return !1;">выполнить <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></p>
HTML;

echo <<<HTML
<p><span class="badge">2</span><strong class="text-danger"> Обязательно  cкачайте файл лицензии</strong> в вашем профиле на сайте <strong>parser-kino.ru</strong></p>
<p>Распакуйте архив. Убедитесь что файл license.php не пустой. <strong class="text-danger">Если пустой скачайте повторно.</strong></p>
<p><strong>Замените файл license.php в папке:</strong></p>
<pre>
/engine/modules/parser-kinopoisk/
</pre>
HTML;

echo <<<HTML
<p><span class="badge">3</span>  Внести все настройки в: <a href="{$site}{$config['admin_path']}?mod=kinopoisk_dle" class="btn btn-danger" target="_blank">админ панели <span class="glyphicon glyphicon-share" aria-hidden="true"></span></a></p>
<p><strong class="text-danger">Настройки нужно внести обязательно, после каждого обновления добавляются новые функции.</strong></p>
HTML;


echo <<<HTML

</div>
   
<!-- Обновление закрыли -->


</div>

</div>

<div class="alert alert-danger alert-dismissible fade in" role=alert> <button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button>
<p class="text-center">Внимание! После успешной установки модуля или обновления - <strong>Нужно удалить папку parserkinopoisk с корня сайта!</strong></p>
</div>

<div class="alert alert-success alert-dismissible fade in" role=alert> <button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button>
<p class="text-center">Уважаемый клиент, если у вас возник вопрос или проблема появилась. Пишите на e-mail: info@parser-kino.ru или ICQ: 601300826</p>
</div>

 
 
        <!-- Фон закрыли -->
        </div>
     <!-- Row закрыли -->
     </div>
  <!-- Контейнер закрыли -->
  </div>

<!-- Скрипты старт -->
<script src="{$site}parserkinopoisk/bootstrap/js/jquery.js"></script>
<script src="{$site}parserkinopoisk/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
function createdb(){
	$('#createdb_btn').button('loading');
	$('#updateSQL').modal({ keyboard: false, backdrop: 'static'});
	$.post("{$site}parserkinopoisk/ajax.php",
		{action:"createdb"},
		function(data){
			$('#createdb_btn').button('reset');
			$('#updateSQLinfo').html(data);
		}
	);
}
$(function(){
  $('#createdb_btn').button('loading');
});

var showAlertTimer = [];
function showAlert(data, style) {
	var time = new Date().valueOf();
	if( $('div').is('.blockInform') == false ) {
		$('body').append("<div class=\"blockInform\"></div>");
	}
	$('.blockInform').prepend("<div class='alert "+style+"' id='timer_"+time+"'><button type='button' tmr='"+time+"' class='close' data-dismiss='alert'>&times;</button>"+data+"</div>");
	$('.blockInform button.close').click(function() {
		var id=$(this).attr('tmr');
		clearTimeout(showAlertTimer[id]);
		$('#timer_'+id).remove();
	});
	showAlertTimer[""+time+""] = setTimeout(function(){
		$('#timer_'+time).remove();
	}, 10000);
}
</script>
<!-- Скрипты закрыли -->
</body>
</html>
HTML;

?>