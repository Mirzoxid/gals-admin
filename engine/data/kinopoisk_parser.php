<?php
//Parser Kino Poisk for DLE
//Configurations

$config_kinopoisk = array (
'charset' => "windows-1251",
'version' => "v6.1",

//����� ���������
'url_kinopoisk' => "https://www.kinopoisk.ru/",
'cache_actors' => "",
'user_group' => "1,2,3",
'user_group_admin' => "1,2,3",
'all_films' => "",
'js_polnuy' => "",
'js_polnuy_edit' => "",
'empty' => "",
'rating_img' => "",
'kino_imdb' => "",
'studio' => "on",
'serial_time' => "",
'keywords_count' => "0",
'keywords_alt_count' => "0",
'audience' => "",
'mpaa' => "",
'audience_pr' => "",
'audience_def' => "-",
'arlencode_tags' => "",
'dvd_trim' => "",
'premiere_trim' => "",
'premiere_date' => "j M Y, D",
'dvd_date' => "j M Y, D",
'trailer_time' => "m ��� s ���.",

//���
'tags_year' => "on",
'year_u' => "",

//������
'country_count' => "0",
'country_u' => "",
'tags_country' => "on",
'country_random' => "",

//��������
'director_count' => "3",
'director_u' => "",
'tags_director' => "off",
'director_random' => "",
'director_images' => "",

//��������
'scenario_count' => "3",
'scenario_u' => "",
'tags_scenario' => "off",
'scenario_random' => "",
'scenario_images' => "",

//��������
'producer_count' => "3",
'producer_random' => "",
'producer_images' => "",
'producer_u' => "",
'tags_producer' => "off",



//��������
'operator_count' => "3",
'operator_random' => "",
'operator_images' => "",
'operator_u' => "",
'tags_operator' => "off",

//����������
'composer_count' => "3",
'composer_random' => "",
'composer_images' => "",
'composer_u' => "",
'tags_composer' => "off",

//��������
'artist_count' => "3",
'artist_random' => "",
'artist_images' => "",
'artist_u' => "",
'tags_artist' => "off",

//������
'installation_count' => "3",
'installation_random' => "",
'installation_images' => "",
'installation_u' => "",
'tags_installation' => "off",

//�����
'genre_count' => "0",
'genre_random' => "",
'genre_u' => "",
'tags_genre' => "off",

//� �����
'actors_count' => "10",
'actors_random' => "",
'actors_images' => "",
'actors_u' => "",
'tags_actors' => "off",

//���� �����������
'actors_dub_count' => "5",
'actors_dub_random' => "",
'actors_dub_images' => "",
'actors_dub_u' => "",
'tags_actors_dub' => "off",

//������� �����������

'person_sjal' => "80",
'prefixs_ti_person' => "",
'prefixs_person' => "",
'person_razmer' => "100x140",
'no_person' => "/uploads/no_person.png",

//������ �� �� ���
'trivia' => "",
'trivia_number' => "0",
'trivia_prefix' => "[i]",
'trivia_suffix' => "[/i]",
'trivia_otstup' => "<br>------<br>",

//������ � ������
'error_film' => "",
'error_film_number' => "0",
'error_film_prefix' => "[i]",
'error_film_suffix' => "[/i]",
'error_film_otstup' => "<br>------<br>",

//��������
'review' => "",
'review_number' => "0",
'review_title' => "",
'review_prefix_t' => "[u]",
'review_suffix_t' => "[/u]",
'review_otstup_t' => "<br>------<br>",
'review_prefix_r' => "[i]",
'review_suffix_r' => "[/i]",
'review_otstup_r' => "<br>------<br>",

//���������
'anime_cat' => "",
'anime_mult' => "",
'dok_cat' => "",
'mult_cat' => "",
'tv_cat' => "",
'editnews_pkfdle' => "",
'category_fs' => "",

//Curl
'follow_loc' => "1",
'return_tra' => "1",
'curl_time' => "50",
'follow_loc_t' => "1",
'return_tra_t' => "1",
'curl_time_t' => "50",
'url_proxy_t' => "",
'url_proxy_type_t' => "0",
'url_proxy' => "",
'url_proxy_type' => "0",
'trailer_proxy' => "",
'trailer_proxy_type' => "",

'seo_t' => "",
'seo_type_t' => "0",

//�����������
'screen_stills' => "on",
'images_url' => "on",
'images_del' => "on",
'images_side' => "",
'obrez' => "1",

//�������� ������
'osn_poster' => "on",
'osn_poster_water' => "",
'prefixs_osn_poster' => "",
'prefixs_ti_osn_poster' => "",
'osn_poster_razmer' => "0",
'osn_poster_tumb' => "0",
'osn_posterumb_zad' => "0",
'osn_poster_alt' => "/uploads/poster_none.png",
'osn_poster_sjal' => "80",

//������� ������
'big_poster' => "on",
'big_poster_water' => "",
'prefixs_big_poster' => "",
'prefixs_ti_big_poster' => "",
'big_poster_razmer' => "0",
'big_poster_tumb' => "0",
'big_posterumb_zad' => "0",
'big_poster_alt' => "/uploads/poster_none.png",
'big_poster_sjal' => "80",

//�������
'big_oblojka' => "",
'big_oblojka_water' => "",
'prefixs_big_oblojka' => "",
'prefixs_ti_big_oblojka' => "",
'big_oblojka_razmer' => "0",
'big_oblojka_tumb' => "0",
'big_oblojkaumb_zad' => "0",
'big_oblojka_sjal' => "80",


'poster_vubor' => "on",

'screen_vubor' => "",
'screen_nomer' => "3",
'screen_water' => "",
'prefixs_user_screen' => "",
'prefixs_title_screen' => "",
'screen_razmer' => "0",
'screen_tumb' => "0",
'screentumb_zad' => "0",
'screen_sjal' => "80",
'screen_sjal_png' => "0",

'stills_vubor' => "on",
'stills_nomer' => "3",
'stills_water' => "",
'prefixs_user_stills' => "",
'prefixs_title_stills' => "",
'stills_razmer' => "0",
'stills_tumb' => "450x200",
'stillstumb_zad' => "0",
'stills_sjal' => "80",
'stills_sjal_png' => "0",

'wall_vubor' => "",
'wall_nomer' => "0",
'wall_water' => "",
'prefixs_user_wall' => "",
'prefixs_title_wall' => "",
'wall_razmer' => "0",
'wall_tumb' => "0",
'walltumb_zad' => "0",
'walls_siz' => "800",

'wall_sjal' => "80",
'wall_sjal_png' => "0",

'postes_vubor' => "on",
'postes_nomer' => "5",
'postes_water' => "",
'prefixs_user_postes' => "",
'prefixs_title_postes' => "",
'postes_razmer' => "0",
'postes_tumb' => "0",
'postestumb_zad' => "0",
'postes_sjal' => "80",
'postes_sjal_png' => "0",

'screent_nomer' => "0",
'screent_water' => "",
'prefixs_user_screent' => "",
'prefixs_title_screent' => "",
'screent_razmer' => "0",
'screent_tumb' => "0",
'screenttumb_zad' => "0",
'screent_sjal' => "80",
'screent_sjal_png' => "0",

//������������
'seo_generator' => "",
'seo_generator_dv' => "",
'seo_generator_t' => "",
'seo_generator_tv' => "",
'seo_generator_base' => "ruch",

//�������

'trailer_youtube' => "",
'youtube_api' => "",

'trailer_server_on' => "",
'trailer_home_url' => "",
'trailer_title' => "",
'trailer_year' => "",
'trailer_prefixs' => "",
'trailer_folder' => "",

//������
'torrent' => "",
'torrent_on' => "",
'torrent_del' => "",
'freerutor' => "",
'freerutor_url' => "http://freerutor.org/",
'freerutor_sort' => "0",
'login_freerutor' => "",
'pass_freerutor' => "",
'rutor' => "",
'rutor_url' => "http://rutor.info/",
'rutor_sort' => "0",
'katushka' => "",
'katushka_url' => "https://katushka.org/",
'katushka_sort' => "3",
'login_katushka' => "",
'pass_katushka' => "",
'fast_torrent' => "",
'fast_torrent_url' => "http://fast-torrent.ru/",
'fast_sort' => "4",
'search_limit' => "5",
'tracker_msw' => "",


//������
'actors' => "",

//�����
'video' => "",
'width_iframe' => "610",
'height_iframe' => "370",
'video_hdlight' => "",
'hdlight_api' => "",
'video_http' => "",
'video_stormo' => "",

//���
'alt_tech' => "",

//������ Actors
'psp_actors' => "",
'psp_director' => "",

);

$template_site = array (
'title' => array ("[xfgiven_name][xfvalue_name][/xfgiven_name][xfgiven_name_foreign] / [xfvalue_name_foreign][/xfgiven_name_foreign] [xfgiven_year_title]([xfvalue_year_title])[/xfgiven_year_title] [xfgiven_tracker_quality][xfvalue_tracker_quality][/xfgiven_tracker_quality]", "��������� ������:", "input"),
'short_story' => array ("[xfgiven_poster][center][img][xfvalue_poster][/img][/center][/xfgiven_poster]", "������� ��������:", "textarea"),
'full_story' => array ("[xfgiven_description][b]��������:[/b] [xfvalue_description][/xfgiven_description]", "������ ��������:", "textarea"),
);

$template_site_xf = array (
'xfield[year]' => array ("[xfvalue_year]", "year", "input"), 
'xfield[country]' => array ("[xfvalue_country]", "country", "input"), 
'xfield[actors]' => array ("[xfvalue_actors]", "actors", "input"), 
'xfield[director]' => array ("[xfvalue_director]", "director", "input"), 
'xfield[produser]' => array ("[xfvalue_producer]", "produser", "input"), 
'xfield[rating]' => array ("[xfvalue_rating]", "rating", "input"), 
'xfield[scrinlistx]' => array ("[xfvalue_screen][xfvalue_stills]", "scrinlistx", "input"), 
'xfield[description]' => array ("[xfgiven_description][xfvalue_description][/xfgiven_description]", "description" , "textarea"),
);

$template_pole_svoe = array (

);

$parser_category = array(
'�����' => '',
'������' => '30',
'�����' => '34',
'���������' => '54',
'������' => '15',
'�������' => '52',
'�������' => '20',
'��������' => '21',
'�������' => '',
'��� ��������' => '',
'��������������' => '33',
'���������' => '23',
'�����' => '17',
'����' => '',
'�������' => '27',
'�������' => '14',
'�������' => '47',
'���������������' => '58',
'��������' => '18',
'������' => '',
'����������' => '22',
'������������' => '',
'������' => '57',
'�������' => '',
'�����������' => '24',
'�������� ��' => '31',
'��������' => '25',
'�����' => '26',
'���-���' => '31',
'�������' => '19',
'�����' => '29',
'����������' => '16',
'�����-����' => '',
'�������' => '28',
'2016' => '',
'2015' => '',
'2014' => '',
'2013' => '',
'���' => '',
'��������������' => '',
'��������' => '',
'������' => '',
'������' => '',
'���������' => '',
'������' => '',
'�������' => '',
'������' => '',
'����' => '',
'��������' => '',
'������' => '',
'�����' => '',
'�������' => '',
'���������' => '',
'�������' => '',
'�������' => '',
'�������' => '',
'�������' => '',

);

?>