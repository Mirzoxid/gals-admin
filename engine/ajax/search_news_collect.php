<?php

@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );

define( 'DATALIFEENGINE', true );
define( 'ROOT_DIR', substr( dirname(  __FILE__ ), 0, -12 ) );
define( 'ENGINE_DIR', ROOT_DIR . '/engine' );

include ENGINE_DIR . '/data/config.php';

date_default_timezone_set( $config['date_adjust'] );

require_once ENGINE_DIR . '/classes/mysql.php';
require_once ENGINE_DIR . '/data/dbconfig.php';
require_once ENGINE_DIR . '/modules/functions.php';

$Query = $db->safesql( htmlspecialchars( trim( strip_tags( convert_unicode( $_GET['q'], $config['charset'] ) ) ), ENT_QUOTES, $config['charset']) );

if( $Query == "" ) die();

$QueryConnect = $db->query("SELECT id, title FROM ".PREFIX."_post WHERE title LIKE '%{$Query}%' ORDER BY title DESC LIMIT 0, 10");

while( $row = $db->get_row( $QueryConnect ) )
{
	$row['title'] = mb_convert_encoding($row['title'], "utf-8", "cp1251");
	$QueryOutput[] = array
	(
		'id' => $row['id'],
		'title' => $row['title']
	);
}

@header("Content-type: application/json; charset=" . $config['charset']);
echo json_encode( $QueryOutput );

?>