<?php
/*
=====================================================
 Олег Александрович a.k.a. Sander
-----------------------------------------------------
 http://nfhelp.ru/
-----------------------------------------------------
 Copyright (c) 2009-2012
=====================================================
*/
@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );

define( 'DATALIFEENGINE', true );
define( 'ROOT_DIR', substr( dirname(  __FILE__ ), 0, -12 ) );
define( 'ENGINE_DIR', ROOT_DIR . '/engine' );

include ENGINE_DIR . '/data/config.php';
include ENGINE_DIR . '/data/orderdesc.php';

require_once ENGINE_DIR . '/classes/mysql.php';
require_once ENGINE_DIR . '/data/dbconfig.php';
require_once ENGINE_DIR . '/modules/functions.php';

require_once ENGINE_DIR . '/modules/sitelogin.php';
if( !$is_logged AND !$order_config['allow_guest'] ) die( "error" );

$title = $db->safesql( trim( convert_unicode( $_POST['title'], $config['charset'] ) ) );
if( dle_strlen($title,$config['charset']) < 3 ) die();

$buffer = "";
$db->query( "SELECT title, orig_title, year, link, status,  MATCH (title, orig_title) AGAINST ('$title') as score FROM " . PREFIX . "_orderdesc WHERE title LIKE '%{$title}%' OR MATCH (title, orig_title) AGAINST ('{$title}') ORDER BY score DESC, date DESC LIMIT 5" );
while($row = $db->get_row()){
	$year = intval( $row['year'] );
	if($row['orig_title']) $row['title'] .= " / ".$row['orig_title'];
	$row['title'] = stripslashes( $row['title'] );
	if($row['link']) $row['title'] = "<a href=\"{$row['link']}\" target=\"_blank\">{$row['title']}</a>";
	if($year>0) $row['title'] = "<b>{$year}</b> - {$row['title']}";
	if($row['status']=='done') $row['status'] = "Готово";
	elseif($row['status']=='deny') $row['status'] = "Отказано";
	elseif($row['status']=='work') $row['status'] = "В работе";
	else $row['status'] = "Ожидает";
	$buffer .= "<li><span title=\"Статус заявки\">{$row['status']}</span>{$row['title']}</li>";
}
$db->close();
@header( "Content-type: text/html; charset=" . $config['charset'] );
if(!$buffer) $buffer = "<li>Совпадений не найдено</li>";
echo $buffer;
?>