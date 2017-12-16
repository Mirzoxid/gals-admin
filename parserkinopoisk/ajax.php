<?php

define('DATALIFEENGINE', true);

define('ROOT_DIR', substr(dirname( __FILE__ ), 0, -15));

define('ENGINE_DIR', ROOT_DIR . '/engine');

require_once(ENGINE_DIR.'/data/config.php');

@header("Content-type: text/html; charset={$config['charset']}");

if($_POST['action']=="createdb") {

	include ENGINE_DIR . '/classes/mysql.php';
	
	include ENGINE_DIR . '/data/dbconfig.php';

$c_db = ($config['charset'] == "windows-1251") ? "cp1251" : "utf8";

$tableSchema = array();

$tableSchema[] = ("DELETE FROM ".PREFIX."_admin_sections WHERE name = 'kinopoisk_dle'");
$tableSchema[] = ("INSERT INTO ".PREFIX."_admin_sections (name, title, descr, icon, allow_groups) VALUES ('kinopoisk_dle', 'Parser Kinopoisk for DLE v6.1', 'Настройка парсера', 'kinopoisk_dle.png', '1')");

$films_check = false;

$news_id_kino = '0';

if (( $news_id_kino == 0 && $db->super_query( 'SHOW COLUMNS FROM ' . PREFIX . '_post WHERE Field = \'kp_id_movie\'' ) )) {

$db->query ("ALTER TABLE ".PREFIX."_post CHANGE kp_id_movie kp_id_movie INT( 11 ) NOT NULL DEFAULT '0'");

$films_check = true;

} else {

$db->query ("ALTER TABLE ".PREFIX."_post ADD kp_id_movie INT( 11 ) NOT NULL DEFAULT '0'");	

}


$actors_db = $db->super_query("SHOW TABLES WHERE `Tables_in_" . DBNAME . "` = '" . PREFIX . "_psp_actors'");

	if(!$actors_db["Tables_in_" . DBNAME]) {
	
	$tableSchema[] = "CREATE TABLE IF NOT EXISTS " . PREFIX . "_psp_actors (
  `id` int(11) NOT NULL,
  `actors_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alt_name` varchar(190) NOT NULL DEFAULT '',
  `kinopoisk_id` mediumtext NOT NULL,
  `actor` tinyint(1) NOT NULL DEFAULT '0',
  `director` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM  DEFAULT CHARSET={$c_db} AUTO_INCREMENT=0 ;";

$tableSchema[] = "ALTER TABLE " . PREFIX . "_psp_actors ADD PRIMARY KEY (`id`);";

$tableSchema[] = "ALTER TABLE " . PREFIX . "_psp_actors MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;";
	
	} 


foreach($tableSchema as $table) {

        $db->query($table);

      }

echo "<div class=\"alert alert-success alert-dismissible fade in\" role=alert> <button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button> В " . PREFIX . "_admin_sections: добавлена запись - OK</div>";

}

?>