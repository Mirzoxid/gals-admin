<?php
/*
=====================================================
SENPAI PLS NOTICE ME
-----------------------------------------------------
Автор : Gameer
-----------------------------------------------------
Site : http://gameer.name/
-----------------------------------------------------
Copyright (c) 2016 Gameer
=====================================================
Данный код защищен авторскими правами
*/

if( ! defined( 'DATALIFEENGINE' ) ) return;
$limit = is_numeric($limit) ? intval($limit) : 5;
$temp = empty($temp) ? "shortstory" : trim(strip_tags(stripslashes($temp)));
if($dle_module == "showfull")
{
	if(intval($_GET["newsid"]))
	{
		$newsid = intval($_GET["newsid"]);
		if(isset($_COOKIE['senpainoticeme']))
		{
			$array_senpainoticeme = explode(",",$_COOKIE['senpainoticeme']);
			array_unshift($array_senpainoticeme, $newsid);
			$array_senpainoticeme = array_unique($array_senpainoticeme);
			if(count($array_senpainoticeme) > $limit)
			{
				$numb_to_delete = count($array_senpainoticeme) - $limit;
				for($i = 0; $i < $numb_to_delete; $i++)
					unset($array_senpainoticeme[count($array_senpainoticeme)-1]);
			}
			$array_senpainoticeme = implode(",", $array_senpainoticeme);
			set_cookie("senpainoticeme", $array_senpainoticeme, time() + 604800);
		}
		else
			set_cookie("senpainoticeme", $newsid, time() + 604800);
	}
}

if(isset($_COOKIE['senpainoticeme']))
{
	if($dle_module == "showfull")
		$array_senpainoticeme = explode(",", $array_senpainoticeme);
	else
	{
		$array_senpainoticeme = null;
		$array_senpainoticeme = explode(",",$_COOKIE['senpainoticeme']);
	}
	for($i = 0; $i < count($array_senpainoticeme) - 1; $i++)
		$array_senpainoticeme[$i] = intval($array_senpainoticeme[$i]);
	if(count($array_senpainoticeme))
	{
		$array_senpainoticeme = implode("','", $array_senpainoticeme);
		$sql_result = $db->query("SELECT * FROM " . PREFIX . "_post LEFT JOIN " . PREFIX . "_post_extras ON (" . PREFIX . "_post.id=" . PREFIX . "_post_extras.news_id) WHERE id IN ('".$array_senpainoticeme."')");
		$tpl->load_template( $temp . '.tpl' );
		include (ENGINE_DIR . '/modules/show.custom.php');
		echo $tpl->result['content'];
	}
}
?>