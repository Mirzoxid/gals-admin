<?php
@error_reporting(E_ALL);
@ini_set('error_reporting', E_ALL);

define('DATALIFEENGINE', true);
define('ROOT_DIR', "..");
define('ENGINE_DIR', ROOT_DIR . '/engine');

require_once(ENGINE_DIR . '/data/config.php');

@header("Content-type: text/html; charset={$config['charset']}");

$site = $config['http_home_url'];

$refer = $site;
$ch = curl_init('http://parser-kino.ru/test_curl.html');
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 ( .NET CLR 3.5.30729)');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);
curl_setopt($ch, CURLOPT_REFERER, $refer);
$page = curl_exec($ch);
curl_close($ch);

echo $page;
?>