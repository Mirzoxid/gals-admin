<?php

include_once ENGINE_DIR . '/data/collections.php';

if( $dle_module == 'collections'AND !$_GET['id'] )
{
	$metatags['title'] = $collect['title'];
	$metatags['description'] = $collect['descr'];
	$metatags['keywords'] = $collect['keywd'];

	if( $cstart )
	{
		$cstart = $cstart - 1;
		$cstart = $cstart * $collect['count_coll'];
	}

	$db->query("SELECT * FROM ".PREFIX."_collections ORDER BY DATE LIMIT " . $cstart . "," . $collect['count_coll']);

	while( $row = $db->get_row() )
	{
		$tpl->load_template('collections/item_coll.tpl');

		$tpl->set('{id}', $row['id']);
		$tpl->set('{title}', $row['title']);
		$tpl->set('{text}', $row['text']);
		$tpl->set('{date}', date('Y-d-m',strtotime($row['date'])));
		$tpl->set('{autor}', $row['autor']);
		$tpl->set('{link}', $config['http_home_url'] . $collect['link_page'] . '/' . $row['alt_name'] . '/');

		if( $row['image'] )
		{
			$tpl->set('[image-big]', '');
			$tpl->set('[/image-big]', '');
			$tpl->set('[image-min]', '');
			$tpl->set('[/image-min]', '');
			
			$tpl->set('{image-big}', '/uploads/' . $collect['folder_up'] . '/' . $row['image']);
			$tpl->set('{image-min}', '/uploads/' . $collect['folder_up'] . '/sm/' . $row['image']);
		}
		else
		{
			$tpl->set_block("#\\[image-big\\].+?\\[/image-big\\]#is","");
			$tpl->set_block("#\\[image-min\\].+?\\[/image-min\\]#is","");
			$tpl->set('{image-big}', '');
			$tpl->set('{image-min}', '');
		}

		$tpl->compile('item');
		$tpl->clear();
	}
}
elseif( $dle_module == 'collections' AND $_GET['id'] )
{
	$id = $db->safesql($_GET['id']);
	$rowe = $db->super_query("SELECT * FROM ".PREFIX."_collections WHERE alt_name = '{$id}'");

	if( $rowe['id'] )
	{
		$metatags['title'] = $rowe['mtitle'];
		$metatags['description'] = $rowe['descr'];
		$metatags['keywords'] = $rowe['keywd'];

		//$rowe['text'] = stripslashes( $rowe['text'] );

		$tpl->result['meta_h1'] = $rowe['meta_h1'];
		$tpl->result['meta_text'] = $rowe['text'];

		if( $cstart )
		{
			$cstart = $cstart - 1;
			$cstart = $cstart * $collect['count_news'];
		}

		$post_id = str_replace(',', '|', $rowe['nid']);

		$sql_select = "SELECT p.id, p.autor, p.date, p.short_story, CHAR_LENGTH(p.full_story) as full_story, p.xfields, p.title, p.category, p.alt_name, p.comm_num, p.allow_comm, p.fixed, p.tags, e.news_read, e.allow_rate, e.rating, e.vote_num, e.votes, e.view_edit, e.editdate, e.editor, e.reason FROM " . PREFIX . "_post p LEFT JOIN " . PREFIX . "_post_extras e ON (p.id=e.news_id) WHERE id regexp '[[:<:]](" . $post_id . ")[[:>:]]' AND approve=1 AND allow_main=1 LIMIT " . $cstart . "," . $collect['count_news'];
		$sql_count = "SELECT COUNT(*) as count FROM " . PREFIX . "_post WHERE id regexp '[[:<:]](" . $post_id . ")[[:>:]]' AND approve=1 AND allow_main=1";
		$sql_news = "";

		$allow_active_news = true;
		$active_collect = true;
		$url_page = $config['http_home_url'] . $collect['link_page'] . '/' . $rowe['alt_name'];
		include_once ENGINE_DIR . '/modules/show.short.php';
	}
	else
	{
		@header("HTTP/1.0 404 Not Found");
		msgbox( $lang['all_info'], 'Данной страницы не существует' );
		echo '<style>#dle-content{display: none;}</style>';
	}
}

$tpl->load_template('collections/index.tpl');

if( $dle_module == 'collections' AND !$_GET['id'] )
{
	$tpl->set('[main]', '');
	$tpl->set('[/main]', '');
	$tpl->set_block("#\\[not-main\\].+?\\[/not-main\\]#is","");
}
elseif( $dle_module == 'collections' AND $_GET['id'] )
{
	$tpl->set('[not-main]', '');
	$tpl->set('[/not-main]', '');
	$tpl->set_block("#\\[main\\].+?\\[/main\\]#is","");
}
else
{
	$tpl->set_block("#\\[main\\].+?\\[/main\\]#is","");
	$tpl->set_block("#\\[not-main\\].+?\\[/not-main\\]#is","");
}

$tpl->set('{meta-h1}', $tpl->result['meta_h1']);
$tpl->set('{text}', $tpl->result['meta_text']);
$tpl->set('{item}', $tpl->result['item']);

$tpl->compile('content');
$tpl->clear();

?>