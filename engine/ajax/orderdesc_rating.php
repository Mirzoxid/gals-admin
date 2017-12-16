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
@session_start();

$order = intval( $_POST['order'] );
if($order<1) die( "Hacking attempt!" );

define( 'DATALIFEENGINE', true );
define( 'ROOT_DIR', substr( dirname(  __FILE__ ), 0, -12 ) );
define( 'ENGINE_DIR', ROOT_DIR . '/engine' );
include ENGINE_DIR . '/data/config.php';
include ENGINE_DIR . '/data/orderdesc.php';
require_once ENGINE_DIR . '/classes/mysql.php';
require_once ENGINE_DIR . '/data/dbconfig.php';
require_once ENGINE_DIR . '/modules/functions.php';

@header( "Content-type: text/html; charset=" . $config['charset'] );
require_once ENGINE_DIR . '/modules/sitelogin.php';
if( !$is_logged ) $member_id['user_group'] = 5;
if( in_array($member_id['user_group'],$order_config['allow2vote']) ){
	$row = $db->super_query( "SELECT order_id FROM " . PREFIX . "_orderdesc_ratelog where order_id={$order} AND ip='{$_IP}'" );
	if(!$row['order_id'] AND count( explode( ".", $_IP ) ) == 4){
		$db->query( "UPDATE " . PREFIX . "_orderdesc SET rating=rating+1 WHERE id={$order}" );
		$db->query( "INSERT INTO " . PREFIX . "_orderdesc_ratelog (order_id, ip) values ('$order', '$_IP')" );
	}else die("{\"msg\": \"Вы уже голосовали\"}");
}else die("{\"msg\": \"Вы не можете голосовать\"}");
$row = $db->super_query("SELECT rating FROM ".PREFIX."_orderdesc WHERE id={$order}");
echo "{\"rating\":\"{$row['rating']}\",\"msg\":\"\"}";
?>