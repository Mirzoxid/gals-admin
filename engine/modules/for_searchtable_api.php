<?php



/**

 * Module for autorization users with custom module

 * =======================================================

 * Автор:	Mirzohid Ulug'murodov

 * email:	mirzoxid92@mail.ru

 * =======================================================

 * Файл:  for_api.php

 * -------------------------------------------------------

 * Версия: 1.0.0 (08.10.2017)

 * =======================================================

 LAST NEWS

 */



if (!defined('DATALIFEENGINE')) die("Ruxsatsiz xarakat!");


include('engine/api/api.class.php');

	header("Access-Control-Allow-Origin: *");

	header("Content-Type: application/json; charset=UTF-8");

	header("Access-Control-Allow-Methods: POST");

	header("Access-Control-Max-Age: 3600");

	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$auth_log = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$json_arr = array();

	$arr = array();

	$post = json_decode(file_get_contents("php://input"));

	// var_dump($post);die;

	if (isset($post->token) && isset($post->search)) {

        $dle_api->db->query("SET NAMES 'utf8'");
		if (!empty($post->token)) {

			if ($dle_api->load_table(USERPREFIX . "_token", "*", "token = '".$post->token."'")) {

				$search = ($post->search == "") ? "" : "WHERE ". USERPREFIX. "_post.title LIKE '%". $post->search."%'";
				$skip = (empty($post->skip)) ? 0 : intval($post->skip);
				$limit = (empty($post->limit)) ? 10 : intval($post->limit);
				$cnt = ($post->skip >= $count_n->num_rows) ? 0 : $post->post;

				if ($arr = $dle_api->db->query("SELECT DISTINCT dle_post.title, dle_post.id, dle_post.category, dle_post.date,dle_post.short_story FROM dle_post $search order by dle_post.date desc limit $skip,$limit")) {

					$arr1 = null;
					while ($var = $dle_api->db->get_row()) {
						$arr1[] = $var;
					}

					$json_arr = [

						"code" => 1,

						"message" => "Table loaded",

						"max_movies_count" => count($arr1),

						"data" => $arr1

					];

				} else {

					$json_arr = [

						"code" => 0,

						"error" => "Table not loaded! Category, skip or limit undifined!"

					];

				}



			} else {

				$json_arr = [

					"code" => 0,

					"error" => "Wrong token!"

				];

			}

		} else {

			$json_arr = [

				"code" => 0,

				"error" => "Token empty )) !"

			];

		}

	} else {

		$json_arr = [

			"code" => 0,

			"error" => "Key error or other )) !"

		];

	}



	echo json_encode($json_arr);exit();

} else {

	echo json_encode();exit();

}



?>
