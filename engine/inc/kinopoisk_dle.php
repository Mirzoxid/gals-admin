<?php

if( !defined( 'DATALIFEENGINE' ) OR !defined( 'LOGGED_IN' ) ) {
	die( "Hacking attempt!" );
}

if( $member_id['user_group'] != 1 ) {
	msg( "error", $lang['addnews_denied'], $lang['db_denied'] );
}

if( file_exists(ENGINE_DIR.'/data/kinopoisk_parser.php') ) {
	require_once ENGINE_DIR.'/data/kinopoisk_parser.php';
} else {
	file_put_contents(ENGINE_DIR.'/data/kinopoisk_parser.php', "<?php\nif(!defined('DATALIFEENGINE')){die(\"Hacking attempt!\");}\n//Parser Kino Poisk for DLE\n//Configurations\n\$config_kinopoisk = array (\n);\n?>");
  require_once ENGINE_DIR.'/data/kinopoisk_parser.php';
}


function convert_shablon_tpl($text) {

global $config;

if ($config['charset'] == "utf-8") {

$text = iconv('windows-1251', 'UTF-8', $text);

}

$text = stripslashes($text);

$text = str_replace('"', '&quot;', $text);

return $text;

}

if( file_exists(ENGINE_DIR.'/modules/parser-kinopoisk/torrent_steps.php') ) {

$torrent_php = 'on';

}

if( file_exists(ENGINE_DIR.'/modules/parser-kinopoisk/video_steps.php') ) {

$video_php = 'on';

}

$config['version_id'] = '10';


if ($config['version_id'] >= '10.2') {


echoheader( "<i class=\"icon-film\"></i>".'Parser Kino Poisk for DLE '.$config_kinopoisk['version'], '' );

} else {



echo <<<HTML

<!doctype html>
<html>
<head>
  <meta charset="{$config['charset']}">
  <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <title>DataLife Engine - ������ ����������</title>
  <link href="{$config['http_home_url']}engine/modules/parser-kinopoisk/adminka/css/application.css" media="screen" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="{$config['http_home_url']}engine/modules/parser-kinopoisk/adminka/css/application.js"></script>
</head>
<body>
<script type="text/javascript">
<!--
var dle_act_lang   = ["��", "���", "����", "������", "�������� ����������� � ������ �� ������"];
var cal_language   = {en:{months:['������','�������','����','������','���','����','����','������','��������','�������','������','�������'],dayOfWeek:["��", "��", "��", "��", "��", "��", "��"]}};
//-->
</script>
<div id="loading-layer">����������, ���������...</div>
<div id="maincontainer">
<nav class="navbar navbar-default navbar-inverse navbar-static-top" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" href="{$config['http_home_url']}{$config['admin_path']}"><img src="{$config['http_home_url']}engine/modules/parser-kinopoisk/adminka/logo.png" /></a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-primary">
          <span class="sr-only">Side Navigation</span>
          <i class="icon-th-list"></i>
        </button>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
          <span class="sr-only">Top Navigation</span>
          <i class="icon-align-justify"></i>
        </button>	
  </div>
      <div class="collapse navbar-collapse navbar-collapse-top">
        <div class="navbar-right">

          <ul class="nav navbar-nav navbar-left">
            <li class="cdrop mobilehidden"><a href="#" onclick="toggleleftpanel();return false;"><i class="icon-exchange"></i></a></li>
			<li class="cdrop boxedhidden"><a href="{$config['http_home_url']}{$config['admin_path']}?mod=options&action=options">��� ������� ������</a></li>
            <li class="cdrop"><a href="{$config['http_home_url']}" target="_blank">�������� �����</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle dropdown-avatar" data-toggle="dropdown">
              <span>
                <img class="menu-avatar" src="{$config['http_home_url']}engine/modules/parser-kinopoisk/adminka/noavatar.png" /> <span>{$member_id['name']} <i class="icon-caret-down"></i></span>
                
              </span>
              </a>
              <ul class="dropdown-menu">
                <li class="with-image">
                  <div class="avatar">
                    <img src="{$config['http_home_url']}engine/modules/parser-kinopoisk/adminka/noavatar.png" />
                  </div>
                  <span>{$member_id['name']}<br />(��������������)</span>
                </li>
                <li class="divider"></li>
                <li><a href="{$config['http_home_url']}user/{$member_id['name']}/" target="_blank"><i class="icon-user"></i> <span>�������</span></a></li>
                <li><a href="{$config['http_home_url']}{$config['admin_path']}?mod=options&action=personal"><i class="icon-cog"></i> <span>���������</span></a></li>
                <li><a href="{$config['http_home_url']}index.php?do=pm" target="_blank"><i class="icon-envelope"></i> <span>���������</span> </a></li>
                <li><a href="{$config['http_home_url']}{$config['admin_path']}?action=logout"><i class="icon-off"></i> <span>�����</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
</nav>
<div class="sidebar-background">
  <div class="primary-sidebar-background"></div>
</div>
<div class="primary-sidebar">
<ul class="nav navbar-collapse collapse navbar-collapse-primary"><li><span class="glow"></span><a href="{$config['http_home_url']}{$config['admin_path']}?mod=options&action=options"><i class="icon-globe icon-2x"></i><span>��� ������� ������</span></a></li>
</li></ul>
</div>
<div class="main-content">
  <div class="container">
    <div class="row">
      <div class="area-top clearfix">
        <div class="pull-left header">
          <h3 class="title"><div class="avatar"><i class="icon-film"></i></div>Parser Kino Poisk for DLE {$config_kinopoisk['version']}</h3>
          <h5><span></span></h5>
        </div>
        <div class="pull-right padding-right newsbutton">
			<div class="action-nav-normal action-nav-line" style="display: inline-block;">
				<div class="action-nav-button nav-small" style="width:180px;">
				  <a href="{$config['http_home_url']}{$config['admin_path']}?mod=addnews&amp;action=addnews" class="tip" title="�������� �������">
					<i class="icon-file-alt"></i>
					<span>�������� �������</span>
				  </a>
				  <span class="triangle-button red"><i class="icon-plus"></i></span>
				</div>
			</div>
			<div class="action-nav-normal action-nav-line" style="display: inline-block;">
				<div class="action-nav-button nav-small" style="width:180px;">
				  <a href="{$config['http_home_url']}{$config['admin_path']}?mod=editnews&amp;action=list" class="tip" title="������������� �������">
					<i class="icon-edit"></i>
					<span>������������� �������</span>
				  </a>
				  <span class="triangle-button blue"><i class="icon-pencil"></i></span>
				</div>
			</div>
          </div>
      </div>
    </div>
  </div>
  <div class="container padded-right">
	<!-- maincontent beginn -->

HTML;

}

if ($config['version_id'] >= '10.2') {

echo <<<HTML
<style>
.settingsb { text-align: center;}
.settingsb li { margin: 5px 5px 0 5px; position: relative; display: inline-block; text-align: center; }
.settingsb li a { 
	background: #f7f7f7;
	background: -moz-linear-gradient(top,  #f7f7f7 0%, #efefef 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f7f7f7), color-stop(100%,#efefef));
	background: -webkit-linear-gradient(top,  #f7f7f7 0%,#efefef 100%);
	background: -o-linear-gradient(top,  #f7f7f7 0%,#efefef 100%);
	background: -ms-linear-gradient(top,  #f7f7f7 0%,#efefef 100%);
	background: linear-gradient(top,  #f7f7f7 0%,#efefef 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#efefef',GradientType=0 );
	border: 1px solid #d5d5d5;
	box-shadow: 0 0 0 1px #fcfcfc inset, 0 1px 1px #d5d5d5;
	-webkit-box-shadow: 0 0 0 1px #fcfcfc inset, 0 1px 1px #d5d5d5;
	-moz-box-shadow: 0 0 0 1px #fcfcfc inset, 0 1px 1px #d5d5d5;
	padding: 10px 10px 2px 10px;
	display: block;
	font-weight: 600;
	white-space: nowrap;
	color: #626262;
}
.settingsb li a:hover {  
	background: #f7f7f7;
	background: -moz-linear-gradient(top,  #f7f7f7 0%, #f2f2f2 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f7f7f7), color-stop(100%,#e6ef2f2f26e6));
	background: -webkit-linear-gradient(top,  #f7f7f7 0%,#f2f2f2 100%);
	background: -o-linear-gradient(top,  #f7f7f7 0%,#f2f2f2 100%);
	background: -ms-linear-gradient(top,  #f7f7f7 0%,#f2f2f2 100%);
	background: linear-gradient(top,  #f7f7f7 0%,#f2f2f2 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#f2f2f2',GradientType=0 );
}
.settingsb li a:active {  
	box-shadow: none;
	background: #f4f4f4;
	background: -moz-linear-gradient(top,  #f4f4f4 0%, #f7f7f7 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f2f2f2), color-stop(100%,#f7f7f7));
	background: -webkit-linear-gradient(top,  #f4f4f4 0%,#f7f7f7 100%);
	background: -o-linear-gradient(top,  #f4f4f4 0%,#f7f7f7 100%);
	background: -ms-linear-gradient(top,  #f4f4f4 0%,#f7f7f7 100%);
	background: linear-gradient(top,  #f4f4f4 0%,#f7f7f7 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f4f4f4', endColorstr='#f7f7f7',GradientType=0 );
}
.settingsb li a > span { display: block; padding-top: 4px; }

.settingsb a > i {
	font-size: 32px;
	color: #808080;
}
</style>
HTML;

}

echo <<<HTML

<script type="text/javascript">
	$(function(){
		$('[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		  var id;
		  id = $(e.target).attr("href");
		  $(id).find(".cat_select").chosen({allow_single_deselect:true, no_results_text: '������ �� �������'});
		});
	});
</script>


 <script language='JavaScript' type="text/javascript">

        function ChangeOption(selectedOption) {

                document.getElementById('general').style.display = "none";
                document.getElementById('actor').style.display = "none";
                document.getElementById('curl').style.display = "none";
                document.getElementById('images').style.display = "none";
                document.getElementById('templates').style.display = "none";
                document.getElementById('category').style.display = "none";
                document.getElementById('sinonim').style.display = "none";
                document.getElementById('trailer').style.display = "none";
                document.getElementById('alt_tech').style.display = "none";

HTML;
               
if ($torrent_php == 'on') {

echo <<<HTML
              document.getElementById('torrent').style.display = "none";
                          
HTML;

}
                
if ($video_php == 'on') {                

echo <<<HTML
                document.getElementById('video').style.display = "none";
HTML;
                               
}



echo <<<HTML
                document.getElementById('actors').style.display = "none";
HTML;
                
               

echo <<<HTML
                
                document.getElementById(selectedOption).style.display = "";


				$('#'+selectedOption).find(".iButton-icons-tab").iButton({
					labelOn: "<i class='icon-ok'></i>",
					labelOff: "<i class='icon-remove'></i>",
					handleWidth: 30
				});

       }

$(document).ready(function(){

           $("#showHideContent").click(function () {
                       if ($("#content_help").is(":hidden")) {

                               $("#content_help").show("slow");

                       } else {

                               $("#content_help").hide("slow");

                       }
 return false;
});
});
</script>


<div class="box">
  <div class="box-content">
	<div class="row box-section">
		<ul class="settingsb">
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('general');" class="tip" title="����� ��������� �������"><i class="icon-cog"></i><span>�����</span></a></li>
		 
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('actor');" class="tip" title="��������� �������� �������"><i class="icon-camera-retro"></i><span>������</span></a></li>
		 
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('curl');" class="tip" title="��������� Curl"><i class="icon-globe"></i><span>Curl</span></a></li>
		 
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('images');" class="tip" title="��������� �������� �����������"><i class="icon-picture"></i><span>�����������</span></a></li>
		 
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('templates');" class="tip" title="��������� ������� �������"><i class="icon-dashboard"></i><span>������</span></a></li>
		 
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('category');" class="tip" title="��������� ��������� �������"><i class="icon-folder-open-alt"></i><span>���������</span></a></li>
		 
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('sinonim');" class="tip" title="��������� �������������"><i class="icon-refresh"></i><span>������������</span></a></li>
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('trailer');" class="tip" title="��������� ��������"><i class="icon-film"></i><span>�������</span></a></li>
		 
HTML;
	 
if ($torrent_php == 'on') {	 

echo <<<HTML
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('torrent');" class="tip" title="��������� �������� � �������"><i class="icon-magnet"></i><span>������</span></a></li>
HTML;
	 
}

if ($video_php == 'on') {	 

echo <<<HTML
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('video');" class="tip" title="��������� �������� ����� ������"><i class="icon-play-circle"></i><span>�����</span></a></li>
HTML;
	 
}

	 

echo <<<HTML
		 <li style="min-width:90px;"><a href="javascript:ChangeOption('actors');" class="tip" title="��������� ������ Parser Actors for DLE"><i class="icon-camera-retro"></i><span>Parser Actors for DLE</span></a></li>
HTML;

	 
		 
echo <<<HTML
    <li style="min-width:90px;"><a href="javascript:ChangeOption('alt_tech');" class="tip" title="��������� ������� :)"><i class="icon-cogs"></i><span>�������</span></a></li>
		</ul>
     </div>
   </div>
</div>



<script language='JavaScript' type="text/javascript">


$(document).ready(function(){

$('#errorListconf').hide(100) ;

$('#errorListconf1').hide(100) ;

});


function kinopoisk_save() {
	$.post("{$config['http_home_url']}engine/modules/parser-kinopoisk/admin.php", $('#nastrConfig').serialize()+'&konfig=config&user_hash={$dle_login_hash}',
		function(data){
		if( data === '' )  {
		       Growl.info({
						title: '����������',
						text: '��������� ���������.',
					});
		$('#errorListconf').hide(300) ;
		$('#errorListconf1').hide(300) ;
		} else {
			$('#errorListconf').html(data).show("slow") ;
			$('#errorListconf1').html(data).show("slow") ;
		}
		}
	);
}

</script>

HTML;

if ($config['allow_admin_wysiwyg'] == '1') { $WYSIWYG = '<div class="alert alert-error">� ��� ������� �������� LiveEditor (WYSIWYG) - �������� �������� BBCODES.</div>'; }
if ($config['allow_admin_wysiwyg'] == '2') { $WYSIWYG = '<div class="alert alert-error">� ��� ������� �������� TinyMCE (WYSIWYG) - �������� �������� BBCODES.</div>'; }

if( file_exists(ENGINE_DIR.'/modules/parser-kinopoisk/license.php') ) {

//����� ����� )))

} else {

$license_er = '<div class="alert alert-error">��� ����� �������� � engine/modules/parser-kinopoisk/license.php.<br />������� ���� �������� ����� � ������� �� ����� parser-kino.ru</div>';

}

$cache_license = @file_get_contents( ENGINE_DIR . "/modules/parser-kinopoisk/license.php" );

if ($cache_license) {

//����� ����� )))

} else {

$license_ero = '<div class="alert alert-error">���� �������� � engine/modules/parser-kinopoisk/license.php ������.<br />�������� ���� �������� �������� � ������� �� ����� parser-kino.ru</div>';

}


if (function_exists( 'exif_imagetype' )) {

//����� ����� )))

} else {

$exif_imagetype = '<div class="alert alert-error">exif_imagetype - �� �������, ���������� � �������������� ������� (��������) ��� ��������� ������ ���������� php</div>';

}


echo <<<HTML

<div style="margin-bottom:30px;">
<div id="errorListconf1" class="alert alert-error"></div>{$WYSIWYG}{$license_er}{$license_ero}{$exif_imagetype}
</div>





<div style="margin-bottom:30px;">
<button onclick="kinopoisk_save(); return !1;" class="btn btn-red"><i class="icon-save"></i> ��������� ���������</button>
<a href="{$config['http_home_url']}{$config['admin_path']}?mod=main" class="btn btn-gray"><i class="icon-arrow-left"></i> �������� � ������ ��������</a>
</div>

<form id="nastrConfig">

HTML;

//-------- ����� ��������� ------------------------------------------------------------------------------------------------------


$groups = get_groups( explode( ',', $config_kinopoisk['user_group'] ) );

if( $config_kinopoisk['user_group'] == "all" ) $check_all = 'selected=""';
	else $check_all = "";
	
$groups = str_replace('<option value','<option style="color: black" value', $groups);



$groups_admin = get_groups( explode( ',', $config_kinopoisk['user_group_admin'] ) );

if( $config_kinopoisk['user_group_admin'] == "all" ) $check_all_admin = 'selected=""';
	else $check_all_admin = "";
	
$groups_admin = str_replace('<option value','<option style="color: black" value', $groups_admin);



if( $config_kinopoisk['all_films'] == "on" ) { $check_all_films = ' checked'; }

if( $config_kinopoisk['js_polnuy'] == "on" ) { $check_js_polnuy = ' checked'; }

if( $config_kinopoisk['js_polnuy_edit'] == "on" ) { $check_js_polnuy_edit = ' checked'; }

if( $config_kinopoisk['empty'] == "on" ) { $check_empty = ' checked'; }

if( $config_kinopoisk['rating_img'] == "on" ) { $check_rating_img = ' checked'; }

if( $config_kinopoisk['serial_time'] == "on" ) { $check_serial_time = ' checked'; }

if( $config_kinopoisk['audience'] == "on" ) { $check_audience = ' checked'; }

if( $config_kinopoisk['studio'] == "on" ) { $check_studio = ' checked'; }

if( $config_kinopoisk['mpaa'] == "on" ) { $check_mpaa = ' checked'; }

if( $config_kinopoisk['arlencode_tags'] == "on" ) { $check_arlencode_tags = ' checked'; }

if( $config_kinopoisk['dvd_trim'] == "on" ) { $check_dvd_trim = ' checked'; }

if( $config_kinopoisk['premiere_trim'] == "on" ) { $check_premiere_trim = ' checked'; }

$audience_pr = convert_shablon_tpl($config_kinopoisk['audience_pr']);

$premiere_date = convert_shablon_tpl($config_kinopoisk['premiere_date']);

$dvd_date = convert_shablon_tpl($config_kinopoisk['dvd_date']);

$trailer_time = convert_shablon_tpl($config_kinopoisk['trailer_time']);

echo <<<HTML

<div id="general">

<div class="box">
<div class="box-header">
<div class="title">����� ��������� �������</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����� ���� ������:</h6></td>

<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="url_kinopoisk">
<option value="https://www.kinopoisk.ru/">https://www.kinopoisk.ru/</option></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ������������ �������� ��� ��������� �����:</h6><span class="note large">�������� ������ ������� ����� ����� ������������ ������</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="user_group[]" multiple>{$groups}</select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� �������� ��� ����������� ������� ��� ������ � ������� (��� �� �������) :</h6><span class="note large">������ ������, �� ������� ��� ������ ������ � ������� ������� ���������� ����� ����� � ��� ��� ��� ���</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="user_group_admin[]" multiple>{$groups_admin}</select></td>
</tr>

</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">����������</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� �������������� ���������� ��� ������:</h6><span class="note large">���� ��������, �� ��� ������ ����� ��������� �������������� ���������� (������, ��������, �������� �����).</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="all_films" value="on" {$check_all_films}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ����� "�� ��������":</h6><span class="note large">���� ������ ����� �������, �� ��� ���������� ����� ���������� �������� ������� ��������� ��� ��������� ������ ������ ����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="js_polnuy" value="on" {$check_js_polnuy}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ����� "�� ��������" ������ ��� �������������� �������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="js_polnuy_edit" value="on" {$check_js_polnuy_edit}></td>
</tr>


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ���������� ���� ������� ��� �������� "-":</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="empty" value="on" {$check_empty}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� � ����������������� ������, ����� "�����":</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="serial_time" value="on" {$check_serial_time}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� �� ������ �������� �������� ���� ������:</h6><span class="note large">�������� ��������, � ������ ����������� �� ����� ����������� ������� ���� ������<span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="rating_img" value="on" {$check_rating_img}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� �������� ����:</h6><span class="note large">���� �������� 0, �� ����� ��� �������� ����� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="keywords_count" value="{$config_kinopoisk['keywords_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ������ ������������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="studio" value="on" {$check_studio}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ �������� MPAA ���������� � ���� ��������:</h6><span class="note large">������ �������� MPAA, ����������� ����� ��������� �� ������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="mpaa" value="on" {$check_mpaa}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ "�������" ���������� � ���� ��������:</h6><span class="note large">������ �������� ������, ����������� ����� ��������� �� ������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="audience" value="on" {$check_audience}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �������� �������:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������.<br /><font color="red">��������! ������� ��������� �� ��������� ���������</font></span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="audience_pr" value="{$audience_pr}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� � ������ ������� ����� ������� � �����������:</h6><span class="note large">����� ������� ��������, ����� ��������� �������: ������ "�������" ���������� � ���� ��������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="audience_def" value="{$config_kinopoisk['audience_def']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� � �������� �� DVD, Blu-Ray ��� ����� �������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="dvd_trim" value="on" {$check_dvd_trim}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� � �������� � ����, �� � ������� ��� ����� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="premiere_trim" value="on" {$check_premiere_trim}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� urlencode ��� �����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="arlencode_tags" value="on" {$check_arlencode_tags}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ������� ��� ���� �������� ���, ��, �������:</h6><span class="note large"><a onclick="javascript:Help('date'); return false;" class=main href="#">������ �� ������ �������</a> ������: "j M Y, D"</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="premiere_date" value="{$premiere_date}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ������� ��� ���� �������� DVD, Blu-Ray:</h6><span class="note large"><a onclick="javascript:Help('date'); return false;" class=main href="#">������ �� ������ �������</a> ������: "j M Y, D"</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="dvd_date" value="{$dvd_date}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ������� ��� ��������:</h6><span class="note large">���� ���� ������, ����� ���������� ������ ���������� ������. ��� ���������� ����� ������������ ��������� �������: m - ������ ���. (0-59); M - ������ ���. (00-59); s - ���. � ��������� ������ (0-59); S - ���. � ��������� ������ (00-59). �������: 'PT00:M:S'; 'm ���. s ���.'.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="trailer_time" value="{$trailer_time}" size=20></td>
</tr>

</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� �������� ���</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['tags_year'] == "on" ) { $check_tags_year_on = ' selected'; }

if( $config_kinopoisk['tags_year'] == "of" ) { $check_tags_year_of = ' selected'; }

if( $config_kinopoisk['tags_year'] == "off" ) { $check_tags_year_off = ' selected'; }

$year_u = convert_shablon_tpl($config_kinopoisk['year_u']);


echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "���" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_year">
<option value="on"{$check_tags_year_on}>���.</option>
<option value="of"{$check_tags_year_of}>���, ��� ������.</option>
<option value="off"{$check_tags_year_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ���:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="year_u" value="{$year_u}" size=50></td>
</tr>

</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� �������� ������</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['country_random'] == "on" ) { $check_country_random = ' checked'; }

if( $config_kinopoisk['tags_country'] == "on" ) { $check_tags_country_on = ' selected'; }

if( $config_kinopoisk['tags_country'] == "of" ) { $check_tags_country_of = ' selected'; }

if( $config_kinopoisk['tags_country'] == "off" ) { $check_tags_country_off = ' selected'; }

$country_u = convert_shablon_tpl($config_kinopoisk['country_u']);


echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� �����:</h6><span class="note large">���� �������� 0, �� ����� ��� ������ ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="country_count" value="{$config_kinopoisk['country_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="country_random" value="on" {$check_country_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_country">
<option value="on"{$check_tags_country_on}>���.</option>
<option value="of"{$check_tags_country_of}>���, ��� ������.</option>
<option value="off"{$check_tags_country_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="country_u" value="{$country_u}" size=50></td>
</tr>


</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� �����</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['genre_random'] == "on" ) { $check_genre_random = ' checked'; }

if( $config_kinopoisk['tags_genre'] == "on" ) { $check_tags_genre_on = ' selected'; }

if( $config_kinopoisk['tags_genre'] == "of" ) { $check_tags_genre_of = ' selected'; }

if( $config_kinopoisk['tags_genre'] == "off" ) { $check_tags_genre_off = ' selected'; }

$genre_u = convert_shablon_tpl($config_kinopoisk['genre_u']);



echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ������:</h6><span class="note large">���� �������� 0, �� ����� ��� ����� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="genre_count" value="{$config_kinopoisk['genre_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "����" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="genre_random" value="on" {$check_genre_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "����" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_genre">
<option value="on"{$check_tags_genre_on}>���.</option>
<option value="of"{$check_tags_genre_of}>���, ��� ������.</option>
<option value="off"{$check_tags_genre_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ����:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="genre_u" value="{$genre_u}" size=50></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">��������� ������ �� ��, ���...</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['trivia'] == "on" ) { $check_trivia = ' checked'; }

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ������ "������ �� ��, ���..." :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="trivia" value="on" {$check_trivia}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ��������� �� ������� "������ �� ��, ���...":</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="trivia_number" value="{$config_kinopoisk['trivia_number']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������:</h6><span class="note large">��� ����������� ������� ������ �� ��, ���..., ����� ����� ��������� ��� �������. �� ������ ������������ ��� ����� ��� ���������, ��������: [i]</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="trivia_prefix" value="{$config_kinopoisk['trivia_prefix']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������:</h6><span class="note large">��� ����������� ������� ������ �� ��, ���..., ����� ����� ��������� ��� �������. �� ������ ������������ ��� ����� ��� ���������, ��������: [/i]</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="trivia_suffix" value="{$config_kinopoisk['trivia_suffix']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ����� ����������� ������� "������ �� ��, ���...":</h6><span class="note large">��������: &lt;br&gt;------&lt;br&gt;</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="trivia_otstup" value="{$config_kinopoisk['trivia_otstup']}" size=50></td>
</tr>


</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� ������ � ������</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['error_film'] == "on" ) { $check_error_film = ' checked'; }

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ������ "������ � ������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="error_film" value="on" {$check_error_film}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ��������� �� ������� "������ � ������":</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="error_film_number" value="{$config_kinopoisk['error_film_number']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������:</h6><span class="note large">��� ����������� ������� ������ � ������, ����� ����� ��������� ��� �������. �� ������ ������������ ��� ����� ��� ���������, ��������: [i]</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="error_film_prefix" value="{$config_kinopoisk['error_film_prefix']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������:</h6><span class="note large">��� ����������� ������� ������ � ������, ����� ����� ��������� ��� �������. �� ������ ������������ ��� ����� ��� ���������, ��������: [/i]</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="error_film_suffix" value="{$config_kinopoisk['error_film_suffix']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ����� ����������� ������� "������ � ������":</h6><span class="note large">��������: &lt;br&gt;------&lt;br&gt;</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="error_film_otstup" value="{$config_kinopoisk['error_film_otstup']}" size=50></td>
</tr>

</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� ��������</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['review'] == "on" ) { $check_review = ' checked'; }

if( $config_kinopoisk['review_title'] == "on" ) { $check_review_title = ' checked'; }


echo <<<HTML

<table class="table table-normal">


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ������ "��������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="review" value="on" {$check_review}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� "��������":</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="review_number" value="{$config_kinopoisk['review_number']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� ������� "��������" �������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="review_title" value="on" {$check_review_title}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������:</h6><span class="note large">��� ����������� �������� �� ������� ��������, ����� ����� ��������� ��� �������. �� ������ ������������ ��� ����� ��� ���������, ��������: [i]</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="review_prefix_t" value="{$config_kinopoisk['review_prefix_t']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������:</h6><span class="note large">��� ����������� �������� �� ������� ��������, ����� ����� ��������� ��� �������. �� ������ ������������ ��� ����� ��� ���������, ��������: [/i]</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="review_suffix_t" value="{$config_kinopoisk['review_suffix_t']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ����� ��������� � ����� ���������,:</h6><span class="note large">��������: &lt;br&gt;------&lt;br&gt;</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="review_otstup_t" value="{$config_kinopoisk['review_otstup_t']}" size=50></td>
</tr>


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������:</h6><span class="note large">��� ����������� ���������� ������� ��������, ����� ����� ��������� ��� �������. �� ������ ������������ ��� ����� ��� ���������, ��������: [i]</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="review_prefix_r" value="{$config_kinopoisk['review_prefix_r']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������:</h6><span class="note large">��� ����������� ���������� ������� ��������, ����� ����� ��������� ��� �������. �� ������ ������������ ��� ����� ��� ���������, ��������: [/i]</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="review_suffix_r" value="{$config_kinopoisk['review_suffix_r']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ����� ���������:</h6><span class="note large">��������: &lt;br&gt;------&lt;br&gt;</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="review_otstup_r" value="{$config_kinopoisk['review_otstup_r']}" size=50></td>
</tr>


</table>

</div></div>

</div>
HTML;


echo <<<HTML

<div id="actor" style='display:none'>

<div class="box">
<div class="box-header">
<div class="title">��������� ���� ������</div>
</div>

<div class="box-content">

HTML;


if( $config_kinopoisk['prefixs_ti_person'] == "on" ) { $check_prefixs_ti_person = ' checked'; }


//*******************************************************

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ���� ������ JPEG:</h6><span class="note large">�������� ������ JPEG ���� ������ ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="person_sjal" value="{$config_kinopoisk['person_sjal']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� �������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_ti_person" value="on" {$check_prefixs_ti_person}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ��� ���� ������:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_person" value="{$config_kinopoisk['prefixs_person']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ���� ������� ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="person_razmer" value="{$config_kinopoisk['person_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������������� ����������� ���� �������:</h6><span class="note large">���� ���� �� ���� ���������, ����� ��������� ��������� ����������� (������� ���� � �����������, ��������: http://site.ru/uploads/poster_no.png ��� /uploads/poster_no.png, �� ��������� ��� thumbs). �������� ������, ���� �������������� ����������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="no_person" value="{$config_kinopoisk['no_person']}" size=40></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� ��������</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['scenario_random'] == "on" ) { $check_scenario_random = ' checked'; }

if( $config_kinopoisk['scenario_images'] == "on" ) { $check_scenario_images = ' checked'; }

if( $config_kinopoisk['tags_scenario'] == "on" ) { $check_tags_scenario_on = ' selected'; }

if( $config_kinopoisk['tags_scenario'] == "of" ) { $check_tags_scenario_of = ' selected'; }

if( $config_kinopoisk['tags_scenario'] == "off" ) { $check_tags_scenario_off = ' selected'; }

$scenario_u = convert_shablon_tpl($config_kinopoisk['scenario_u']);

echo <<<HTML
<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� �����������:</h6><span class="note large">���� �������� 0, �� ����� ��� ���������� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="scenario_count" value="{$config_kinopoisk['scenario_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "��������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="scenario_random" value="on" {$check_scenario_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "��������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="scenario_images" value="on" {$check_scenario_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "��������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_scenario">
<option value="on"{$check_tags_scenario_on}>���.</option>
<option value="of"{$check_tags_scenario_of}>���, ��� ������.</option>
<option value="off"{$check_tags_scenario_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ��������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="scenario_u" value="{$scenario_u}" size=50></td>
</tr>

</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� �������� ��������</div>
</div>

<div class="box-content">


HTML;

if( $config_kinopoisk['director_random'] == "on" ) { $check_director_random = ' checked'; }

if( $config_kinopoisk['director_images'] == "on" ) { $check_director_images = ' checked'; }

if( $config_kinopoisk['tags_director'] == "on" ) { $check_tags_director_on = ' selected'; }

if( $config_kinopoisk['tags_director'] == "of" ) { $check_tags_director_of = ' selected'; }

if( $config_kinopoisk['tags_director'] == "off" ) { $check_tags_director_off = ' selected'; }

$director_u = convert_shablon_tpl($config_kinopoisk['director_u']);

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ����������:</h6><span class="note large">���� �������� 0, �� ����� ��� ��������� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="director_count" value="{$config_kinopoisk['director_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "��������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="director_random" value="on" {$check_director_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "��������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="director_images" value="on" {$check_director_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "��������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_director">
<option value="on"{$check_tags_director_on}>���.</option>
<option value="of"{$check_tags_director_of}>���, ��� ������.</option>
<option value="off"{$check_tags_director_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ��������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="director_u" value="{$director_u}" size=50></td>
</tr>

</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� �������� ��������</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['producer_random'] == "on" ) { $check_producer_random = ' checked'; }

if( $config_kinopoisk['producer_images'] == "on" ) { $check_producer_images = ' checked'; }

if( $config_kinopoisk['tags_producer'] == "on" ) { $check_tags_producer_on = ' selected'; }

if( $config_kinopoisk['tags_producer'] == "of" ) { $check_tags_producer_of = ' selected'; }

if( $config_kinopoisk['tags_producer'] == "off" ) { $check_tags_producer_off = ' selected'; }

$producer_u = convert_shablon_tpl($config_kinopoisk['producer_u']);

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ����������:</h6><span class="note large">���� �������� 0, �� ����� ��� ��������� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="producer_count" value="{$config_kinopoisk['producer_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "��������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="producer_random" value="on" {$check_producer_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "��������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="producer_images" value="on" {$check_producer_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "��������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_producer">
<option value="on"{$check_tags_producer_on}>���.</option>
<option value="of"{$check_tags_producer_of}>���, ��� ������.</option>
<option value="off"{$check_tags_producer_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ��������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="producer_u" value="{$producer_u}" size=50></td>
</tr>


</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� �������� ��������</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['operator_random'] == "on" ) { $check_operator_random = ' checked'; }

if( $config_kinopoisk['operator_images'] == "on" ) { $check_operator_images = ' checked'; }

if( $config_kinopoisk['tags_operator'] == "on" ) { $check_tags_operator_on = ' selected'; }

if( $config_kinopoisk['tags_operator'] == "of" ) { $check_tags_operator_of = ' selected'; }

if( $config_kinopoisk['tags_operator'] == "off" ) { $check_tags_operator_off = ' selected'; }

$operator_u = convert_shablon_tpl($config_kinopoisk['operator_u']);

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ����������:</h6><span class="note large">���� �������� 0, �� ����� ��� ��������� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="operator_count" value="{$config_kinopoisk['operator_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "��������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="operator_random" value="on" {$check_operator_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "��������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="operator_images" value="on" {$check_operator_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "��������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_operator">
<option value="on"{$check_tags_operator_on}>���.</option>
<option value="of"{$check_tags_operator_of}>���, ��� ������.</option>
<option value="off"{$check_tags_operator_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ��������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="operator_u" value="{$operator_u}" size=50></td>
</tr>


</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� �������� ����������</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['composer_random'] == "on" ) { $check_composer_random = ' checked'; }

if( $config_kinopoisk['composer_images'] == "on" ) { $check_composer_images = ' checked'; }

if( $config_kinopoisk['tags_composer'] == "on" ) { $check_tags_composer_on = ' selected'; }

if( $config_kinopoisk['tags_composer'] == "of" ) { $check_tags_composer_of = ' selected'; }

if( $config_kinopoisk['tags_composer'] == "off" ) { $check_tags_composer_off = ' selected'; }

$composer_u = convert_shablon_tpl($config_kinopoisk['composer_u']);

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ������������:</h6><span class="note large">���� �������� 0, �� ����� ��� ����������� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="composer_count" value="{$config_kinopoisk['composer_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "����������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="composer_random" value="on" {$check_composer_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "����������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="composer_images" value="on" {$check_composer_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "����������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_composer">
<option value="on"{$check_tags_composer_on}>���.</option>
<option value="of"{$check_tags_composer_of}>���, ��� ������.</option>
<option value="off"{$check_tags_composer_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ����������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="composer_u" value="{$composer_u}" size=50></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� ��������</div>
</div>

<div class="box-content">

HTML;

if( $config_kinopoisk['artist_random'] == "on" ) { $check_artist_random = ' checked'; }

if( $config_kinopoisk['artist_images'] == "on" ) { $check_artist_images = ' checked'; }

if( $config_kinopoisk['tags_artist'] == "on" ) { $check_tags_artist_on = ' selected'; }

if( $config_kinopoisk['tags_artist'] == "of" ) { $check_tags_artist_of = ' selected'; }

if( $config_kinopoisk['tags_artist'] == "off" ) { $check_tags_artist_off = ' selected'; }

$artist_u = convert_shablon_tpl($config_kinopoisk['artist_u']);

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ����������:</h6><span class="note large">���� �������� 0, �� ����� ��� ��������� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="artist_count" value="{$config_kinopoisk['artist_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "��������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="artist_random" value="on" {$check_artist_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "��������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="artist_images" value="on" {$check_artist_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "��������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_artist">
<option value="on"{$check_tags_artist_on}>���.</option>
<option value="of"{$check_tags_artist_of}>���, ��� ������.</option>
<option value="off"{$check_tags_artist_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ��������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="artist_u" value="{$artist_u}" size=50></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� ������</div>
</div>

<div class="box-content">


HTML;

if( $config_kinopoisk['installation_random'] == "on" ) { $check_installation_random = ' checked'; }

if( $config_kinopoisk['installation_images'] == "on" ) { $check_installation_images = ' checked'; }

if( $config_kinopoisk['tags_installation'] == "on" ) { $check_tags_installation_on = ' selected'; }

if( $config_kinopoisk['tags_installation'] == "of" ) { $check_tags_installation_of = ' selected'; }

if( $config_kinopoisk['tags_installation'] == "off" ) { $check_tags_installation_off = ' selected'; }

$installation_u = convert_shablon_tpl($config_kinopoisk['installation_u']);


echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ���������:</h6><span class="note large">���� �������� 0, �� ����� ��� �������� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="installation_count" value="{$config_kinopoisk['installation_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="installation_random" value="on" {$check_installation_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="installation_images" value="on" {$check_installation_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_installation">
<option value="on"{$check_tags_installation_on}>���.</option>
<option value="of"{$check_tags_installation_of}>���, ��� ������.</option>
<option value="off"{$check_tags_installation_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="installation_u" value="{$installation_u}" size=50></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� � ������� �����</div>
</div>

<div class="box-content">


HTML;

if( $config_kinopoisk['actors_random'] == "on" ) { $check_actors_random = ' checked'; }

if( $config_kinopoisk['actors_images'] == "on" ) { $check_actors_images = ' checked'; }

if( $config_kinopoisk['tags_actors'] == "on" ) { $check_tags_actors_on = ' selected'; }

if( $config_kinopoisk['tags_actors'] == "of" ) { $check_tags_actors_of = ' selected'; }

if( $config_kinopoisk['tags_actors'] == "off" ) { $check_tags_actors_off = ' selected'; }

$actors_u = convert_shablon_tpl($config_kinopoisk['actors_u']);

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� �������:</h6><span class="note large">���� �������� 0, �� ����� ��� ������ ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="actors_count" value="{$config_kinopoisk['actors_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "� ������� �����" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="actors_random" value="on" {$check_actors_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "� ������� �����" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="actors_images" value="on" {$check_actors_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "� ������� �����" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_actors">
<option value="on"{$check_tags_actors_on}>���.</option>
<option value="of"{$check_tags_actors_of}>���, ��� ������.</option>
<option value="off"{$check_tags_actors_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� � ������� �����:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="actors_u" value="{$actors_u}" size=50></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� ���� �����������</div>
</div>

<div class="box-content">


HTML;

if( $config_kinopoisk['actors_dub_random'] == "on" ) { $check_actors_dub_random = ' checked'; }

if( $config_kinopoisk['actors_dub_images'] == "on" ) { $check_actors_dub_images = ' checked'; }

if( $config_kinopoisk['tags_actors_dub'] == "on" ) { $check_tags_actors_dub_on = ' selected'; }

if( $config_kinopoisk['tags_actors_dub'] == "of" ) { $check_tags_actors_dub_of = ' selected'; }

if( $config_kinopoisk['tags_actors_dub'] == "off" ) { $check_tags_actors_dub_off = ' selected'; }

$actors_dub_u = convert_shablon_tpl($config_kinopoisk['actors_dub_u']);

echo <<<HTML

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ���� �����������:</h6><span class="note large">���� �������� 0, �� ����� ��� ���� ����������� ����� ��������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="actors_dub_count" value="{$config_kinopoisk['actors_dub_count']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����������� ������ "���� �����������" ��������� ������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="actors_dub_random" value="on" {$check_actors_dub_random}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ���� ������ "���� �����������" :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="actors_dub_images" value="on" {$check_actors_dub_images}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������������ ������ "���� �����������" ��� ���:</h6>
<span class="note large">���� ���, �� ������ ����� ��������� � ���� ��� � ������������� ����������� ������ �� ������ ���.<br/>
���� ���, ��� ������, ����� ����������� ������ � ���� ������ �����, ������ ������������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="tags_actors_dub">
<option value="on"{$check_tags_actors_dub_on}>���.</option>
<option value="of"{$check_tags_actors_dub_of}>���, ��� ������.</option>
<option value="off"{$check_tags_actors_dub_off}>����.</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� URL ����� ����� ���� �����������:</h6><span class="note large">������� �������� URL ����� �����. ���� ���� �������� ������, �� URL ����� ������������� ����������� ������� 'tags'</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="actors_dub_u" value="{$actors_dub_u}" size=50></td>
</tr>


</table>

</div></div>


</div>
HTML;


if( $config_kinopoisk['url_proxy_type'] == "0" ) { $check_url_proxy_typ0 = ' selected'; }

if( $config_kinopoisk['url_proxy_type'] == "1" ) { $check_url_proxy_typ1 = ' selected'; }

if( $config_kinopoisk['url_proxy_type'] == "2" ) { $check_url_proxy_typ2 = ' selected'; }

if( $config_kinopoisk['trailer_proxy_type'] == "0" ) { $check_trailer_proxy_typ0 = ' selected'; }

if( $config_kinopoisk['trailer_proxy_type'] == "1" ) { $check_trailer_proxy_typ1 = ' selected'; }

if( $config_kinopoisk['trailer_proxy_type'] == "2" ) { $check_trailer_proxy_typ2 = ' selected'; }

if( $config_kinopoisk['url_proxy_type_t'] == "0" ) { $check_url_proxy_type_t0 = ' selected'; }

if( $config_kinopoisk['url_proxy_type_t'] == "1" ) { $check_url_proxy_type_t1 = ' selected'; }

if( $config_kinopoisk['url_proxy_type_t'] == "2" ) { $check_url_proxy_type_t2 = ' selected'; }


if( $config_kinopoisk['seo_type_t'] == "0" ) { $check_seo_type_t0 = ' selected'; }

if( $config_kinopoisk['seo_type_t'] == "1" ) { $check_seo_type_t1 = ' selected'; }

if( $config_kinopoisk['seo_type_t'] == "2" ) { $check_seo_type_t2 = ' selected'; }



if( $config_kinopoisk['cache_kino'] == "on" ) { $check_cache_kino = ' checked'; }

echo <<<HTML

<div id="curl" style='display:none'>
<!--
<div class="box">
<div class="box-header">
<div class="title">��������� Curl</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ������ � ���������� �������:</h6><span class="note large">�����������! ���� ��� ip ������������ �� ���� ������, �� ������ ����� ����� ������ � ���������� �������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="cache_kino" value="on" {$check_cache_kino}></td>
</tr>

</table>

</div></div>
-->
<div class="box">
<div class="box-header">
<div class="title">��������� CURL ���� �����</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>CURLOPT_FOLLOWLOCATION:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="follow_loc" value="{$config_kinopoisk['follow_loc']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>CURLOPT_RETURNTRANSFER:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="return_tra" value="{$config_kinopoisk['return_tra']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>CURLOPT_TIMEOUT:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="curl_time" value="{$config_kinopoisk['curl_time']}" size=10></td>
</tr>

</table>

</div></div>
<div class="box">
<div class="box-header">
<div class="title">��������� CURL ������ � ����� ������</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>CURLOPT_FOLLOWLOCATION:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="follow_loc_t" value="{$config_kinopoisk['follow_loc_t']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>CURLOPT_RETURNTRANSFER:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="return_tra_t" value="{$config_kinopoisk['return_tra_t']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>CURLOPT_TIMEOUT:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="curl_time_t" value="{$config_kinopoisk['curl_time_t']}" size=10></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">��������� ������ ���� �����</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������:</h6>
<span class="note large">���� ��� ��������, ����� ���������� ������...</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="url_proxy_type">
<option value="0"{$check_url_proxy_typ0}>����.</option>
<option value="1"{$check_url_proxy_typ1}>http ������</option>
<option value="2"{$check_url_proxy_typ2}>socks 5 ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ �����:</h6><span class="note large">������� ���� Proxy �����, � ���� XXX.XXX.XXX.XXX:port ��� login:password@XXX.XXX.XXX.XXX:port (���� � ������������). ������ ����� ����� ��� http://parser-kino.ru/forum/cat-proxy/topic-2-page-1.html</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="url_proxy" value="{$config_kinopoisk['url_proxy']}" size=70></td>
</tr>

</table>

</div></div>


<div class="box">
<div class="box-header">
<div class="title">��������� ������ ������ � ����� ������</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������:</h6>
<span class="note large">���� ��� ��������, ����� ���������� ������...</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="url_proxy_type_t">
<option value="0"{$check_url_proxy_type_t0}>����.</option>
<option value="1"{$check_url_proxy_type_t1}>http ������</option>
<option value="2"{$check_url_proxy_type_t2}>socks 5 ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ �����:</h6><span class="note large">������� ���� Proxy �����, � ���� XXX.XXX.XXX.XXX:port ��� login:password@XXX.XXX.XXX.XXX:port (���� � ������������). ������ ����� ����� ��� http://parser-kino.ru/forum/cat-proxy/topic-2-page-1.html</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="url_proxy_t" value="{$config_kinopoisk['url_proxy_t']}" size=70></td>
</tr>

</table>

</div>

</div>

<div class="box">
<div class="box-header">
<div class="title">��������� ������ �������������</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������:</h6>
<span class="note large">���� ��� ��������, ����� ���������� ������...</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="seo_type_t">
<option value="0"{$check_seo_type_t0}>����.</option>
<option value="1"{$check_seo_type_t1}>http ������</option>
<option value="2"{$check_seo_type_t2}>socks 5 ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ �����:</h6><span class="note large">������� ���� Proxy �����, � ���� XXX.XXX.XXX.XXX:port ��� login:password@XXX.XXX.XXX.XXX:port (���� � ������������). ������ ����� ����� ��� http://parser-kino.ru/forum/cat-proxy/topic-2-page-1.html</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="seo_t" value="{$config_kinopoisk['seo_t']}" size=70></td>
</tr>

</table>

</div>

</div>


</div>

HTML;

// ����������� ************************************************************************************************

if( $config_kinopoisk['screen_stills'] == "on" ) { $check_screen_stills = ' checked'; }

if( $config_kinopoisk['images_side'] == "on" ) { $check_images_side = ' checked'; }

if( $config_kinopoisk['images_url'] == "on" ) { $check_images_url = ' checked'; }

if( $config_kinopoisk['images_del'] == "on" ) { $check_images_del = ' checked'; }

if( $config_kinopoisk['poster_vubor'] == "on" ) { $check_poster_vubor = ' checked'; }

if( $config_kinopoisk['screen_vubor'] == "on" ) { $check_screen_vubor = ' checked'; }

if( $config_kinopoisk['stills_vubor'] == "on" ) { $check_stills_vubor = ' checked'; }

if( $config_kinopoisk['wall_vubor'] == "on" ) { $check_wall_vubor = ' checked'; }

if( $config_kinopoisk['postes_vubor'] == "on" ) { $check_postes_vubor = ' checked'; }

if( $config_kinopoisk['obrez'] == "1" ) { $check_obrez1 = ' selected'; }	
	
if( $config_kinopoisk['obrez'] == "2" ) { $check_obrez2 = ' selected'; } 

if( $config_kinopoisk['obrez'] == "3" ) { $check_obrez3 = ' selected'; }


echo <<<HTML
<div id="images" style='display:none'>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� �����������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ����� ���� ���������� ���� �� ���� ������:</h6><span class="note large">���� ��� ���������� �� �����, �� ����� ����������� ����� ������ ���.<br><font color="red">��������! ������ ������� ��������, ����� �������� ��������� � ����� ��������� :)</font></span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="screen_stills" value="on" {$check_screen_stills}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� � ������������ ��� ����� {$config['http_home_url']}:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="images_url" value="on" {$check_images_url}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ������� ����������� �������� ��� ���������� �������:</h6><span class="note large">������ ���, ��� �� �������� ���� ����� � ����� ������ �������� ������ ����� ��� ���������� �������. ��� �������, ��� �������� ������������� ������ �������� ��� ����� ��������. ��� �������� �������� ������ ����������� �� �������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="images_del" value="on" {$check_images_del}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ����� � ��������� �� ����������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="images_side" value="on" {$check_images_side}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ��������� � �����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="obrez[]"><option value="1"{$check_obrez1}>������</option><option value="2"{$check_obrez2}>�����</option><option value="3"{$check_obrez3}>�� ���������� �������</option></select></td>

</tr>

</table>

</div>
</div>
HTML;

if( $config_kinopoisk['osn_poster'] == "on" ) { $check_osn_poster = ' checked'; }

if( $config_kinopoisk['osn_poster_water'] == "on" ) { $check_osn_poster_water = ' checked'; }

if( $config_kinopoisk['prefixs_ti_osn_poster'] == "on" ) { $check_prefixs_ti_osn_poster = ' checked'; }

if( $config_kinopoisk['osn_posterumb_zad'] == "0" ) { $check_off_osn_posterumb_zad = ' selected'; }	
	
if( $config_kinopoisk['osn_posterumb_zad'] == "1" ) { $check_on_osn_posterumb_zad = ' selected'; } 

if( $config_kinopoisk['osn_posterumb_zad'] == "2" ) { $check_of_osn_posterumb_zad = ' selected'; }

echo <<<HTML

<div class="box">
<div class="box-header">
<div class="title">��������� ������� (���������)</div>
</div>
<div class="box-content">

<table class="table table-normal">


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� �������� ������:</h6><span class="note large">���� "����", �� �������� ������ ����������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="osn_poster" value="on" {$check_osn_poster}></td>
</tr>


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ��������� ������� ������ �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="osn_poster_water" value="on" {$check_osn_poster_water}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ��� ��������� �������:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_osn_poster" value="{$config_kinopoisk['prefixs_osn_poster']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_ti_osn_poster" value="on" {$check_prefixs_ti_osn_poster}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ��������� ������� ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="osn_poster_razmer" value="{$config_kinopoisk['osn_poster_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���� ��� ��������� �������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br>������: �� ������� ������������ ������ � �������� ����� �� ������ ����������� �������� ��� ���������� �������� ����� ����������� ����������� �����. ��������: 400<br>������: �� ������� ������ � ������ ����������� ����� ����������� � ������� ������ x ������. ��������: 100x100.  ���� 0 �� ���� ����������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="osn_poster_tumb" value="{$config_kinopoisk['osn_poster_tumb']}" size=30></td>
</tr>


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ��� ��������� ������� ��������� ��:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="osn_posterumb_zad[]"><option value="0"{$check_off_osn_posterumb_zad}>�� ���������� �������</option><option value="1"{$check_on_osn_posterumb_zad}>�� ������</option><option value="2"{$check_of_osn_posterumb_zad }>�� ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������������� ����������� ��������� �������:</h6><span class="note large">���� �������� ������ �� ��� ��������, ����� ��������� ��������� ����������� (������� ���� � �����������, ��������: http://site.ru/uploads/poster_no.png ��� /uploads/poster_no.png, �� ��������� ��� thumbs). �������� ������, ���� �������������� ����������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="osn_poster_alt" value="{$config_kinopoisk['osn_poster_alt']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ��������� ������� JPEG:</h6><span class="note large">�������� ������ JPEG ��������� ������� ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="osn_poster_sjal" value="{$config_kinopoisk['osn_poster_sjal']}" size=30></td>
</tr>

</table>


</div>
</div>
HTML;

if( $config_kinopoisk['big_poster'] == "on" ) { $check_big_poster = ' checked'; }

if( $config_kinopoisk['big_poster_water'] == "on" ) { $check_big_poster_water = ' checked'; }

if( $config_kinopoisk['prefixs_ti_big_poster'] == "on" ) { $check_prefixs_ti_big_poster = ' checked'; }

if( $config_kinopoisk['big_posterumb_zad'] == "0" ) { $check_off_big_posterumb_zad = ' selected'; }	
	
if( $config_kinopoisk['big_posterumb_zad'] == "1" ) { $check_on_big_posterumb_zad = ' selected'; } 

if( $config_kinopoisk['big_posterumb_zad'] == "2" ) { $check_of_big_posterumb_zad = ' selected'; }


echo <<<HTML

<div class="box">
<div class="box-header">
<div class="title">��������� �������� �������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������� ������ �� ����� ��������:</h6><span class="note large">��� ��������, ��� ����� ��������� ������ �������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="poster_vubor" value="on" {$check_poster_vubor}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ������� ������:</h6><span class="note large">���� "����", �� ������� ������ ����������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="big_poster" value="on" {$check_big_poster}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ��������� ������� ������ �� ������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="big_poster_water" value="on" {$check_big_poster_water}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ��� �������� �������:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_big_poster" value="{$config_kinopoisk['prefixs_big_poster']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_ti_big_poster" value="on" {$check_prefixs_ti_big_poster}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ �������� ������� ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="big_poster_razmer" value="{$config_kinopoisk['big_poster_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���� ��� �������� �������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br>������: �� ������� ������������ ������ � �������� ����� �� ������ ����������� �������� ��� ���������� �������� ����� ����������� ����������� �����. ��������: 400<br>������: �� ������� ������ � ������ ����������� ����� ����������� � ������� ������ x ������. ��������: 100x100.  ���� 0 �� ���� ����������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="big_poster_tumb" value="{$config_kinopoisk['big_poster_tumb']}" size=30></td>
</tr>


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ��� �������� ������� ��������� ��:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="big_posterumb_zad[]"><option value="0"{$check_off_big_posterumb_zad}>�� ���������� �������</option><option value="1"{$check_on_big_posterumb_zad}>�� ������</option><option value="2"{$check_of_big_posterumb_zad }>�� ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������������� ����������� �������� �������:</h6><span class="note large">���� ������� ������ �� ��� ��������, ����� ��������� ��������� ����������� (������� ���� � �����������, ��������: http://site.ru/uploads/poster_no.png ��� /uploads/poster_no.png, �� ��������� ��� thumbs). �������� ������, ���� �������������� ����������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="big_poster_alt" value="{$config_kinopoisk['big_poster_alt']}" size=40></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ �������� ������� JPEG:</h6><span class="note large">�������� ������ JPEG �������� ������� ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="big_poster_sjal" value="{$config_kinopoisk['big_poster_sjal']}" size=30></td>
</tr>

</table>


</div>
</div>
HTML;


if( $config_kinopoisk['big_oblojka'] == "on" ) { $check_big_oblojka = ' checked'; }

if( $config_kinopoisk['big_oblojka_water'] == "on" ) { $check_big_oblojka_water = ' checked'; }

if( $config_kinopoisk['prefixs_ti_big_oblojka'] == "on" ) { $check_prefixs_ti_big_oblojka = ' checked'; }

if( $config_kinopoisk['big_oblojkaumb_zad'] == "0" ) { $check_off_big_oblojkaumb_zad = ' selected'; }	
	
if( $config_kinopoisk['big_oblojkaumb_zad'] == "1" ) { $check_on_big_oblojkaumb_zad = ' selected'; } 

if( $config_kinopoisk['big_oblojkaumb_zad'] == "2" ) { $check_of_big_oblojkaumb_zad = ' selected'; }


echo <<<HTML

<div class="box">
<div class="box-header">
<div class="title">��������� �������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ������� � ������� ��������:</h6><span class="note large">���� "����", �� ������� ����������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="big_oblojka" value="on" {$check_big_oblojka}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ��������� ������� ������ �� �������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="big_oblojka_water" value="on" {$check_big_oblojka_water}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ��� �������:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_big_oblojka" value="{$config_kinopoisk['prefixs_big_oblojka']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_ti_big_oblojka" value="on" {$check_prefixs_ti_big_oblojka}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ������� ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="big_oblojka_razmer" value="{$config_kinopoisk['big_oblojka_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���� ��� �������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br>������: �� ������� ������������ ������ � �������� ����� �� ������ ����������� �������� ��� ���������� �������� ����� ����������� ����������� �����. ��������: 400<br>������: �� ������� ������ � ������ ����������� ����� ����������� � ������� ������ x ������. ��������: 100x100.  ���� 0 �� ���� ����������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="big_oblojka_tumb" value="{$config_kinopoisk['big_oblojka_tumb']}" size=30></td>
</tr>


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ��� ������� ��������� ��:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="big_oblojkaumb_zad[]"><option value="0"{$check_off_big_oblojkaumb_zad}>�� ���������� �������</option><option value="1"{$check_on_big_oblojkaumb_zad}>�� ������</option><option value="2"{$check_of_big_oblojkaumb_zad }>�� ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ������� JPEG:</h6><span class="note large">�������� ������ JPEG ������� ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="big_oblojka_sjal" value="{$config_kinopoisk['big_oblojka_sjal']}" size=30></td>
</tr>

</table>
</div>
</div>
HTML;




if( $config_kinopoisk['screen_water'] == "on" ) { $check_on_screenwater = ' checked'; }
	
if( $config_kinopoisk['prefixs_title_screen'] == "on" ) { $check_on_prefixstitlescreen = ' checked'; } 
	
if( $config_kinopoisk['screentumb_zad'] == "0" ) { $check_off_screentumb_zad = ' selected'; }	
	
if( $config_kinopoisk['screentumb_zad'] == "1" ) { $check_on_screentumb_zad = ' selected'; } 

if( $config_kinopoisk['screentumb_zad'] == "2" ) { $check_of_screentumb_zad = ' selected'; }


echo <<<HTML

<div class="box">
<div class="box-header">
<div class="title">��������� ����������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ��������� �� ����� ��������:</h6><span class="note large">��� ��������, ��� ����� ��������� ������ ���������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="screen_vubor" value="on" {$check_screen_vubor}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ����������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screen_nomer" value="{$config_kinopoisk['screen_nomer']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ��������� ������� ������ �� ���������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="screen_water" value="on" {$check_on_screenwater}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ����������:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_user_screen" value="{$config_kinopoisk['prefixs_user_screen']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_title_screen" value="on" {$check_on_prefixstitlescreen}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ���������� ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screen_razmer" value="{$config_kinopoisk['screen_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���� ��� ����������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br>������: �� ������� ������������ ������ � �������� ����� �� ������ ����������� �������� ��� ���������� �������� ����� ����������� ����������� �����. ��������: 400<br>������: �� ������� ������ � ������ ����������� ����� ����������� � ������� ������ x ������. ��������: 100x100.  ���� 0 �� ���� ����������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screen_tumb" value="{$config_kinopoisk['screen_tumb']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ��� ���������� ��������� ��:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="screentumb_zad[]"><option value="0"{$check_off_screentumb_zad}>�� ���������� �������</option><option value="1"{$check_on_screentumb_zad}>�� ������</option><option value="2"{$check_of_screentumb_zad }>�� ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ���������� JPEG:</h6><span class="note large">�������� ������ JPEG ���������� ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screen_sjal" value="{$config_kinopoisk['screen_sjal']}" size=30></td>
</tr>

<!--<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ���������� PNG:</h6><span class="note large">�������� ������ PNG ���������� ��� ����������� �� ������. �������� �� 0 �� 9</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screen_sjal_png" value="{$config_kinopoisk['screen_sjal_png']}" size=30></td>
</tr>-->

</table>

</div>
</div>

HTML;

if( $config_kinopoisk['stills_water'] == "on" ) { $check_on_stillswater = ' checked'; }
	
if( $config_kinopoisk['prefixs_title_stills'] == "on" ) { $check_on_prefixstitlestills = ' checked'; } 
	
if( $config_kinopoisk['stillstumb_zad'] == "0" ) { $check_off_stillstumb_zad = ' selected'; }	
	
if( $config_kinopoisk['stillstumb_zad'] == "1" ) { $check_on_stillstumb_zad = ' selected'; } 

if( $config_kinopoisk['stillstumb_zad'] == "2" ) { $check_of_stillstumb_zad = ' selected'; }


echo <<<HTML

<div class="box">
<div class="box-header">
<div class="title">��������� ������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ����� �� ����� ��������:</h6><span class="note large">��� ��������, ��� ����� ��������� ������ ������ �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="stills_vubor" value="on" {$check_stills_vubor}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="stills_nomer" value="{$config_kinopoisk['stills_nomer']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ��������� ������� ������ �� �����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="stills_water" value="on" {$check_on_stillswater}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ������:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_user_stills" value="{$config_kinopoisk['prefixs_user_stills']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_title_stills" value="on" {$check_on_prefixstitlestills}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ������ ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="stills_razmer" value="{$config_kinopoisk['stills_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���� ��� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br>������: �� ������� ������������ ������ � �������� ����� �� ������ ����������� �������� ��� ���������� �������� ����� ����������� ����������� �����. ��������: 400<br>������: �� ������� ������ � ������ ����������� ����� ����������� � ������� ������ x ������. ��������: 100x100.  ���� 0 �� ���� ����������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="stills_tumb" value="{$config_kinopoisk['stills_tumb']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ��� ������ ��������� ��:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="stillstumb_zad[]"><option value="0"{$check_off_stillstumb_zad}>�� ���������� �������</option><option value="1"{$check_on_stillstumb_zad}>�� ������</option><option value="2"{$check_of_stillstumb_zad }>�� ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ������ JPEG:</h6><span class="note large">�������� ������ JPEG ������ ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="stills_sjal" value="{$config_kinopoisk['stills_sjal']}" size=30></td>
</tr>

<!--<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ������ PNG:</h6><span class="note large">�������� ������ PNG ������ ��� ����������� �� ������. �������� �� 0 �� 9</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="stills_sjal_png" value="{$config_kinopoisk['stills_sjal_png']}" size=30></td>
</tr>-->

</table>

</div>
</div>

HTML;

if( $config_kinopoisk['wall_water'] == "on" ) { $check_on_wallwater = ' checked'; }
	
if( $config_kinopoisk['prefixs_title_wall'] == "on" ) { $check_on_prefixstitlewall = ' checked'; } 
	
if( $config_kinopoisk['walltumb_zad'] == "0" ) { $check_off_walltumb_zad = ' selected'; }	
	
if( $config_kinopoisk['walltumb_zad'] == "1" ) { $check_on_walltumb_zad = ' selected'; } 

if( $config_kinopoisk['walltumb_zad'] == "2" ) { $check_of_walltumb_zad = ' selected'; }


if( $config_kinopoisk['walls_siz'] == "800" ) { $check_800_walls = ' selected'; }	
	
if( $config_kinopoisk['walls_siz'] == "1024" ) { $check_1024_walls = ' selected'; } 

if( $config_kinopoisk['walls_siz'] == "1280" ) { $check_1280_walls = ' selected'; }

if( $config_kinopoisk['walls_siz'] == "1600" ) { $check_1600_walls = ' selected'; }


echo <<<HTML

<div class="box">
<div class="box-header">
<div class="title">��������� �����</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ���� �� ����� ��������:</h6><span class="note large">��� ��������, ��� ����� ��������� ������ ����� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="wall_vubor" value="on" {$check_wall_vubor}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� �����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="wall_nomer" value="{$config_kinopoisk['wall_nomer']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ �����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="walls_siz[]"><option value="800"{$check_800_walls}>800x600</option><option value="1024"{$check_1024_walls}>1024x768</option><option value="1280"{$check_1280_walls}>1280x960</option><option value="1600"{$check_1600_walls}>1600x1200</option></select></td>
</tr>


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ��������� ������� ������ �� ����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="wall_water" value="on" {$check_on_wallwater}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �����:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_user_wall" value="{$config_kinopoisk['prefixs_user_wall']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_title_wall" value="on" {$check_on_prefixstitlewall}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ����� ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="wall_razmer" value="{$config_kinopoisk['wall_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���� ��� �����:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br>������: �� ������� ������������ ������ � �������� ����� �� ������ ����������� �������� ��� ���������� �������� ����� ����������� ����������� �����. ��������: 400<br>������: �� ������� ������ � ������ ����������� ����� ����������� � ������� ������ x ������. ��������: 100x100.  ���� 0 �� ���� ����������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="wall_tumb" value="{$config_kinopoisk['wall_tumb']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ��� ����� ��������� ��:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="walltumb_zad[]"><option value="0"{$check_off_walltumb_zad}>�� ���������� �������</option><option value="1"{$check_on_walltumb_zad}>�� ������</option><option value="2"{$check_of_walltumb_zad }>�� ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ����� JPEG:</h6><span class="note large">�������� ������ JPEG ����� ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="wall_sjal" value="{$config_kinopoisk['wall_sjal']}" size=30></td>
</tr>

<!--<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ����� PNG:</h6><span class="note large">�������� ������ PNG ����� ��� ����������� �� ������. �������� �� 0 �� 9</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="wall_sjal_png" value="{$config_kinopoisk['wall_sjal_png']}" size=30></td>
</tr>-->

</table>

</div>
</div>
HTML;

if( $config_kinopoisk['postes_water'] == "on" ) { $check_on_posteswater = ' checked'; } 
	
if( $config_kinopoisk['prefixs_title_postes'] == "on" ) { $check_on_prefixstitlepostes = ' checked'; } 
	
if( $config_kinopoisk['postestumb_zad'] == "0" ) { $check_off_postestumb_zad = ' selected'; }	
	
if( $config_kinopoisk['postestumb_zad'] == "1" ) { $check_on_postestumb_zad = ' selected'; } 

if( $config_kinopoisk['postestumb_zad'] == "2" ) { $check_of_postestumb_zad = ' selected'; }


echo <<<HTML
<div class="box">
<div class="box-header">
<div class="title">��������� ��������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������� �� ����� ��������:</h6><span class="note large">��� ��������, ��� ����� ��������� ������ �������� �� �����</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="postes_vubor" value="on" {$check_postes_vubor}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ��������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="postes_nomer" value="{$config_kinopoisk['postes_nomer']}" size=10></td>
</tr>



<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ��������� ������� ������ �� �������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="postes_water" value="on" {$check_on_posteswater}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ��������:</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_user_postes" value="{$config_kinopoisk['prefixs_user_postes']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_title_postes" value="on" {$check_on_prefixstitlepostes}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ �������� ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="postes_razmer" value="{$config_kinopoisk['postes_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���� ��� ��������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br>������: �� ������� ������������ ������ � �������� ����� �� ������ ����������� �������� ��� ���������� �������� ����� ����������� ����������� �����. ��������: 400<br>������: �� ������� ������ � ������ ����������� ����� ����������� � ������� ������ x ������. ��������: 100x100.  ���� 0 �� ���� ����������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="postes_tumb" value="{$config_kinopoisk['postes_tumb']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ��� �������� ��������� ��:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="postestumb_zad[]"><option value="0"{$check_off_postestumb_zad}>�� ���������� �������</option><option value="1"{$check_on_postestumb_zad}>�� ������</option><option value="2"{$check_of_postestumb_zad }>�� ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ �������� JPEG:</h6><span class="note large">�������� ������ JPEG �������� ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="postes_sjal" value="{$config_kinopoisk['postes_sjal']}" size=30></td>
</tr>

<!--<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ �������� PNG:</h6><span class="note large">�������� ������ PNG �������� ��� ����������� �� ������. �������� �� 0 �� 9</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="postes_sjal_png" value="{$config_kinopoisk['postes_sjal_png']}" size=30></td>
</tr>-->

</table>

</div>
</div>
HTML;

if( $config_kinopoisk['screent_water'] == "on" ) { $check_on_screentwater = ' checked'; }
	
if( $config_kinopoisk['prefixs_title_screent'] == "on" ) { $check_on_prefixstitlescreent = ' checked'; } 
	
if( $config_kinopoisk['screenttumb_zad'] == "0" ) { $check_off_screenttumb_zad = ' selected'; }	
	
if( $config_kinopoisk['screenttumb_zad'] == "1" ) { $check_on_screenttumb_zad = ' selected'; } 

if( $config_kinopoisk['screenttumb_zad'] == "2" ) { $check_of_screenttumb_zad = ' selected'; }


echo <<<HTML
<div class="box">
<div class="box-header">
<div class="title">��������� ���������� �������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ���������� (������):</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screent_nomer" value="{$config_kinopoisk['screent_nomer']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ��������� ������� ������ �� ��������� (������):</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="screent_water" value="on" {$check_on_screentwater}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���������� (������):</h6><span class="note large">������ ������� ����� � ����� �����, ����� �����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="prefixs_user_screent" value="{$config_kinopoisk['prefixs_user_screent']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="prefixs_title_screent" value="on" {$check_on_prefixstitlescreent}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ ���������� (������) ����� ��������� �� ������:</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br /><br /><b>������:</b> �� ������� ���������� ������� � �������� ����� �� ������ ������������� �����������. ��������: <b>800</b>.<br /><br /><b>������:</b> �� ������� ������ � ������ ������������� ����������� � ������� ������ x ������. ��������: <b>800x600</b><br /><br />���� ������ ����� ������, �� ������������ ����������� ����� ������������� ��������� �� ���������� �������, ����� ����������� ����� �������� ��� ��������� �������. �� ������ ������� 0, ���� ������ ����� ����������� ���������� ������������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screent_razmer" value="{$config_kinopoisk['screent_razmer']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ���� ��� ���������� (������):</h6><span class="note large">���������� ��� ����������� ������������� ������ ���������:<br>������: �� ������� ������������ ������ � �������� ����� �� ������ ����������� �������� ��� ���������� �������� ����� ����������� ����������� �����. ��������: 400<br>������: �� ������� ������ � ������ ����������� ����� ����������� � ������� ������ x ������. ��������: 100x100.  ���� 0 �� ���� ����������� �� �����.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screent_tumb" value="{$config_kinopoisk['screent_tumb']}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ��� ���������� (������) ��������� ��:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="screenttumb_zad[]"><option value="0"{$check_off_screenttumb_zad}>�� ���������� �������</option><option value="1"{$check_on_screenttumb_zad}>�� ������</option><option value="2"{$check_of_screenttumb_zad }>�� ������</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ���������� (������) JPEG:</h6><span class="note large">�������� ������ JPEG ���������� (������) ��� ����������� �� ������. �������� �� 0 �� 100</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screent_sjal" value="{$config_kinopoisk['screent_sjal']}" size=30></td>
</tr>

<!--<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ ���������� (������) PNG:</h6><span class="note large">�������� ������ PNG ���������� (������) ��� ����������� �� ������. �������� �� 0 �� 9</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="screent_sjal_png" value="{$config_kinopoisk['screent_sjal_png']}" size=30></td>
</tr>-->

</table>

</div>
</div>

</div>
HTML;



// ������ *********************************************************************************************

if ($config['allow_admin_wysiwyg'] == '1') { $WYSIWYG = '<font color="red">� ��� ������� �������� LiveEditor (WYSIWYG) - �������� �������� BBCODES.</font><br />'; }
if ($config['allow_admin_wysiwyg'] == '2') { $WYSIWYG = '<font color="red">� ��� ������� �������� TinyMCE (WYSIWYG) - �������� �������� BBCODES.</font><br />'; }

$template_title = convert_shablon_tpl($template_site['title'][0]);

$template_short_story = convert_shablon_tpl($template_site['short_story'][0]);

$template_full_story = convert_shablon_tpl($template_site['full_story'][0]);

$template_alt_name = convert_shablon_tpl($template_site['alt_name'][0]);

$template_tags = convert_shablon_tpl($template_site['tags'][0]);

$template_meta_title = convert_shablon_tpl($template_site['meta_title'][0]);

$template_descr = convert_shablon_tpl($template_site['descr'][0]);

$template_keywords = convert_shablon_tpl($template_site['keywords'][0]);


echo <<<HTML
<div id="templates" class="box" style='display:none'>

<div class="box-header">
<div class="title">��������� ������� �������</div>
</div>
<div class="box-content">


<div class="row box-section">

<div class="well relative"><span class="triangle-button green"><i class="icon-bell"></i></span>
��� ���� ����� ������ ����� ��������� ����������, ��� ���������� ��������� ������. � ������ ������� ���������� �������� ���������� [xfvalue_X], ��� X - �������� ���� ��� [xfvalue_X limit="Y"], ��� X - �������� ���� � Y - ���������� ��������. ����� ���������� ������������ ������ [xfgiven_X]...[/xfgiven_X], ������� ������� ����� ��������� � ���.<br/>
<br/>��� �� �� ������ ������������ ������ [xfnotgiven_X] Y [/xfnotgiven_X], ��� X - �������� ���� � Y ��� �����. <b>xfnotgiven</b> �� ������ ������������ ����� ������ �� ����� ������ ������ (����������� �� ���� ������) � ������ ������ ����� ��� �����.
<br/><br/><strong>������ ������ �����:</strong><br/>
�������� �������� ���� � ������� director - ��������. ����� ��������� � ������ [xfgiven_director][xfvalue_director][/xfgiven_director].<br/><br/>
����� ��������� � ��� [xfgiven_director][b]�������� ������:[/b][xfvalue_director][/xfgiven_director].<br/><br/>
������ director - �������� ���������� �� ���� ������. ����� �������� ���� ����� [xfnotgiven_director] ����� �� ���� ���������� [/xfnotgiven_director]
<br/><br/><b>������ ��� ��������� ������</b> [film_xfgiven] Y [/film_xfgiven], ��� Y ��� �����. <b>film_xfgiven</b> - �� ������ ������������ � ������� ������� ��� ������. ��������: [film_xfgiven]����� ������[/film_xfgiven]
<br/><br/><b>������ ��� ��������� �������</b> [serial_xfgiven] Y [/serial_xfgiven], ��� Y ��� �����. <b>serial_xfgiven</b> - �� ������ ������������ � ������� ������� ��� ������. ��������: [serial_xfgiven]������ ������[/serial_xfgiven]
<br/><br/>
<font color="red">��������!</font> - ���� ������� � ������ ������� ������� �� ��� �� ������� � ����� �������� ����� � ������ ���.������, ������� �� ������� � ������ ������� ����� ������ CMS DLE.<br/><br/>
<button type="button" class="btn btn-green" id="showHideContent">�������� ����� ������� <i class="icon-caret-down"></i></button>
<div id="content_help" style="display:none;">
<h5>������ ���� �����</h5>
<table class="table table-normal table-hover">
<thead>
<tr>
<td style="width: 200px">�������� ����</td>
<td>��������</td>
</tr>
</thead>
<tr><td><b>name</b></td><td>�������� ������ �������</td></tr>
<tr><td><b>name_foreign</b></td><td>�������� ������ ������������</td></tr>
<tr><td><b>year</b></td><td>��� ������ ������</td></tr>
<tr><td><b>year_url</b></td><td>��� ��� ���. � ������� ����������</td></tr>
<tr><td><b>year_title</b></td><td>��� ������ ��� ��������� �������</td></tr>
<tr><td><b>country</b></td><td>������ ������� ������</td></tr>
<tr><td><b>country_url</b></td><td>������ ��� ���. � ������� ����������</td></tr>
<tr><td><b>slogan</b></td><td>������ ������</td></tr>
<tr><td><b>genre</b></td><td>���� ������</td></tr>
<tr><td><b>genre_url</b></td><td>���� ��� ���. � ������� ����������</td></tr>
<tr><td><b>budget</b></td><td>����� ������</td></tr>
<tr><td><b>charges_world</b></td><td>����� ���</td></tr>
<tr><td><b>charges_usa</b></td><td>����� � ���</td></tr>
<tr><td><b>charges_rus</b></td><td>����� ������ (��)</td></tr>
<tr><td><b>marketing</b></td><td>���������</td></tr>
<tr><td><b>dvd_usa</b></td><td>DVD � ���</td></tr>
<tr><td><b>audience</b></td><td>�������</td></tr>
<tr><td><b>age</b></td><td>�������</td></tr>
<tr><td><b>age_alt</b></td><td>������� ������������ (12+, 13+)</td></tr>
<tr><td><b>studio</b></td><td>������������ (���������� � �������)</td></tr>
<tr><td><b>time</b></td><td>�����������������</td></tr>
<tr><td><b>time_bez</b></td><td>����������������� � ���� "182 ���."</td></tr>
<tr><td><b>time_alt</b></td><td>����������������� 2, ������ ��� ������� (������ � beta)</td></tr>
<tr><td><b>premiere_world</b></td><td>�������� ���</td></tr>
<tr><td><b>premiere_world_users</b></td><td>�������� ��� (����������������, ������������� � �������)</td></tr>
<tr><td><b>premiere_rus</b></td><td>�������� ������ (��)</td></tr>
<tr><td><b>premiere_rus_users</b></td><td>�������� ������ (��) (����������������, ������������� � �������)</td></tr>
<tr><td><b>premiere_ukr</b></td><td>�������� �������. ��������! ��������, ���� ������ � ������� ��� IP UA</td></tr>
<tr><td><b>premiere_ukr_users</b></td><td>�������� ������� (����������������, ������������� � �������). ��������! ��������, ���� ������ � ������� ��� IP UA</td></tr>
<tr><td><b>release_dvd</b></td><td>����� DVD</td></tr>
<tr><td><b>release_dvd_users</b></td><td>����� DVD (����������������, ������������� � �������)</td></tr>
<tr><td><b>release_bluray</b></td><td>����� Blu-Ray</td></tr>
<tr><td><b>release_bluray_users</b></td><td>����� Blu-Ray (����������������, ������������� � �������)</td></tr>
<tr><td><b>mpaa</b></td><td>������� MPAA</td></tr>
<tr><td><b>rating</b></td><td>������� ���� ������ � ���� �����</td></tr>
<tr><td><b>rating_num</b></td><td>���������� ������ �� ���� ������</td></tr>
<tr><td><b>imdb</b></td><td>������� IMDB � ���� �����</td></tr>
<tr><td><b>imdb_num</b></td><td>���������� ������ �� IMDB</td></tr>
<tr><td><b>kinopoisk_id</b></td><td>ID ������ ���� ������</td></tr>
<tr><td><b>rating_img</b></td><td>URL �� ����������� ����������� �������� ���� ������. ���������� � �������</td></tr>
<tr><td><b>rating_img_url</b></td><td>��-��� � URL �� ����������� ����������� �������� ���� ������. ���������� � �������, �������� ��� ���: "[url=http://www.kinopoisk.ru/film/251733/][img]http://site.ru/uploads/posts/2015-11/1446483530_1797763597.gif[/img][/url]"</td></tr>
<tr><td><b>rating_img_kino</b></td><td>URL �� ����������� �������� ���� ������, �������� ��� ���: "http://rating.kinopoisk.ru/251733.gif"</td></tr>
<tr><td><b>rating_img_url_kino</b></td><td>��-��� � URL �������� ���� ������, �������� ��� ���: "[url=http://www.kinopoisk.ru/film/251733/][img]http://rating.kinopoisk.ru/251733.gif[/img][/url]"</td></tr>
<tr><td><b>description</b></td><td>�������� ������</td></tr>
<tr><td><b>argument</b></td><td>�������� - ��������� �������.</td></tr>
<tr><td><b>keywords</b></td><td>�������� ����� ������</td></tr>
<tr><td><b>review</b></td><td>��������</td></tr>
<tr><td><b>trivia</b></td><td>�����</td></tr>
<tr><td><b>error_film</b></td><td>������ � ������</td></tr>
</table>
<h5>����� (�������)</h5>
<table class="table table-normal table-hover">
<thead>
<tr>
<td style="width: 200px">�������� ����</td>
<td>��������</td>
</tr>
</thead>

<tr><td><b>actors</b></td><td>������ ����� �������</td></tr>
<tr><td><b>actors_url</b></td><td>������ ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>actors_img</b></td><td>��� ����������� �������. � ������� ���������� �������� ����������� ������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>actors_url_img</b></td><td>��� ����������� ������� ��� ���. � ������� ���������� �������� ����������� ������� � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>actors_name_X</b></td><td>���� �� ����������� ������ ������, ��� X ���������� ����� ����������� ������ �������. ������: "[xfgiven_actors_name_1][xfvalue_actors_name_1][/xfgiven_actors_name_1]"</td></tr>
<tr><td><b>actors_img_X</b></td><td>���� �� ����������� ���� ������, ��� X ���������� ����� ����������� ���� �������. ������: "[xfgiven_actors_img_1][xfvalue_actors_img_1][/xfgiven_actors_img_1]"</td></tr>
<tr><td><b>actors_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_actors_url_1][xfvalue_actors_url_1][/xfgiven_actors_url_1]"</td></tr>


<tr><td><b>actors_dub</b></td><td>���� ����������� ����� �������</td></tr>
<tr><td><b>actors_dub_url</b></td><td>���� ����������� ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>actors_dub_img</b></td><td>��� ����������� ���� �����������. � ������� ���������� �������� ����������� ���� �����������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>actors_dub_url_img</b></td><td>��� ����������� ���� ����������� ��� ���. � ������� ���������� �������� ����������� ���� ����������� � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>actors_dub_name_X</b></td><td>���� �� ����������� ������ ���� �����������, ��� X ���������� ����� ����������� ������ ���� �����������. ������: "[xfgiven_actors_dub_name_1][xfvalue_actors_dub_name_1][/xfgiven_actors_dub_name_1]"</td></tr>
<tr><td><b>actors_dub_img_X</b></td><td>���� �� ����������� ���� ���� �����������, ��� X ���������� ����� ����������� ���� ���� �����������. ������: "[xfgiven_actors_dub_img_1][xfvalue_actors_dub_img_1][/xfgiven_actors_dub_img_1]"</td></tr>
<tr><td><b>actors_dub_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_actors_dub_url_1][xfvalue_actors_dub_url_1][/xfgiven_actors_dub_url_1]"</td></tr>


<tr><td><b>director</b></td><td>�������� ����� �������</td></tr>
<tr><td><b>director_url</b></td><td>�������� ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>director_img</b></td><td>��� ����������� ��������. � ������� ���������� �������� ����������� ��������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>director_url_img</b></td><td>��� ����������� �������� ��� ���. � ������� ���������� �������� ����������� �������� � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>director_name_X</b></td><td>���� �� ����������� ������ ��������, ��� X ���������� ����� ����������� ������ ��������. ������: "[xfgiven_director_name_1][xfvalue_director_name_1][/xfgiven_director_name_1]"</td></tr>
<tr><td><b>director_img_X</b></td><td>���� �� ����������� ���� ��������, ��� X ���������� ����� ����������� ���� ��������. ������: "[xfgiven_director_img_1][xfvalue_director_img_1][/xfgiven_director_img_1]"</td></tr>
<tr><td><b>director_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_director_url_1][xfvalue_director_url_1][/xfgiven_director_url_1]"</td></tr>


<tr><td><b>scenario</b></td><td>�������� ����� �������</td></tr>
<tr><td><b>scenario_url</b></td><td>�������� ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>scenario_img</b></td><td>��� ����������� ��������. � ������� ���������� �������� ����������� ��������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>scenario_url_img</b></td><td>��� ����������� �������� ��� ���. � ������� ���������� �������� ����������� �������� � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>scenario_name_X</b></td><td>���� �� ����������� ������ ��������, ��� X ���������� ����� ����������� ������ ��������. ������: "[xfgiven_scenario_name_1][xfvalue_scenario_name_1][/xfgiven_scenario_name_1]"</td></tr>
<tr><td><b>scenario_img_X</b></td><td>���� �� ����������� ���� ��������, ��� X ���������� ����� ����������� ���� ��������. ������: "[xfgiven_scenario_img_1][xfvalue_scenario_img_1][/xfgiven_scenario_img_1]"</td></tr>
<tr><td><b>scenario_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_scenario_url_1][xfvalue_scenario_url_1][/xfgiven_scenario_url_1]"</td></tr>


<tr><td><b>producer</b></td><td>�������� ����� �������</td></tr>
<tr><td><b>producer_url</b></td><td>�������� ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>producer_img</b></td><td>��� ����������� ��������. � ������� ���������� �������� ����������� ��������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>producer_url_img</b></td><td>��� ����������� �������� ��� ���. � ������� ���������� �������� ����������� �������� � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>producer_name_X</b></td><td>���� �� ����������� ������ ��������, ��� X ���������� ����� ����������� ������ ��������. ������: "[xfgiven_producer_name_1][xfvalue_producer_name_1][/xfgiven_producer_name_1]"</td></tr>
<tr><td><b>producer_img_X</b></td><td>���� �� ����������� ���� ��������, ��� X ���������� ����� ����������� ���� ��������. ������: "[xfgiven_producer_img_1][xfvalue_producer_img_1][/xfgiven_producer_img_1]"</td></tr>
<tr><td><b>producer_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_producer_url_1][xfvalue_producer_url_1][/xfgiven_producer_url_1]"</td></tr>


<tr><td><b>operator</b></td><td>�������� ����� �������</td></tr>
<tr><td><b>operator_url</b></td><td>�������� ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>operator_img</b></td><td>��� ����������� ��������. � ������� ���������� �������� ����������� ��������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>operator_url_img</b></td><td>��� ����������� �������� ��� ���. � ������� ���������� �������� ����������� �������� � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>operator_name_X</b></td><td>���� �� ����������� ������ ��������, ��� X ���������� ����� ����������� ������ ��������. ������: "[xfgiven_operator_name_1][xfvalue_operator_name_1][/xfgiven_operator_name_1]"</td></tr>
<tr><td><b>operator_img_X</b></td><td>���� �� ����������� ���� ��������, ��� X ���������� ����� ����������� ���� ��������. ������: "[xfgiven_operator_img_1][xfvalue_operator_img_1][/xfgiven_operator_img_1]"</td></tr>
<tr><td><b>operator_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_operator_url_1][xfvalue_operator_url_1][/xfgiven_operator_url_1]"</td></tr>


<tr><td><b>composer</b></td><td>���������� ����� �������</td></tr>
<tr><td><b>composer_url</b></td><td>���������� ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>composer_img</b></td><td>��� ����������� ����������. � ������� ���������� �������� ����������� ����������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>composer_url_img</b></td><td>��� ����������� ���������� ��� ���. � ������� ���������� �������� ����������� ���������� � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>composer_name_X</b></td><td>���� �� ����������� ������ ����������, ��� X ���������� ����� ����������� ������ ����������. ������: "[xfgiven_composer_name_1][xfvalue_composer_name_1][/xfgiven_composer_name_1]"</td></tr>
<tr><td><b>composer_img_X</b></td><td>���� �� ����������� ���� ����������, ��� X ���������� ����� ����������� ���� ����������. ������: "[xfgiven_composer_img_1][xfvalue_composer_img_1][/xfgiven_composer_img_1]"</td></tr>
<tr><td><b>composer_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_composer_url_1][xfvalue_composer_url_1][/xfgiven_composer_url_1]"</td></tr>


<tr><td><b>artist</b></td><td>�������� ����� �������</td></tr>
<tr><td><b>artist_url</b></td><td>�������� ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>artist_img</b></td><td>��� ����������� ��������. � ������� ���������� �������� ����������� ��������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>artist_url_img</b></td><td>��� ����������� �������� ��� ���. � ������� ���������� �������� ����������� �������� � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>artist_name_X</b></td><td>���� �� ����������� ������ ��������, ��� X ���������� ����� ����������� ������ ��������. ������: "[xfgiven_artist_name_1][xfvalue_artist_name_1][/xfgiven_artist_name_1]"</td></tr>
<tr><td><b>artist_img_X</b></td><td>���� �� ����������� ���� ��������, ��� X ���������� ����� ����������� ���� ��������. ������: "[xfgiven_artist_img_1][xfvalue_artist_img_1][/xfgiven_artist_img_1]"</td></tr>
<tr><td><b>artist_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_artist_url_1][xfvalue_artist_url_1][/xfgiven_artist_url_1]"</td></tr>


<tr><td><b>installation</b></td><td>������ ����� �������</td></tr>
<tr><td><b>installation_url</b></td><td>������ ��� ���, ����� �������. � ������� ���������� ������ �������</td></tr>
<tr><td><b>installation_img</b></td><td>��� ����������� ������. � ������� ���������� �������� ����������� ������, ����� �������� ����������� ��-��� �������� ��� ���: [img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img]</td></tr>
<tr><td><b>installation_url_img</b></td><td>��� ����������� ������ ��� ���. � ������� ���������� �������� ����������� ������ � ��� ��� ���� ����������, ����� �������� ��-��� �������� ��� ���: "[url=http://proserial24.xyz/tags/%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80+%D0%9D%D0%BE%D1%82%D0%BA%D0%B8%D0%BD/][img=|��������� ������]/uploads/posts/2016-10/1475516251-1203943750.jpg[/img][/url]</td></tr>
<tr><td><b>installation_name_X</b></td><td>���� �� ����������� ������ ������, ��� X ���������� ����� ����������� ������ ������. ������: "[xfgiven_installation_name_1][xfvalue_installation_name_1][/xfgiven_installation_name_1]"</td></tr>
<tr><td><b>installation_img_X</b></td><td>���� �� ����������� ���� ������, ��� X ���������� ����� ����������� ���� ������. ������: "[xfgiven_installation_img_1][xfvalue_installation_img_1][/xfgiven_installation_img_1]"</td></tr>
<tr><td><b>installation_url_X</b></td><td>���� �� ���� ��� ���, ��� X ���������� ����� ���� ��� ���. ������: "[xfgiven_installation_url_1][xfvalue_installation_url_1][/xfgiven_installation_url_1]"</td></tr>

</table>
<h5>�������</h5>
<table class="table table-normal table-hover">
<thead>
<tr>
<td style="width: 200px">�������� ����</td>
<td>��������</td>
</tr>
</thead>
<tr><td><b>trailer_time</b></td><td>����������������� ��������</td></tr>
<tr><td><b>trailer_time_users</b></td><td>����������������� �������� (������ ������� � ������ ����������, ������������� � �������)</td></tr>
<tr><td><b>trailer</b></td><td>������ �� ������� � ���� [video=http://kp.cdn.yandex.net/674170/kinopoisk.ru-Marsianin-117078.mp4]</td></tr>
<tr><td><b>trailer_uppod</b></td><td>������ �� ������� � ���� [uppod=http://kp.cdn.yandex.net/674170/kinopoisk.ru-Marsianin-117078.mp4]</td></tr>
<tr><td><b>trailer_link</b></td><td>������ ������ �� �������</td></tr>
<tr><td><b>trailer_cache</b></td><td>������ �� ������� cache � ���� [video=http://cache-default03d.cdn.yandex.net/kp.cdn.yandex.net/674170/kinopoisk.ru-Marsianin-117078.mp4]</td></tr>
<tr><td><b>trailer_uppod_cache</b></td><td>������ �� ������� cache � ���� [uppod=http://cache-default03d.cdn.yandex.net/kp.cdn.yandex.net/674170/kinopoisk.ru-Marsianin-117078.mp4]</td></tr>
<tr><td><b>trailer_link_cache</b></td><td>������ ������ �� ������� cache</td></tr>
<tr><td><b>trailer_server</b></td><td>������ �� ������� ������������ �� ������</td></tr>
<tr><td><b>youtube_id</b></td><td>videoId YouTube</td></tr>
<tr><td><b>youtube_iframe</b></td><td>YouTube ��� ��� iframe</td></tr>
<tr><td><b>youtube_bust</b></td><td><font color="red">Burst Player: �����������! ������������� ����� YouTube ��� �������.</font> ����� �������� ��� ��� iframe</td></tr>
</table>
<h5>����������� ���� �����</h5>
<table class="table table-normal table-hover">
<thead>
<tr>
<td style="width: 200px">�������� ����</td>
<td>��������</td>
</tr>
</thead>
<tr><td><b>poster</b></td><td>��� �� �������� ������, ����� ������������ [thumb][/thumb]</td></tr>
<tr><td><b>poster_thumbs</b></td><td>��� thumbs ��������� �������, ������: /uploads/posts/2015-10/thumbs/x_x.jpg. �������� ���� ������� thumb!</td></tr>
<tr><td><b>poster_big</b></td><td>��� �� ������� ������, ����� ������������ [thumb][/thumb]</td></tr>
<tr><td><b>poster_big_thumbs</b></td><td>��� thumbs �������� �������, ������: /uploads/posts/2015-10/thumbs/x_x.jpg. �������� ���� ������� thumb!</td></tr>
<tr><td><b>poster_alt</b></td><td>��� �� �������, ����� ������������ [thumb][/thumb]</td></tr>
<tr><td><b>poster_alt_thumbs</b></td><td>��� thumbs �������, ������: /uploads/posts/2015-10/thumbs/x_x.jpg. �������� ���� ������� thumb!</td></tr>
<tr><td><b>screen</b></td><td>��������� ����������� �� ������, ����������� � ���� "[thumb]/uploads/posts/2015-10/x_x.jpg[/thumb]"</td></tr>
<tr><td><b>screen_num_X</b></td><td>���� �� ������������ ���������, ��� X ���������� ����� ������������ ���������. ������: "[xfgiven_screen_num_1][xfvalue_screen_num_1][/xfgiven_screen_num_1]"</td></tr>
<tr><td><b>stills</b></td><td>����� ����������� �� ������, ����������� � ���� "[thumb]/uploads/posts/2015-10/x_x.jpg[/thumb]"</td></tr>
<tr><td><b>stills_num_X</b></td><td>���� �� ������������ �����, ��� X ���������� ����� ������������ �����. ������: "[xfgiven_stills_num_1][xfvalue_stills_num_1][/xfgiven_stills_num_1]"</td></tr>
<tr><td><b>wall</b></td><td>���� ����������� �� ������, ����������� � ���� "[thumb]/uploads/posts/2015-10/x_x.jpg[/thumb]"</td></tr>
<tr><td><b>wall_num_X</b></td><td>���� �� ����������� �����, ��� X ���������� ����� ����������� �����. ������: "[xfgiven_wall_num_1][xfvalue_wall_num_1][/xfgiven_wall_num_1]"</td></tr>
<tr><td><b>postes</b></td><td>������� ����������� �� ������, ����������� � ���� "[thumb]/uploads/posts/2015-10/x_x.jpg[/thumb]"</td></tr>
<tr><td><b>postes_num_X</b></td><td>���� �� ����������� ��������, ��� X ���������� ����� ����������� ��������. ������: "[xfgiven_postes_num_1][xfvalue_postes_num_1][/xfgiven_postes_num_1]"</td></tr>
</table>
<h5>������</h5>
<table class="table table-normal table-hover">
<thead>
<tr>
<td style="width: 200px">�������� ����</td>
<td>��������</td>
</tr>
</thead>
<tr><td><b>tracker_quality</b></td><td>��������</td></tr>
<tr><td><b>tracker_torrent</b></td><td>������������ URL �� �������, ��������</td></tr>
<tr><td><b>tracker_size</b></td><td>������ ������� �����</td></tr>
<tr><td><b>tracker_seed</b></td><td>����</td></tr>
<tr><td><b>tracker_pear</b></td><td>����</td></tr>
<tr><td><b>tracker_magnet</b></td><td>������ ������ (������ �� FreeRutor, Rutor)</td></tr>
<tr><td><b>tracker_perevod</b></td><td>�������</td></tr>
<tr><td><b>tracker_format</b></td><td>������ �����</td></tr>
<tr><td><b>tracker_video_info</b></td><td>����� ����������</td></tr>
<tr><td><b>tracker_audio_info</b></td><td>����� ����������</td></tr>
<tr><td><b>tracker_season</b></td><td>���������� ������� (������ �� Fast-Torrent)</td></tr>
<tr><td><b>tracker_trailer</b></td><td>������� YouTube (������ �� FreeRutor)</td></tr>
<tr><td><b>tracker_trailers</b></td><td>������� YouTube, ����������� � ���� "[media=xxx]" (������ �� FreeRutor)</td></tr>
<tr><td><b>tracker_sample</b></td><td>Sample (������ �� FreeRutor)</td></tr>
<tr><td><b>tracker_video_kodek</b></td><td>����� ����� (������ �� Fast-Torrent)</td></tr>
<tr><td><b>tracker_audio_kodek</b></td><td>����� ����� (������ �� Fast-Torrent)</td></tr>
<tr><td><b>torrent</b></td><td>��-��� �� ����������� ������� ����, � ���� [attachment=X]</td></tr>
<tr><td><b>torrent_id</b></td><td>ID ������� �����, ������������ �� ������</td></tr>
<tr><td><b>screent</b></td><td>��������� ����������� �� ������, ����������� � ���� "[thumb]/uploads/posts/2015-10/x_x.jpg[/thumb]" (������ �� Fast-Torrent, FreeRutor, �������)</td></tr>
<tr><td><b>screent_num_X</b></td><td>���� �� ������������ ���������, ��� X ���������� ����� ������������ ���������. ������: "[xfgiven_screent_num_1][xfvalue_screent_num_1][/xfgiven_screent_num_1]"</td></tr>
</table>
<h5>����� ������</h5>
<table class="table table-normal table-hover">
<thead>
<tr>
<td style="width: 200px">�������� ����</td>
<td>��������</td>
</tr>
</thead>
<tr><td><b>translator</b></td><td>���������� � ��������</td></tr>
<tr><td><b>seasons_count</b></td><td>�������� �� ����� ������</td></tr>
<tr><td><b>episodes_count</b></td><td>���������� �����</td></tr>
<tr><td><b>iframe</b></td><td>URL � �������� ����� ��������� iframe</td></tr>
<tr><td><b>type</b></td><td>��� ������� ��������: movie / serial</td></tr>
</table>
</div>

</div>

</div>
<div class="row box-section">

<div class="accordion" id="accordion">

<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse8">��������� ������� <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse8" class="accordion-body collapse">
      <div class="accordion-inner padded">
       <input type="text" style="width:100%;max-width:637px;" name="title" value="{$template_title}">
      </div>
    </div>
  </div>

<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">������ ������� ������� <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse1" class="accordion-body collapse">
      <div class="accordion-inner padded">
       {$WYSIWYG}������ ��������� ��� ���������� ������� �������� ����������� (BBCODES). � ����������� LiveEditor (WYSIWYG), TinyMCE (WYSIWYG) �� �������� ������.<br /><br />
		<textarea rows="15" style="width:100%;" name="short_story">{$template_short_story}</textarea>
      </div>
    </div>
  </div>
  
  
<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">������ ������ ������� <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse2" class="accordion-body collapse">
      <div class="accordion-inner padded">
        {$WYSIWYG}������ ��������� ��� ���������� ������� �������� ����������� (BBCODES). � ����������� LiveEditor (WYSIWYG), TinyMCE (WYSIWYG) �� �������� ������.<br /><br />
		<textarea rows="15" style="width:100%;" name="full_story">{$template_full_story}</textarea>
      </div>
    </div>
  </div>
  
<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">��� URL ������ <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse3" class="accordion-body collapse">
      <div class="accordion-inner padded">
		<input type="text" style="width:100%;max-width:637px;" name="alt_name" value="{$template_alt_name}">
      </div>
    </div>
  </div>
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">������ ����� <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse4" class="accordion-body collapse">
      <div class="accordion-inner padded">
		<input type="text" style="width:100%;max-width:637px;" name="tags" value="{$template_tags}">
      </div>
    </div>
  </div>
  
    <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5">������� title <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse5" class="accordion-body collapse">
      <div class="accordion-inner padded">
		<input type="text" style="width:100%;max-width:637px;" name="meta_title" value="{$template_meta_title}">
      </div>
    </div>
  </div>
  
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse6">�������� ��� ������ <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse6" class="accordion-body collapse">
      <div class="accordion-inner padded">
		<input type="text" style="width:100%;max-width:637px;" name="descr" value="{$template_descr}">
      </div>
    </div>
  </div>
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse7">�������� ����� <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse7" class="accordion-body collapse">
      <div class="accordion-inner padded">
		<textarea rows="5" style="width:100%;" name="keywords">{$template_keywords}</textarea>
      </div>
    </div>
  </div>  
  
  
HTML;

$xfields = xfieldsload();

if (count($xfields)) {

	foreach ($xfields as $value) {
	
		if ($value[3] == 'text' || $value[3] == 'textarea') {
		
			$bufer_template .= "<tr><td>{$value[1]}</td>";
			
			if ($value[3] == 'text') {
			
			$name_xfield = "xfield[{$value[0]}]";
			
	      $template_site_xf[$name_xfield][0] = stripslashes($template_site_xf[$name_xfield][0]);
	      
	      if ($config['charset'] == "utf-8") {
	      
$template_site_xf[$name_xfield][0] = iconv('windows-1251', 'UTF-8', $template_site_xf[$name_xfield][0]);

}

$template_site_xf[$name_xfield][0] = str_replace('"', '&quot;', $template_site_xf[$name_xfield][0]);

				$bufer_template .= "<td><input type=\"text\" style=\"width:100%;max-width:437px;\" name=\"xfield[{$value[0]}]\" value=\"{$template_site_xf[$name_xfield][0]}\"></td></tr>";
				
		}	else {
		
	      $name_xf = "xfield[{$value[0]}]";
	      
	      $template_site_xf[$name_xf][0] = stripslashes($template_site_xf[$name_xf][0]);
	      
	      if ($config['charset'] == "utf-8") {
	      
$template_site_xf[$name_xf][0] = iconv('windows-1251', 'UTF-8', $template_site_xf[$name_xf][0]);

}	

$template_site_xf[$name_xf][0] = str_replace('"', '&quot;', $template_site_xf[$name_xf][0]);

				$bufer_template .= "<td><textarea rows=\"5\" style=\"width:100%;\" name=\"xfield_t[{$value[0]}]\">{$template_site_xf[$name_xf][0]}</textarea></td></tr>";
		}
		
  }
  
}

}

if ($bufer_template) {

echo <<<HTML

<div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse9">�������������� ���� CMS DLE <i class="icon-caret-down"></i></a>
    </div>
    <div id="collapse9" class="accordion-body collapse">
      <div class="accordion-inner padded">
	<table class="table table-normal">	{$bufer_template} </table>
      </div>
    </div>
  </div>

HTML;

}


if (count($template_pole_svoe)) {

$i = 1;

	foreach ($template_pole_svoe as $val_name => $value) {
	
if ($config['charset'] == "utf-8") {

$val_name = iconv('windows-1251', 'UTF-8', $val_name);

$value[2] = iconv('windows-1251', 'UTF-8', $value[2]);

$value[1] = iconv('windows-1251', 'UTF-8', $value[1]);

$value[0] = iconv('windows-1251', 'UTF-8', $value[0]);

}

$val_name = stripslashes($val_name);

$value[2] = stripslashes($value[2]);

$value[1] = stripslashes($value[1]);

$value[0] = stripslashes($value[0]);

$value[0] = str_replace('"', '&quot;', $value[0]);


			if ($value[2] == 'input') {
			
				$pole_svoe_new .= '<tr><td><input type="text" name="polenew_id['.$i.']" id="polenew_id['.$i.']" value="'.$val_name.'"></td><td><input type="text" name="polenew_id_name['.$i.']" id="polenew_id_name['.$i.']" value="'.$value[1].'"></td><td><select class="uniform" style="min-width:100px;" name="polenew_input['.$i.']" id="polenew_input['.$i.']"><option style="color: black" value="input" selected>input</option><option style="color: black" value="textarea">textarea</option></select></td><td><input type="text" style="width:100%;max-width:637px;" name="polenew_name['.$i.']" id="polenew_name['.$i.']" value="'.$value[0].'">&nbsp;&nbsp;<button type="button" class="btn btn-red deletepole"><i class="icon-remove"> �������</i></button></td></tr>';
		
		}	else {
		
	    $pole_svoe_new .= '<tr><td><input type="text" name="polenew_id['.$i.']" id="polenew_id['.$i.']" value="'.$val_name.'"></td><td><input type="text" name="polenew_id_name['.$i.']" id="polenew_id_name['.$i.']" value="'.$value[1].'"></td><td><select class="uniform" style="min-width:100px;" name="polenew_input['.$i.']" id="polenew_input['.$i.']"><option style="color: black" value="input">input</option><option style="color: black" value="textarea"  selected>textarea</option></select></td><td><textarea rows="5" style="width:100%;" name="polenew_name['.$i.']" id="polenew_name['.$i.']">'.$value[0].'</textarea><br /><br />&nbsp;&nbsp;<button type="button" class="btn btn-red deletepole"><i class="icon-remove"> �������</i></button></td></tr>';  
		
		}
$i++;  
}
}


if ($pole_svoe_new == '') {

$pole_svoe_new = '<tr><td><center><font color="red">�����</font></center></td><td><center><font color="red">�����</font></center></td><td><center><font color="red">�����</font></center></td><td><center><font color="red">�� ��� �� ��������� ���� ����!</font></center></td></tr>';

}

$nomer_pole_svoe = count($template_pole_svoe);

if ($nomer_pole_svoe == '') {

$nomer_pole_svoe = '1';

}

echo <<<HTML

</div></div>
<script>
$(document).ready(function() {
var Wrap   = $("#polesvoenew");
var AddButton       = $("#addpolenew");
var x = Wrap.length;
var numPole={$nomer_pole_svoe};
$(AddButton).click(function (e) 
{
numPole++; 
$(Wrap).append('<tr><td><input style="width:100%;" type="text" name="polenew_id['+numPole+']" id="polenew_id['+numPole+']"></td><td><input style="width:100%;" type="text" name="polenew_id_name['+numPole+']" id="polenew_id_name['+numPole+']"></td><td><select class="uniform" style="min-width:100px;" name="polenew_input['+numPole+']" id="polenew_input['+numPole+']"><option style="color: black" value="input">input</option><option style="color: black" value="textarea">textarea</option></select></td><td><textarea name="polenew_name['+numPole+']" rows="5" style="width:100%;" id="polenew_name['+numPole+']"></textarea><br /><br />&nbsp;&nbsp;<button type="button" class="btn btn-red deletepole"><i class="icon-remove"> �������</i></button></td></tr>');
x++;
return false;
});
$("table").on("click",".deletepole", function(e){ 
$(this).parent().parent().remove();
return false;
}) 

});
</script> 

<table class="table table-normal table-hover" id="polesvoenew">
<thead>
<tr>
<td style="width: 140px">������� name</td>
<td style="width: 200px">�������� ����</td>
<td style="width: 200px">���</td>
<td>������ ����</td>
</tr>
</thead>
{$pole_svoe_new}
</table>

<br/>&nbsp;&nbsp;<button type="button" class="btn btn-red" id="addpolenew"><i class="icon-folder-open-alt"></i> �������� ��� ����</button><br/><br/>

</div>
</div>
HTML;


if( $config_kinopoisk['anime_cat'] == "on" ) { $check_anime_cat = ' checked'; }

if( $config_kinopoisk['anime_mult'] == "on" ) { $check_anime_mult = ' checked'; }

if( $config_kinopoisk['dok_cat'] == "on" ) { $check_dok_cat = ' checked'; }

if( $config_kinopoisk['mult_cat'] == "on" ) { $check_mult_cat = ' checked'; }

if( $config_kinopoisk['tv_cat'] == "on" ) { $check_tv_cat = ' checked'; }

if( $config_kinopoisk['editnews_pkfdle'] == "on" ) { $check_editnews_pkfdle = ' checked'; }

if( $config_kinopoisk['category_fs'] == "on" ) { $check_category_fs = ' checked'; }


// ��������� ----------------------------------------------------------------------------------------------------------------------

$nomerGenre = count($parser_category);
$parser_categoryList = addslashes(CategoryNewsSelection());

echo <<<HTML
<div id="category" style='display:none'>


<div class="box">
<div class="box-header">
<div class="title">��������� ��������� �������</div>
</div>
<div class="box-content">
<script>
$(document).ready(function() {
var Wrap   = $("#catRutor_tr");
var AddButton       = $("#addcategory");
var x = Wrap.length;
var numcatRutor={$nomerGenre};
$(AddButton).click(function (e) 
{
numcatRutor++; 
$(Wrap).append('<tr><td class="col-xs-10 col-sm-6 col-md-7">&nbsp;&nbsp;<input type=text style="text-align: center;" name="catRutor_name['+numcatRutor+']" id="catRutor_name['+numcatRutor+']" size=50></td><td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="catRutor_id['+numcatRutor+']" id="catRutor_id['+numcatRutor+']">{$parser_categoryList}</select>&nbsp;&nbsp;<button type="button" class="btn btn-red deletecategory"><i class="icon-remove"> �������</i></button></td></tr>');
x++;
return false;
});
$("table").on("click",".deletecategory", function(e){ 
$(this).parent().parent().remove();
return false;
}) 

});
</script>
<table class="table table-normal">   

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������� ������ ������ ��� ������� � �������� :</h6><span class="note large"><font color="red">��������! �������� ������ ������� ����.</font> ���� ��������, ����� ����� ���������� �������� ��� ������� ��� ��������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="category_fs" value="on" {$check_category_fs}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��� �������������� ������� �� �������� ��������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="editnews_pkfdle" value="on" {$check_editnews_pkfdle}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ���� "�����", ��������� �����, ������ �� �������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="anime_cat" value="on" {$check_anime_cat}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ���� "�����", ��������� ���������� �� �������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="anime_mult" value="on" {$check_anime_mult}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ���� "��������������", ��������� �����, ������ �� �������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="dok_cat" value="on" {$check_dok_cat}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ���� "����������, ������������", ��������� �����, ������ �� �������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="mult_cat" value="on" {$check_mult_cat}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ���� "�������� ��, ���-���", ��������� �����, ������ �� �������� :</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="tv_cat" value="on" {$check_tv_cat}></td>
</tr>

</table></div></div>
<div class="alert alert-error">���� ��� ��������� ������ ��� ������� ����������� ��� ���: <b>�����</b> ��� <b>������</b>.<br /><br />
<font color="blue">��������! ������ ������� ���������� ����.</font> ��� ���� ����� ������ ����� �������� ��� ��������� ������� ��� ��������.<br>�� ������ ������� � ����� ������ ����� ��� ����� ��������, ��������: ��� ������ - <b>film_������</b>, ��� ������� - <b>serial_������</b>.<br>����� ���� ������ ������� ��� ��� ��������� ������ ��� ������� ���� ������.<br /><br />��������!<br />����� ��� ����������� � ��������� �����. ������ ����������� � ��������� �����. ������ ������ � ����� - ����� ����� �� <a href="http://parser-kino.ru/forum/cat-faq/topic-339.html" target="_blank">������</a>! </div>
<div class="box">

<div class="box-content">
 
<table class="table table-normal table-hover" id="catRutor_tr">
<thead>
<tr>
<td style="width: 250px">������� �������� �����, ������ ��� ���</td>
<td style="width: 250px">��������� �� �����</td>
</tr>
</thead>
HTML;

#****** ��������� ��������� ******#

if (count($parser_category)) {
$i = 1;
foreach ($parser_category as $kay => $val) {
if ($config['charset'] == "utf-8") {
$kay = iconv('windows-1251', 'UTF-8', $kay);
}
$bufer_category .= '<tr><td class="col-xs-10 col-sm-6 col-md-7">&nbsp;&nbsp;<input type=text name="catRutor_name['.$i.']" id="catRutor_name['.$i.']" value="'.$kay.'" style="text-align: center;" size=50></td><td><select class="uniform" style="min-width:100px;" name="catRutor_id['.$i.']" id="catRutor_id['.$i.']">'.CategoryNewsSelection($val).'</select>&nbsp;&nbsp;<button type="button" class="btn btn-red deletecategory"><i class="icon-remove"> �������</i></button></td></tr>';
$i++;
}
}
echo <<<HTML
{$bufer_category}


HTML;


echo <<<HTML

</table></div>
<br/>&nbsp;&nbsp;<button type="button" class="btn btn-red" id="addcategory"><i class="icon-folder-open-alt"></i> �������� ���������</button><br/><br/>
</div></div>
HTML;

// ������������ -------------------------------------------------------------------------------------------------------------------------------------------

if( $config_kinopoisk['seo_generator'] == "on" ) { $check_seo_generator = ' checked'; }

if( $config_kinopoisk['seo_generator_dv'] == "on" ) { $check_seo_generator_dv = ' checked'; }

if( $config_kinopoisk['seo_generator_t'] == "on" ) { $check_seo_generator_t = ' checked'; }

if( $config_kinopoisk['seo_generator_tv'] == "on" ) { $check_seo_generator_tv = ' checked'; }

if( $config_kinopoisk['seo_generator_base'] == "base" ) { $check_on_big1 = 'selected=""'; } 

if( $config_kinopoisk['seo_generator_base'] == "syn" ) { $check_of_sm2 = 'selected=""'; }

if( $config_kinopoisk['seo_generator_base'] == "mini" ) { $check_off_sm1 = 'selected=""'; }

if( $config_kinopoisk['seo_generator_base'] == "ruch" ) { $check_off_sm3 = 'selected=""'; }


echo <<<HTML
<div id="sinonim" class="box" style='display:none'>

<div class="box-header">
<div class="title">��������� �������������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������������ ��� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="seo_generator" value="on" {$check_seo_generator}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ����� �������� ������������ ����� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="seo_generator_dv" value="on" {$check_seo_generator_dv}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������������ ��� ������� ������ �� ��, ���...:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="seo_generator_t" value="on" {$check_seo_generator_t}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ����� �������� ������������ ����� �� ������� ������ �� ��, ���...:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="seo_generator_tv" value="on" {$check_seo_generator_tv}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���� ���������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><select class="uniform" style="min-width:100px;" name="seo_generator_base[]"><option value="base" {$check_on_big1}>700 000 ����</option><option value="syn" {$check_of_sm2}>180 000 ����</option><option value="mini"{$check_off_sm1}>48 000 ����</option><option value="ruch"{$check_off_sm3}>������ ���� 71 000 ����</option></select></td>
</tr>

</table>


</div>

</div>
HTML;

echo <<<HTML

<div id="trailer" style='display:none'>

HTML;

if( $config_kinopoisk['trailer_youtube'] == "on" ) { $check_trailer_youtube_on = ' checked'; }

if( $config_kinopoisk['trailer_server_on'] == "on" ) { $check_trailer_server_on = ' checked'; }

if( $config_kinopoisk['trailer_home_url'] == "on" ) { $check_trailer_home_url = ' checked'; }

if( $config_kinopoisk['trailer_title'] == "on" ) { $check_trailer_title = ' checked'; }

if( $config_kinopoisk['trailer_year'] == "on" ) { $check_trailer_year = ' checked'; }

echo <<<HTML

<div class="box">
<div class="box-header">
<div class="title">��������� �������� �������� � YouTube</div>
</div>
<div class="box-content">


<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������� �������� � YouTube:</h6><span class="note large"><font color"red">��������!</font> �� �� ���� ������� ������ �������� �� YouTube, ���� �������� ��� � �������: YouTube ����� ������ �� �� �����!</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="trailer_youtube" value="on" {$check_trailer_youtube_on}></td>
</tr>


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��� ������ API ���� c YouTube:</h6><span class="note large">���������� ��� �������� API ���� <a href="https://www.youtube.com/watch?v=Ix4ER_d5Fog" target="_blank">��� �����</a>.<br /><font color="red">��������! ��� API �����, ����� ����� �� YouTube �������� �� �����. ��� ������� �������� ������������� YouTube :)</font></span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="youtube_api" value="{$config_kinopoisk['youtube_api']}" size=50></td>
</tr>

</table>
</div>
</div>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� �������� �� ������</div>
</div>
<div class="box-content">


<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� ������� �� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="trailer_server_on" value="on" {$check_trailer_server_on}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��������� � URL �������� "{$config['http_home_url']}":</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="trailer_home_url" value="on" {$check_trailer_home_url}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� � URL �������� �������� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="trailer_title" value="on" {$check_trailer_title}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� � URL �������� ��� ������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="trailer_year" value="on" {$check_trailer_year}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� � URL �������� � ����� �����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="trailer_prefixs" value="{$config_kinopoisk['trailer_prefixs']}" size=50></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� �������� ����� ����� ���� ��������� �������:</h6><span class="note large">��������: "files". ���� �������� ������, ������� ����� ����������� � /uploads/files/</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="trailer_folder" value="{$config_kinopoisk['trailer_folder']}" size=50></td>
</tr>

</table>
</div>
</div>

</div>
HTML;



if ($torrent_php == 'on') {

// ������ -----------------------------------------------------------------------------------------------------------------------------------------

if( $config_kinopoisk['torrent'] == "on" ) { $check_torrent = ' checked'; }

if( $config_kinopoisk['torrent_on'] == "on" ) { $check_torrent_on = ' checked'; }

if( $config_kinopoisk['torrent_del'] == "on" ) { $check_torrent_del = ' checked'; }

if( $config_kinopoisk['freerutor'] == "on" ) { $check_freerutor = ' checked'; }

if( $config_kinopoisk['rutor'] == "on" ) { $check_rutor = ' checked'; }

if( $config_kinopoisk['rutor_url'] == "http://rutor.info/" ) { $check_rutor_url1 = ' selected'; }

if( $config_kinopoisk['rutor_url'] == "http://rutor.is/" ) { $check_rutor_url2 = ' selected'; }

if( $config_kinopoisk['katushka'] == "on" ) { $check_katushka = ' checked'; }

if( $config_kinopoisk['fast_torrent'] == "on" ) { $check_fast_torrent = ' checked'; }

if( $config_kinopoisk['tracker_msw'] == "on" ) { $check_tracker_msw = ' checked'; }

echo <<<HTML

<div id="torrent" style='display:none'>

<div class="box">
<div class="box-header">
<div class="title">��������� �������� ��������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ����� ������� ������ �� ����� ��������:</h6><span class="note large">����� ���� ��� �� �������� ����� �� ���� ������, ��� ����� ������������ ������ ������� ��������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="torrent" value="on" {$check_torrent}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� ������� ������ ��� ������:</h6><span class="note large">������� ���������� ������� ������ ������� ����� ���������� ��� ������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="search_limit" value="{$config_kinopoisk['search_limit']}" size=20></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� �������� �������� �� ������:</h6><span class="note large">���� ���������, ������� �� ����� �������� �� ������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="torrent_on" value="on" {$check_torrent_on}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������� ������� ����������� ������� ��� ���������� �������:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="torrent_del" value="on" {$check_torrent_del}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ��������� ������ Tracker For DLE (DLE+XBT):</h6><span class="note large"><font color="red">�������� ���� � ��� ���������� ������ Tracker For DLE. ���� � ��� ��� ������ Tracker For DLE � �� ��������, ����� ������ MySql �� ����� ��������</font></span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="tracker_msw" value="on" {$check_tracker_msw}></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">������ FreeRutor</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ FreeRutor:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="freerutor" value="on" {$check_freerutor}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>URL ������� ������� FreeRutor:</h6><span class="note large">������ URL ������� ���������, ���� �� ������ ��� ���� ��!</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="freerutor_url" value="{$config_kinopoisk['freerutor_url']}" size=50></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� FreeRutor:</h6><span class="note large">������� �����, �� ������� ����� ������ ������ ������ ������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="freerutor_sort" value="{$config_kinopoisk['freerutor_sort']}" size=10></td>
</tr>

HTML;

$login_freerutor = convert_shablon_tpl($config_kinopoisk['login_freerutor']);

$pass_freerutor = convert_shablon_tpl($config_kinopoisk['pass_freerutor']);

echo <<<HTML

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����� �� FreeRutor:</h6><span class="note large">����� ��������� �� ��������� ���������!</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="login_freerutor" value="{$login_freerutor}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ �� FreeRutor:</h6><span class="note large">������ ��������� �� ��������� ���������!</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="pass_freerutor" value="{$pass_freerutor}" size=30></td>
</tr>


</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">������ Rutor</div>
</div>

<div class="box-content">

<table class="table table-normal">


<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ Rutor:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="rutor" value="on" {$check_rutor}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>URL ������� ������� Rutor:</h6><span class="note large">���� � ��� �� �������� rutor.is, �������� ������ ��� ������� � ������� Curl.</span></td>
<td class="col-xs-2 col-md-5 settingstd">
<select class="uniform" style="min-width:100px;" name="rutor_url">
<option value="http://rutor.info/"{$check_rutor_url1}>rutor.info</option>
<option value="http://rutor.is/"{$check_rutor_url2}>rutor.is</option></select></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� Rutor:</h6><span class="note large">������� �����, �� ������� ����� ������ ������ ������ ������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="rutor_sort" value="{$config_kinopoisk['rutor_sort']}" size=10></td>
</tr>


</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">������ Katushka</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ Katushka:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="katushka" value="on" {$check_katushka}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>URL ������� ������� Katushka:</h6><span class="note large">������ URL ������� ���������, ���� �� ������ ��� ���� ��!</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="katushka_url" value="{$config_kinopoisk['katushka_url']}" size=50></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� Katushka:</h6><span class="note large">������� �����, �� ������� ����� ������ ������ ������ ������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="katushka_sort" value="{$config_kinopoisk['katushka_sort']}" size=10></td>
</tr>

HTML;

$login_katushka = convert_shablon_tpl($config_kinopoisk['login_katushka']);

$pass_katushka = convert_shablon_tpl($config_kinopoisk['pass_katushka']);

echo <<<HTML

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>����� �� Katushka:</h6><span class="note large">����� ��������� �� ��������� ���������!</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="login_katushka" value="{$login_katushka}" size=30></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ �� Katushka:</h6><span class="note large">������ ��������� �� ��������� ���������!</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="pass_katushka" value="{$pass_katushka}" size=30></td>
</tr>

</table>

</div></div>

<div class="box">
<div class="box-header">
<div class="title">������ Fast-Torrent</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������ Fast-Torrent:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="fast_torrent" value="on" {$check_fast_torrent}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>URL ������� ������� Fast-Torrent:</h6><span class="note large">������ URL ������� ���������, ���� �� ������ ��� ���� ��!</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="fast_torrent_url" value="{$config_kinopoisk['fast_torrent_url']}" size=50></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>���������� Fast-Torrent:</h6><span class="note large">������� �����, �� ������� ����� ������ ������ ������ ������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="fast_sort" value="{$config_kinopoisk['fast_sort']}" size=10></td>
</tr>

</table>

</div></div>

</div>

HTML;

}

if ($video_php == 'on') {

echo <<<HTML

<div id="video" style='display:none'>

HTML;

if( $config_kinopoisk['video'] == "on" ) { $check_video = ' checked'; }

if( $config_kinopoisk['video_hdlight'] == "on" ) { $check_video_hdlight = ' checked'; }

if( $config_kinopoisk['video_stormo'] == "on" ) { $check_video_stormo = ' checked'; }

if( $config_kinopoisk['video_http'] == "on" ) { $check_video_http = ' checked'; }

$hdlight_domain = convert_shablon_tpl($config_kinopoisk['hdlight_domain']);

echo <<<HTML

<div class="box">
<div class="box-header">
<div class="title">��������� �������� ����� ������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������� ����� ������:</h6><span class="note large">����� ���� ��� �� �������� ����� �� ���� ������, ��� ����� ��������� ������� ����� ������.</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="video" value="on" {$check_video}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ iframe �����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="width_iframe" value="{$config_kinopoisk['width_iframe']}" size=10></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>������ iframe �����:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="height_iframe" value="{$config_kinopoisk['height_iframe']}" size=10></td>
</tr>

</table>


</div>

</div>

<div class="box">
<div class="box-header">
<div class="title">��������� Stormo.tv</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� Stormo.tv:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="video_stormo" value="on" {$check_video_stormo}></td>
</tr>

</table>


</div>

</div>

<div class="box">
<div class="box-header">
<div class="title">��������� HD Light (moonwalk)</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� HD Light (moonwalk):</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="video_hdlight" value="on" {$check_video_hdlight}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� http �� https:</h6></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="video_http" value="on" {$check_video_http}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>��� ������ API ���� HD Light (moonwalk):</h6><span class="note large">API ���� ����� ����� <a href="http://docs.moonwalk.cc/" target="_blank">��� �����</a>.<br /><font color="red">��������! ��� API �����, ����� ����� �� HD Light �������� �� �����. ��� ������� �������� ������������� moonwalk!</font></span></td>
<td class="col-xs-2 col-md-5 settingstd"><input type=text style="text-align: center;" name="hdlight_api" value="{$config_kinopoisk['hdlight_api']}" size=40></td>
</tr>

</table>


</div>

</div>


HTML;

echo <<<HTML


</div>

HTML;


}

//������ ������

if( $config_kinopoisk['psp_actors'] == "on" ) { $check_psp_actors = ' checked'; }

if( $config_kinopoisk['psp_director'] == "on" ) { $check_psp_director = ' checked'; }

echo <<<HTML
<div id="actors" class="box" style='display:none'>

<div class="box">
<div class="box-header">
<div class="title">������ Parser Actors for DLE</div>
</div>

<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������� �������:</h6><span class="note large">���� ��������, ����� ���������� ���� ������ �������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="psp_actors" value="on" {$check_psp_actors}></td>
</tr>

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ������� ����������:</h6><span class="note large">���� ��������, ����� ���������� ���� ������ ����������</span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="psp_director" value="on" {$check_psp_director}></td>
</tr>

</table>

</div></div>

</div>

HTML;


if( $config_kinopoisk['alt_tech'] == "on" ) { $check_alt_tech = ' checked'; }


function size_dir($dir) {
$totalsize=0;
if ($dirstream = @opendir($dir)) {
while (false !== ($filename = readdir($dirstream))) {
if ($filename!="." && $filename!="..")
{
if (is_file($dir."/".$filename))
$totalsize+=filesize($dir."/".$filename);

if (is_dir($dir."/".$filename))
$totalsize+=dir_size($dir."/".$filename);
}
}
}
closedir($dirstream);
return $totalsize;
}

//����� ���
$cache = formatsize( size_dir( ENGINE_DIR."/modules/parser-kinopoisk/cache/") );

define('FOLDER_PREFIX', date("Y-m"));

$important_files = array(
'./engine/modules/parser-kinopoisk/cache/',
'./engine/data/',
'./uploads/',
'./uploads/files/',
'./uploads/posts/',
'./templates/'.$config['skin'].'/dleimages/watermark_light.png',
'./templates/'.$config['skin'].'/dleimages/watermark_dark.png',
);


$chmod_errors = 0;
$not_found_errors = 0;
    foreach($important_files as $file){

        if(!file_exists($file)){
            $file_status = "<font color=red>�� ������!</font>";
            $not_found_errors ++;
        }
        elseif(is_writable($file)){
            $file_status = "<font color=green>���������</font>";
        } 
        else{
            @chmod($file, 0777);
            if(is_writable($file)){
                $file_status = "<font color=green>���������</font>";
            }else{
                @chmod("$file", 0755);
                if(is_writable($file)){
                    $file_status = "<font color=green>���������</font>";
                }else{
                    $file_status = "<font color=red>�� ������!</font>";
                    $chmod_errors ++;
                }
            }
        }
        $chmod_value = @decoct(@fileperms($file)) % 1000;
$bufer_chmod .= <<<HTML
<tr><td><b>{$file}</b></td><td>{$chmod_value}</td><td>{$file_status}</td></tr>
HTML;
}

if ($config_kinopoisk['zaderjka'] > 0) {

$zaderjka = '<div class="alert alert-error" style="padding:10px; margin-bottom:10px;">�� ������� "�������� �������" ������ 0. ����������� ���������� 0!</div>';

}

if ($config_kinopoisk['cache_trailer']) {

$cache_trailer = '<div class="alert alert-error" style="padding:10px; margin-bottom:10px;">�� �������� "������� ��������" - ��� +1 ������ � ����� ���� �����. ���� ���������� � �������� �� �����, ������������ ����������� ���������!</div>';

}

if ($config_kinopoisk['review_number'] > 3 && $config_kinopoisk['review']) {

$review_number = '<div class="alert alert-error" style="padding:10px; margin-bottom:10px;">�� ������� "���������� ��������" ������ 3 - ��� +1 ������ � ����� ���� �����. ����������� ���������� 3!</div>';

}

if ($config_kinopoisk['trivia_number'] > 2 && $config_kinopoisk['trivia']) {

$trivia_number = '<div class="alert alert-error" style="padding:10px; margin-bottom:10px;">�� ������� "���������� ������ �� ��, ���..." ������ 2 - ��� +1 ������ � ����� ���� �����. ����������� ���������� 2!</div>';

}

if ($config_kinopoisk['error_film']) {

$error_film = '<div class="alert alert-error" style="padding:10px; margin-bottom:10px;">�� �������� "������� ������ � ������" - ��� +1 ������ � ����� ���� �����. ���� ���������� � ������� � ������ �� �����, ������������ ����������� ���������!</div>';

}

if ($config_kinopoisk['url_proxy_type'] > 0) {

$url_proxy_type = '<div class="alert alert-info" style="padding:10px; margin-bottom:10px;">�� �������� ������ ��� �������� � ���� ������. ���� � ��� ������ ��� ������, ����������� �� �������� ������ ��� �������� � ���� ������.</div>';

}

if ($config_kinopoisk['audience']) {

$audience = '<div class="alert alert-success" style="padding:10px; margin-bottom:10px;">�� �������� ������ "�������" ���������� � ���� ��������. ���������� ������ ����������� ��������� ������� ������� �������� �� ������.</div>';

}

if ($config_kinopoisk['rating_img']) {

$rating_img = '<div class="alert alert-success" style="padding:10px; margin-bottom:10px;">�� �������� ��������� �� ������ �������� �������� ���� ������. ���������� ������ ����������� ��������� ������� ������� �������� �� ������.</div>';

}

echo <<<HTML

<script language='JavaScript' type="text/javascript">

function cache_admin(zadanie) {
	$.post("/engine/modules/parser-kinopoisk/admin.php", {cache_admin_c:"cache", user_hash:"{$dle_login_hash}", zadanie:zadanie},
		function(data){
			$('#cache_admin').html(data);
       Growl.info({
						title: '����������',
						text: '��� ������� ������.',
					});
		}
	);
}

</script>


<div id="alt_tech" style='display:none'>


<div class="box">
<div class="box-header">
<div class="title">��������� ������� �������</div>
</div>
<div class="box-content">

<table class="table table-normal">

<tr>
<td class="col-xs-10 col-sm-6 col-md-7"><h6>�������� ����� ������� �������:</h6><span class="note large"><font color="red">������ ���������, ������ ��� �������������!</font></span></td>
<td class="col-xs-2 col-md-5 settingstd"><input class="iButton-icons-tab" type="checkbox" name="alt_tech" value="on" {$check_alt_tech}></td>
</tr>

</table>


</div></div>


<div class="box">
<div class="box-header">
<div class="title">���</div>
</div>
<div class="box-content">

<div class="tab-content">
                     <div class="tab-pane active">


<div class="row box-section">
<div class="col-md-6">����� ������ ����</div>
<div class="col-md-3"><span id="cache_admin">{$cache}</span></div>
<div class="col-md-3"><button onclick="cache_admin('clear'); return !1;" class="btn btn-red"><i class="icon-trash"></i> �������� ���</button></div>
</div>


</div></div>

</div></div>


<div class="box">
<div class="box-header">
<div class="title">������ ������������������</div>
</div>
<div class="box-content">

<div class="row box-section">������ ������ ���������� ������ �������� ������� � �� �� ����������� �� ��������� ������������ �� ���������� ��� ��������� ��� ��� ���� �������� �������, ��� �������� �������� �� ��� ������. � ������� ���� ��������� ������������, ������� ��������� ����������� ������� ��������. � ������� ���� ��������� ������������ ������� ����� ������� ��������. � ������� ���� ������������, ������� ��������� ������������� ������� �������� �� ������.
	
<div class="row box-section">
{$zaderjka}{$cache_trailer}{$review_number}{$trivia_number}{$error_film}{$url_proxy_type}{$audience}{$rating_img}

</div>	
	
	
	</div>


</div></div>

<div class="box">

<div class="box-content">

<table class="table table-normal table-hover">
<thead>
<tr>
<td style="width: 400px">����</td>
<td>�����</td>
<td>������</td>
</tr>
</thead>
{$bufer_chmod}
</table>

</div></div>




</div>


</form>
<div style="margin-bottom:30px;">
<div id="errorListconf" class="alert alert-error"></div>
</div>
<div style="margin-bottom:30px;">
<button onclick="kinopoisk_save(); return !1;" class="btn btn-red"><i class="icon-save"></i> ��������� ���������</button>
<a href="{$config['http_home_url']}{$config['admin_path']}?mod=main" class="btn btn-gray"><i class="icon-arrow-left"></i> �������� � ������ ��������</a>
</div>



<!-- maincontent end -->
</div>  
</div>
</div>
</body>
</html>

HTML;

?>