<?php
if( !defined( 'DATALIFEENGINE' ) OR !defined( 'LOGGED_IN' ) ) die();

include_once ENGINE_DIR . '/classes/parse.class.php';

$parse = new ParseFilter( Array (), Array (), 1, 1 );

include_once ENGINE_DIR . '/data/collections.php';

Class resize
{
	private $image;
	private $width;
	private $height;
	private $imageResized;
	private $extension;

	function __construct($fileName)
	{
		// Если $fileName начинается с http:// или https:// - открываем ее с Curl
		if (preg_match('~^http(s)?://~', $fileName)) {
			$this->image = $this->openImageWithCurl($fileName);
		} else {
			$this->image = $this->openImage($fileName);
		}

		// *** Get width and height
		$this->width  = imagesx($this->image);
		$this->height = imagesy($this->image);
	}

	private function openImage($file)
	{
		$extension = strtolower(strrchr($file, '.'));
		$this->extension = $extension == '.jpg' ? '.jpeg' : $extension;
		$func = 'imagecreatefrom' . substr($this->extension, 1);
		if(!function_exists($func))
			return false;
		return $func($file);
	}

	private function openImageWithCurl($url)
	{
		$extension = strtolower(strrchr($url, '.'));
		$this->extension = $extension == '.jpg' ? '.jpeg' : $extension;

		$file = $this->curlRequest($url);
		if ($file == '')
			return false;

		return imagecreatefromstring($file);
	}

	private function curlRequest($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20120403211507 Firefox/12.0');
		$contents = curl_exec($ch);
		curl_close($ch);
		return $contents;
	}

	public function resizeImage($newWidth, $newHeight, $option="auto")
	{
		// *** Get optimal width and height - based on $option
		$optionArray = $this->getDimensions($newWidth, $newHeight, $option);

		$optimalWidth  = $optionArray['optimalWidth'];
		$optimalHeight = $optionArray['optimalHeight'];


		// *** Resample - create image canvas of x, y size
		$this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);

		if($this->extension == '.png' || $this->extension == '.gif')
		{
			imagecolortransparent($this->imageResized, imagecolorallocatealpha($this->imageResized, 0, 0, 0, 127));
			imagealphablending($this->imageResized, false);
			imagesavealpha($this->imageResized, true);
		}
		 imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);
		// *** if option is 'crop', then crop too
		if ($option == 'crop') {
			$this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
		}
	}

	private function getDimensions($newWidth, $newHeight, $option)
	{

	   switch ($option)
		{
			case 'exact':
				$optimalWidth = $newWidth;
				$optimalHeight= $newHeight;
				break;
			case 'portrait':
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
				break;
			case 'landscape':
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
				break;
			case 'auto':
				$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
				$optimalWidth = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
			case 'crop':
				$optionArray = $this->getOptimalCrop($newWidth, $newHeight);
				$optimalWidth = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
		}
		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function getSizeByFixedHeight($newHeight)
	{
		$ratio = $this->width / $this->height;
		$newWidth = $newHeight * $ratio;
		return $newWidth;
	}

	private function getSizeByFixedWidth($newWidth)
	{
		$ratio = $this->height / $this->width;
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}

	private function getSizeByAuto($newWidth, $newHeight)
	{
		if ($this->height < $this->width)
		// *** Image to be resized is wider (landscape)
		{
			$optimalWidth = $newWidth;
			$optimalHeight= $this->getSizeByFixedWidth($newWidth);
		}
		elseif ($this->height > $this->width)
		// *** Image to be resized is taller (portrait)
		{
			$optimalWidth = $this->getSizeByFixedHeight($newHeight);
			$optimalHeight= $newHeight;
		}
		else
		// *** Image to be resizerd is a square
		{
			if ($newHeight < $newWidth) {
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
			} else if ($newHeight > $newWidth) {
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
			} else {
				// *** Sqaure being resized to a square
				$optimalWidth = $newWidth;
				$optimalHeight= $newHeight;
			}
		}

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function getOptimalCrop($newWidth, $newHeight)
	{

		$heightRatio = $this->height / $newHeight;
		$widthRatio  = $this->width /  $newWidth;

		if ($heightRatio < $widthRatio) {
			$optimalRatio = $heightRatio;
		} else {
			$optimalRatio = $widthRatio;
		}

		$optimalHeight = $this->height / $optimalRatio;
		$optimalWidth  = $this->width  / $optimalRatio;

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
	{
		// *** Find center - this will be used for the crop
		$cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
		$cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

		$crop = $this->imageResized;
		//imagedestroy($this->imageResized);

		// *** Now crop from center to exact requested size
		$this->imageResized = imagecreatetruecolor($newWidth, $newHeight);

		if($this->extension == '.png' || $this->extension == '.gif')
		{
			imagecolortransparent($this->imageResized, imagecolorallocatealpha($this->imageResized, 0, 0, 0, 127));
			imagealphablending($this->imageResized, false);
			imagesavealpha($this->imageResized, true);
		}
		 imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
	}

	public function saveImage($savePath, $imageQuality="100")
    {
        $save = 'image' . substr($this->extension, 1);
        if(!function_exists($save)) //хотя проверка в принципе не нужна, т.к. уже была при открытии
            return false;
        ($this->extension == '.gif')
                ? $save ($this->imageResized, $savePath)
                : $save (
                     $this->imageResized,
                     $savePath,
                    ($this->extension=='.png' ? (9 - round(($imageQuality/100) * 9)) : $imageQuality)
						// die($savePath);
                );
        imagedestroy($this->imageResized);
    }
}

function SaveImg($file, $alt, $big_wid, $min_wid, $folder, $quality, $crop)
{
	global $config;

	if( !empty( $file ) )
	{
		$DIR_IMG_BIG = ROOT_DIR . '/uploads/' . $folder . '/';
		$DIR_IMG_MIN = ROOT_DIR . '/uploads/' . $folder . '/sm/';
		$DIR_IMG_TMP = ROOT_DIR . '/uploads/' . $folder . '/tamp/';

		if( !is_dir( $DIR_IMG_BIG ) ) mkdir( $DIR_IMG_BIG, 0777 ); chmod($DIR_IMG_BIG, 0777);
		if( !is_dir( $DIR_IMG_MIN ) ) mkdir( $DIR_IMG_MIN, 0777 ); chmod($DIR_IMG_MIN, 0777);
		if( !is_dir( $DIR_IMG_TMP ) ) mkdir( $DIR_IMG_TMP, 0777 ); chmod($DIR_IMG_TMP, 0777);

		move_uploaded_file($file['tmp_name'], $DIR_IMG_TMP . $file['name']);

		$filesys = explode("/", $file['name']);
		$filesys = explode(".", end($filesys));

		$FILE_UP = time() . '_' . $alt . '.' . end( $filesys );
		$CropImg = $config['http_home_url'] . 'uploads/' . $folder . '/tamp/' . $file['name'];

		# Класс для работы с Изображением
		$resizeImg = new resize($CropImg);

		# Кроп большой картинки
		$ExWidBigImg = explode('x', $big_wid);
		if( isset( $ExWidBigImg ) AND $crop )
		{
			$resizeImg->resizeImage($ExWidBigImg[0], $ExWidBigImg[1], 'crop');

			if( $quality )
			{
				$resizeImg->saveImage($DIR_IMG_BIG . $FILE_UP, $quality);
			}
			else
			{
				$resizeImg->saveImage($DIR_IMG_BIG . $FILE_UP, 80);
			}
		}
		else
		{
			copy($DIR_IMG_TMP . $file['name'], $DIR_IMG_BIG . $FILE_UP);
		}

		# Кроп маленькой картинки
		$ExWidMinImg = explode('x', $min_wid);
		if( isset( $ExWidMinImg ) AND $crop )
		{
			$resizeImg->resizeImage($ExWidMinImg[0], $ExWidMinImg[1], 'crop');

			if( $quality )
			{
				$resizeImg->saveImage($DIR_IMG_MIN . $FILE_UP, $quality);
			}
			else
			{
				$resizeImg->saveImage($DIR_IMG_MIN . $FILE_UP, 80);
			}
		}

		unlink($DIR_IMG_TMP . $file['name']);

		return $FILE_UP;
	}
}

function TotsAltName($var, $lower = true, $punkt = true) {
	global $langtranslit;
	
	if ( is_array($var) ) return "";

	$var = str_replace(chr(0), '', $var);

	if (!is_array ( $langtranslit ) OR !count( $langtranslit ) ) {
		$var = trim( strip_tags( $var ) );

		if ( $punkt ) $var = preg_replace( "/[^a-z0-9\_\-.]+/mi", "", $var );
		else $var = preg_replace( "/[^a-z0-9\_\-]+/mi", "", $var );

		$var = preg_replace( '#[.]+#i', '.', $var );
		$var = str_ireplace( ".php", ".ppp", $var );

		if ( $lower ) $var = strtolower( $var );

		return $var;
	}
	
	$var = trim( strip_tags( $var ) );
	$var = preg_replace( "/\s+/ms", "_", $var );
	$var = str_replace( "/", "_", $var );

	$var = strtr($var, $langtranslit);
	
	if ( $punkt ) $var = preg_replace( "/[^a-z0-9\_\-.]+/mi", "", $var );
	else $var = preg_replace( "/[^a-z0-9\_\-]+/mi", "", $var );

	$var = preg_replace( '#[\-]+#i', '_', $var );
	$var = preg_replace( '#[.]+#i', '_', $var );

	if ( $lower ) $var = strtolower( $var );

	$var = str_ireplace( ".php", "", $var );
	$var = str_ireplace( ".php", ".ppp", $var );

	if( strlen( $var ) > 200 ) {
		
		$var = substr( $var, 0, 200 );
		
		if( ($temp_max = strrpos( $var, '-' )) ) $var = substr( $var, 0, $temp_max );
	
	}
	
	return $var;
}

if( $mod == "collections" AND !$action )
{
	echoheader( "<i class=\"icon-file-alt\"></i>Список подборок", "Полный список всех подборок в базе" );

	$list = $db->query("SELECT * FROM ".PREFIX."_collections");

	$ShowNoCollect = true;

	$BODY = "";
	while( $row = $db->get_row( $list ) )
	{
		$ShowNoCollect = false;
		$count = explode(',', $row['nid']);

		$BODY .= "<tr><td class=\"news-list-tab\" style=\"text-align: center\"><a href=\"{$PHP_SELF}?mod=collections&action=edit&id={$row['id']}\">{$row['title']}</a></td>";
		$BODY .= "<td class=\"news-list-tab\" style=\"text-align: center\"><span>".count($count)."</span></td>";
		$BODY .= "<td class=\"news-list-tab\" style=\"text-align: center\"><span>{$row['image']}</span></td>";
		$BODY .= "<td class=\"news-list-tab\" style=\"text-align: center\"><span>{$row['date']}</span></td>";
		$BODY .= "<td class=\"news-list-tab\" style=\"text-align: center\"><span>{$row['autor']}</span></td>";
		$BODY .= "<td class=\"news-list-tab\" style=\"text-align: center\"><button onclick=\"confirmDelete('?mod=collections&amp;action=doedit&amp;ifdelete=yes&amp;id={$row['id']}&amp;user_hash={$dle_login_hash}', '{$row['id']}'); return false;\" class=\"btn btn-red\"><i class=\"icon-trash\"></i> Удалить</button></td></tr>";
	}

	echo "		<script>
	    function confirmDelete(url, id){

			var b = {};

			b[dle_act_lang[1]] = function() {
							$(this).dialog(\"close\");
					    };

			b['{$lang['p_message']}'] = function() {
							$(this).dialog(\"close\");

							var bt = {};

							bt[dle_act_lang[3]] = function() {
											$(this).dialog('close');
									    };

							bt['{$lang['p_send']}'] = function() {
											if ( $('#dle-promt-text').val().length < 1) {
												 $('#dle-promt-text').addClass('ui-state-error');
											} else {
												var response = $('#dle-promt-text').val()
												$(this).dialog('close');
												$('#dlepopup').remove();
												$.post('engine/ajax/message.php', { id: id,  text: response },
												  function(data){
												    if (data == 'ok') { document.location=url; } else { DLEalert('{$lang['p_not_send']}', '{$lang['p_info']}'); }
											  });

											}
										};

							$('#dlepopup').remove();

							$('body').append(\"<div id='dlepopup' title='{$lang['p_title']}' class='dle-promt' style='display:none'>{$lang['p_text']}<br /><br /><textarea name='dle-promt-text' id='dle-promt-text' class='ui-widget-content ui-corner-all' style='width:97%;height:100px; padding: .4em;'></textarea></div>\");

							$('#dlepopup').dialog({
								autoOpen: true,
								width: 500,
								resizable: false,
								buttons: bt
							});

					    };

			b[dle_act_lang[0]] = function() {
							$(this).dialog(\"close\");
							document.location=url;
						};

			$(\"#dlepopup\").remove();

			$(\"body\").append(\"<div id='dlepopup' title='{$lang['p_confirm']}' class='dle-promt' style='display:none'><div id='dlepopupmessage'>{$lang['edit_cdel']}</div></div>\");

			$('#dlepopup').dialog({
				autoOpen: true,
				width: 500,
				resizable: false,
				buttons: b
			});


	    }
		</script>";

	echo <<<HTML
		<div class="box">
			<div class="box-header">
				<div class="title">Список коллекций</div>
			</div>
			<div class="box-content">
				<table class="table table-normal table-hover">
					<thead>
						<tr>
							<td>Название</td>
							<td>Кол-во новостей</td>
							<td>Изображение</td>
							<td>Дата</td>
							<td>Автор</td>
							<td>Действие</td>
						</tr>
					</thead>
					<tbody>{$BODY}</tbody>
				</table>
HTML;
					if( $ShowNoCollect )
					{
						echo "<div style=\"font-size: 12px;padding: 20px;text-align: center;\">В базе нет коллекций.</div>";
					}
	echo <<<HTML
			</div>
			<div class="box-footer padded">
				<div class="pull-left">
					<a href="{$PHP_SELF}?mod=collections&action=setting" class="btn btn-green">Настройки</a>
				</div>
				<div class="pull-right">
					<a href="{$PHP_SELF}?mod=collections&action=add" class="btn btn-gold">Добавить</a>
				</div>
			</div>
		</div>
HTML;

	echofooter();
}

if( $action == 'setting' )
{
	echoheader( "<i class=\"icon-file-alt\"></i>Список подборок", "Настройки модуля" );

	function showRow($title = "", $description = "", $field = "", $class = "") {
		echo "<tr>
        <td class=\"col-xs-10 col-sm-6 col-md-7 {$class}\"><h6>{$title}</h6><span class=\"note large\">{$description}</span></td>
        <td class=\"col-xs-2 col-md-5 settingstd {$class}\">{$field}</td>
        </tr>";
	}

	echo <<<HTML
		<div class="box">
			<div class="box-header">
				<div class="title">Настройки модуля</div>
			</div>
			<form method="post">
				<div class="box-content">
					<table class="table table-normal">
HTML;
					if( $collect['sm_image_on'] ) $sm_imgon = 'checked';
					else $sm_imgon = '';

					showRow( 'Мета тег Title', 'Введите название странице которое будет видно в title', "<input type=text style=\"width:100%;\" name=\"save[title]\" value=\"{$collect['title']}\">", "white-line" );
					showRow( 'Мета тег Description', 'Введите название странице которое будет видно в title', "<input type=text style=\"width:100%;\" name=\"save[descr]\" value=\"{$collect['descr']}\">" );
					showRow( 'Мета тег Keywords', 'Введите название странице которое будет видно в title', "<input type=text style=\"width:100%;\" name=\"save[keywd]\" value=\"{$collect['keywd']}\">", "white-line" );
					showRow( 'Количество коллекций на страницу', 'Задаём лими для вывода коллекций на странице /collections/', "<input type=text style=\"width:100%;\" name=\"save[count_coll]\" value=\"{$collect['count_coll']}\">" );
					showRow( 'Количество новостей на страницу коллекций', 'Задаём лими для вывода коллекций на странице /collections/коллекция/', "<input type=text style=\"width:100%;\" name=\"save[count_news]\" value=\"{$collect['count_news']}\">", "white-line" );
					showRow( 'Размер изображения (Большое)', 'При загрузке будет резаться изображение, под выбранный формат, если оставить пустым будет закачиваться без форматирования.', "<input type=text style=\"width:100%;\" name=\"save[image]\" value=\"{$collect['image']}\">", "white-line" );
					showRow( 'Размер изображения (Миниатюра)', 'Если включен режим миниатюр, то будет создаваться маленькая картинка.', "<input type=text style=\"width:100%;\" name=\"save[sm_image]\" value=\"{$collect['sm_image']}\">", "white-line" );
					showRow( 'Включить ресайз миниатюр.', 'Если функция включена, будет создаваться уменьшенная копия картинки.', "<input class=\"iButton-icons-tab\" type=\"checkbox\" name=\"save[sm_image_on]\" value=\"1\" {$sm_imgon}>", "white-line" );
					showRow( 'Папка для загрузки изображений.', 'Укажите название папки в <b>/uploads/название папки</b> для загрузки изображений коллекций.', "<input style=\"width:100%;\" type=\"text\" name=\"save[folder_up]\" value=\"{$collect['folder_up']}\">", "white-line" );
	echo <<<HTML
					</table>
				</div>
				<div class="box-footer padded">
					<div class="pull-left">
						<input type="submit" class="btn btn-lg btn-green" class="btn btn-green" value="Сохранить">
					</div>
					<div class="pull-right">
						<a href="{$PHP_SELF}?mod=collections" class="btn btn-red">Назад</a>
					</div>
				</div>
				<input type="hidden" name="mod" value="collections">
				<input type="hidden" name="action" value="dosetting">
				<input type="hidden" name="user_hash" value="{$dle_login_hash}">
			</form>
		</div>
HTML;

	echofooter();
}
elseif( $action == 'dosetting' )
{
	$save = $_POST['save'];
	$save['count_coll'] = intval( $save['count_coll'] );
	$save['count_news'] = intval( $save['count_news'] );
	$save['sm_image_on'] = intval( $save['sm_image_on'] );

	$save = $save + $collect;

	$handler = fopen( ENGINE_DIR . '/data/collections.php', "w" );

	fwrite( $handler, "<?PHP \n\n//System Configurations\n\n\$collect = array (\n\n" );
	foreach($save as $name => $value)
	{
		fwrite( $handler, "'{$name}' => '{$value}',\n\n" );
	}

	fwrite( $handler, ");\n\n?>" );
	fclose( $handler );

	msg("info", $lang['opt_sysok'], $lang['opt_sysok_1'], "?mod=collections");
}

if( $action == 'edit' )
{
	$id = $_GET['id'];

	$row = $db->super_query("SELECT * FROM ".PREFIX."_collections WHERE id = '{$id}'");

	$row['title'] = $parse->decodeBBCodes( $row['title'], false );
	$row['title'] = str_replace("&amp;","&", $row['title'] );
	$row['descr'] = $parse->decodeBBCodes( $row['descr'], false );
	$row['keywd'] = $parse->decodeBBCodes( $row['keywd'], false );

	$row['mtitle'] = stripslashes( $row['mtitle'] );

	$row['text'] = $parse->decodeBBCodes( $row['text'], true, false );

	echoheader( "<i class=\"icon-file-alt\"></i>Редактирование коллекции", "Изменение данных подборки" );

	if( $row['follow'] )
	{
		$ifrat = 'checked';
	}
	else
	{
		$ifrat = '';
	}

	echo "		<script>
	    function confirmDelete(url, id){

			var b = {};

			b[dle_act_lang[1]] = function() {
							$(this).dialog(\"close\");
					    };

			b['{$lang['p_message']}'] = function() {
							$(this).dialog(\"close\");

							var bt = {};

							bt[dle_act_lang[3]] = function() {
											$(this).dialog('close');
									    };

							bt['{$lang['p_send']}'] = function() {
											if ( $('#dle-promt-text').val().length < 1) {
												 $('#dle-promt-text').addClass('ui-state-error');
											} else {
												var response = $('#dle-promt-text').val()
												$(this).dialog('close');
												$('#dlepopup').remove();
												$.post('engine/ajax/message.php', { id: id,  text: response },
												  function(data){
												    if (data == 'ok') { document.location=url; } else { DLEalert('{$lang['p_not_send']}', '{$lang['p_info']}'); }
											  });

											}
										};

							$('#dlepopup').remove();

							$('body').append(\"<div id='dlepopup' title='{$lang['p_title']}' class='dle-promt' style='display:none'>{$lang['p_text']}<br /><br /><textarea name='dle-promt-text' id='dle-promt-text' class='ui-widget-content ui-corner-all' style='width:97%;height:100px; padding: .4em;'></textarea></div>\");

							$('#dlepopup').dialog({
								autoOpen: true,
								width: 500,
								resizable: false,
								buttons: bt
							});

					    };

			b[dle_act_lang[0]] = function() {
							$(this).dialog(\"close\");
							document.location=url;
						};

			$(\"#dlepopup\").remove();

			$(\"body\").append(\"<div id='dlepopup' title='{$lang['p_confirm']}' class='dle-promt' style='display:none'><div id='dlepopupmessage'>{$lang['edit_cdel']}</div></div>\");

			$('#dlepopup').dialog({
				autoOpen: true,
				width: 500,
				resizable: false,
				buttons: b
			});


	    }
    function CheckStatus(Form){
		if(Form.allow_date.checked) {
		Form.allow_now.disabled = true;
		Form.allow_now.checked = false;
		} else {
		Form.allow_now.disabled = false;
		}
    }
		</script>";

		$news_arrays = explode(',', $row['nid']);
		foreach( $news_arrays as $id )
		{
			if( $id )
			{
				$a_mass = $db->super_query("SELECT id, title FROM ".PREFIX."_post WHERE id = '{$id}'");
				$a_mass['title'] = mb_convert_encoding($a_mass['title'], "utf-8", "cp1251");
				$news_array[] = array
				(
					'id' => $a_mass['id'],
					'title' => $a_mass['title']
				);
			}
		}
		$news_array = json_encode( $news_array );

	echo <<<HTML
		<script type="text/javascript">!function(t){function e(t){return String(null===t||void 0===t?"":t)}function n(t){return e(t).replace(l,function(t){return d[t]})}var s={method:"GET",queryParam:"q",searchDelay:null,minChars:1,propertyToSearch:"title",jsonContainer:null,contentType:"json",prePopulate:null,processPrePopulate:!1,hintText:"Type in a search term",noResultsText:"Нет результатов",searchingText:"Поиск...",deleteText:"&times;",animateDropdown:!0,theme:"facebook",zindex:999,resultsLimit:null,enableHTML:!1,resultsFormatter:function(t){var e=t[this.propertyToSearch];return"<li>"+(this.enableHTML?e:n(e))+"</li>"},tokenFormatter:function(t){var e=t[this.propertyToSearch];return"<li><p>"+(this.enableHTML?e:n(e))+"</p></li>"},tokenLimit:null,tokenDelimiter:",",preventDuplicates:!1,tokenValue:"id",allowFreeTagging:!1,onResult:null,onCachedResult:null,onAdd:null,onFreeTaggingAdd:null,onDelete:null,onReady:null,idPrefix:"token-input-",disabled:!1},a={tokenList:"token-input-list",token:"token-input-token",tokenReadOnly:"token-input-token-readonly",tokenDelete:"token-input-delete-token",selectedToken:"token-input-selected-token",highlightedToken:"token-input-highlighted-token",dropdown:"token-input-dropdown",dropdownItem:"token-input-dropdown-item",dropdownItem2:"token-input-dropdown-item2",selectedDropdownItem:"token-input-selected-dropdown-item",inputToken:"token-input-input-token",focused:"token-input-focused",disabled:"token-input-disabled"},i={BEFORE:0,AFTER:1,END:2},o={BACKSPACE:8,TAB:9,ENTER:13,ESCAPE:27,SPACE:32,PAGE_UP:33,PAGE_DOWN:34,END:35,HOME:36,LEFT:37,UP:38,RIGHT:39,DOWN:40,NUMPAD_ENTER:108},d={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","/":"&#x2F;"},l=/[&<>"'\/]/g,r={init:function(e,n){var a=t.extend({},s,n||{});return this.each(function(){t(this).data("settings",a),t(this).data("tokenInputObject",new t.TokenList(this,e,a))})},clear:function(){return this.data("tokenInputObject").clear(),this},add:function(t){return this.data("tokenInputObject").add(t),this},remove:function(t){return this.data("tokenInputObject").remove(t),this},get:function(){return this.data("tokenInputObject").getTokens()},toggleDisabled:function(t){return this.data("tokenInputObject").toggleDisabled(t),this},setOptions:function(e){return t(this).data("settings",t.extend({},t(this).data("settings"),e||{})),this}};t.fn.tokenInput=function(t){return r[t]?r[t].apply(this,Array.prototype.slice.call(arguments,1)):r.init.apply(this,arguments)},t.TokenList=function(e,s){function d(s){return t(e).data("settings").enableHTML?s:n(s)}function l(n){"boolean"==typeof n?t(e).data("settings").disabled=n:t(e).data("settings").disabled=!t(e).data("settings").disabled,H.attr("disabled",t(e).data("settings").disabled),W.toggleClass(t(e).data("settings").classes.disabled,t(e).data("settings").disabled),z&&f(t(z),i.END),_.attr("disabled",t(e).data("settings").disabled)}function r(){return null!==t(e).data("settings").tokenLimit&&M>=t(e).data("settings").tokenLimit?(H.hide(),void T()):void 0}function u(){j!==(j=H.val())&&(K.html(n(j)),H.width(K.width()+30))}function c(){var n=t.trim(H.val()),s=n.split(t(e).data("settings").tokenDelimiter);t.each(s,function(n,s){if(s){t.isFunction(t(e).data("settings").onFreeTaggingAdd)&&(s=t(e).data("settings").onFreeTaggingAdd.call(_,s));var a={};a[t(e).data("settings").tokenValue]=a[t(e).data("settings").propertyToSearch]=s,p(a)}})}function g(n){var s=t(t(e).data("settings").tokenFormatter(n)),a=n.readonly===!0;a&&s.addClass(t(e).data("settings").classes.tokenReadOnly),s.addClass(t(e).data("settings").classes.token).insertBefore(V),a||t("<span>"+t(e).data("settings").deleteText+"</span>").addClass(t(e).data("settings").classes.tokenDelete).appendTo(s).click(function(){return t(e).data("settings").disabled?void 0:(m(t(this).parent()),_.change(),!1)});var i=n;return t.data(s.get(0),"tokeninput",n),N=N.slice(0,G).concat([i]).concat(N.slice(G)),G++,v(N,_),M+=1,null!==t(e).data("settings").tokenLimit&&M>=t(e).data("settings").tokenLimit&&(H.hide(),T()),s}function p(n){var s=t(e).data("settings").onAdd;if(M>0&&t(e).data("settings").preventDuplicates){var a=null;if(W.children().each(function(){var e=t(this),s=t.data(e.get(0),"tokeninput");return s&&s.id===n.id?(a=e,!1):void 0}),a)return h(a),V.insertAfter(a),void O(H)}(null==t(e).data("settings").tokenLimit||M<t(e).data("settings").tokenLimit)&&(g(n),r()),H.val(""),T(),t.isFunction(s)&&s.call(_,n)}function h(n){t(e).data("settings").disabled||(n.addClass(t(e).data("settings").classes.selectedToken),z=n.get(0),H.val(""),T())}function f(n,s){n.removeClass(t(e).data("settings").classes.selectedToken),z=null,s===i.BEFORE?(V.insertBefore(n),G--):s===i.AFTER?(V.insertAfter(n),G++):(V.appendTo(W),G=M),O(H)}function k(e){var n=z;z&&f(t(z),i.END),n===e.get(0)?f(e,i.END):h(e)}function m(n){var s=t.data(n.get(0),"tokeninput"),a=t(e).data("settings").onDelete,i=n.prevAll().length;i>G&&i--,n.remove(),z=null,O(H),N=N.slice(0,i).concat(N.slice(i+1)),G>i&&G--,v(N,_),M-=1,null!==t(e).data("settings").tokenLimit&&(H.show().val(""),O(H)),t.isFunction(a)&&a.call(_,s)}function v(n,s){var a=t.map(n,function(n){return"function"==typeof t(e).data("settings").tokenValue?t(e).data("settings").tokenValue.call(this,n):n[t(e).data("settings").tokenValue]});s.val(a.join(t(e).data("settings").tokenDelimiter))}function T(){q.hide().empty(),U=null}function y(){q.css({position:"absolute",top:t(W).offset().top+t(W).outerHeight(),left:t(W).offset().left,width:t(W).width(),"z-index":t(e).data("settings").zindex}).show()}function C(){t(e).data("settings").searchingText&&(q.html("<p>"+d(t(e).data("settings").searchingText)+"</p>"),y())}function b(){t(e).data("settings").hintText&&(q.html("<p>"+d(t(e).data("settings").hintText)+"</p>"),y())}function E(t){return t.replace(Q,"\\$&")}function w(t,e){return t.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)("+E(e)+")(?![^<>]*>)(?![^&;]+;)","gi"),function(t,e){return"<b>"+d(e)+"</b>"})}function D(t,e,n){return t.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)("+E(e)+")(?![^<>]*>)(?![^&;]+;)","g"),w(e,n))}function R(n,s){if(s&&s.length){q.empty();var a=t("<ul>").appendTo(q).mouseover(function(e){x(t(e.target).closest("li"))}).mousedown(function(e){return p(t(e.target).closest("li").data("tokeninput")),_.change(),!1}).hide();t(e).data("settings").resultsLimit&&s.length>t(e).data("settings").resultsLimit&&(s=s.slice(0,t(e).data("settings").resultsLimit)),t.each(s,function(s,i){var o=t(e).data("settings").resultsFormatter(i);o=D(o,i[t(e).data("settings").propertyToSearch],n),o=t(o).appendTo(a),s%2?o.addClass(t(e).data("settings").classes.dropdownItem):o.addClass(t(e).data("settings").classes.dropdownItem2),0===s&&x(o),t.data(o.get(0),"tokeninput",i)}),y(),t(e).data("settings").animateDropdown?a.slideDown("fast"):a.show()}else t(e).data("settings").noResultsText&&(q.html("<p>"+d(t(e).data("settings").noResultsText)+"</p>"),y())}function x(n){n&&(U&&F(t(U)),n.addClass(t(e).data("settings").classes.selectedDropdownItem),U=n.get(0))}function F(n){n.removeClass(t(e).data("settings").classes.selectedDropdownItem),U=null}function L(){var n=H.val();n&&n.length&&(z&&f(t(z),i.AFTER),n.length>=t(e).data("settings").minChars?(C(),clearTimeout(S),S=setTimeout(function(){A(n)},t(e).data("settings").searchDelay)):T())}function A(n){var s=n+P(),a=B.get(s);if(a)t.isFunction(t(e).data("settings").onCachedResult)&&(a=t(e).data("settings").onCachedResult.call(_,a)),R(n,a);else if(t(e).data("settings").url){var i=P(),o={};if(o.data={},i.indexOf("?")>-1){var d=i.split("?");o.url=d[0];var l=d[1].split("&");t.each(l,function(t,e){var n=e.split("=");o.data[n[0]]=n[1]})}else o.url=i;o.data[t(e).data("settings").queryParam]=n,o.type=t(e).data("settings").method,o.dataType=t(e).data("settings").contentType,t(e).data("settings").crossDomain&&(o.dataType="jsonp"),o.success=function(a){B.add(s,t(e).data("settings").jsonContainer?a[t(e).data("settings").jsonContainer]:a),t.isFunction(t(e).data("settings").onResult)&&(a=t(e).data("settings").onResult.call(_,a)),H.val()===n&&R(n,t(e).data("settings").jsonContainer?a[t(e).data("settings").jsonContainer]:a)},t.ajax(o)}else if(t(e).data("settings").local_data){var r=t.grep(t(e).data("settings").local_data,function(s){return s[t(e).data("settings").propertyToSearch].toLowerCase().indexOf(n.toLowerCase())>-1});B.add(s,r),t.isFunction(t(e).data("settings").onResult)&&(r=t(e).data("settings").onResult.call(_,r)),R(n,r)}}function P(){var n=t(e).data("settings").url;return"function"==typeof t(e).data("settings").url&&(n=t(e).data("settings").url.call(t(e).data("settings"))),n}function O(t){setTimeout(function(){t.focus()},50)}if("string"===t.type(s)||"function"===t.type(s)){t(e).data("settings").url=s;var I=P();void 0===t(e).data("settings").crossDomain&&"string"==typeof I&&(-1===I.indexOf("://")?t(e).data("settings").crossDomain=!1:t(e).data("settings").crossDomain=location.href.split(/\/+/g)[1]!==I.split(/\/+/g)[1])}else"object"==typeof s&&(t(e).data("settings").local_data=s);t(e).data("settings").classes?t(e).data("settings").classes=t.extend({},a,t(e).data("settings").classes):t(e).data("settings").theme?(t(e).data("settings").classes={},t.each(a,function(n,s){t(e).data("settings").classes[n]=s+"-"+t(e).data("settings").theme})):t(e).data("settings").classes=a;var S,j,N=[],M=0,B=new t.TokenList.Cache,H=t('<input type="text"  autocomplete="off">').css({outline:"none"}).attr("id",t(e).data("settings").idPrefix+e.id).focus(function(){return t(e).data("settings").disabled?!1:(null!==t(e).data("settings").tokenLimit&&t(e).data("settings").tokenLimit===M||b(),void W.addClass(t(e).data("settings").classes.focused))}).blur(function(){T(),t(this).val(""),W.removeClass(t(e).data("settings").classes.focused),t(e).data("settings").allowFreeTagging?c():t(this).val(""),W.removeClass(t(e).data("settings").classes.focused)}).bind("keyup keydown blur update",u).keydown(function(n){var s,a;switch(n.keyCode){case o.LEFT:case o.RIGHT:case o.UP:case o.DOWN:if(t(this).val()){var d=null;d=n.keyCode===o.DOWN||n.keyCode===o.RIGHT?t(U).next():t(U).prev(),d.length&&x(d)}else s=V.prev(),a=V.next(),s.length&&s.get(0)===z||a.length&&a.get(0)===z?n.keyCode===o.LEFT||n.keyCode===o.UP?f(t(z),i.BEFORE):f(t(z),i.AFTER):n.keyCode!==o.LEFT&&n.keyCode!==o.UP||!s.length?n.keyCode!==o.RIGHT&&n.keyCode!==o.DOWN||!a.length||h(t(a.get(0))):h(t(s.get(0)));return!1;case o.BACKSPACE:if(s=V.prev(),!t(this).val().length)return z?(m(t(z)),_.change()):s.length&&h(t(s.get(0))),!1;1===t(this).val().length?T():setTimeout(function(){L()},5);break;case o.TAB:case o.ENTER:case o.NUMPAD_ENTER:case o.COMMA:return U?(p(t(U).data("tokeninput")),_.change()):(t(e).data("settings").allowFreeTagging?c():t(this).val(""),n.stopPropagation(),n.preventDefault()),!1;case o.ESCAPE:return T(),!0;default:String.fromCharCode(n.which)&&setTimeout(function(){L()},5)}}),_=t(e).hide().val("").focus(function(){O(H)}).blur(function(){H.blur()}),z=null,G=0,U=null,W=t("<ul />").addClass(t(e).data("settings").classes.tokenList).click(function(e){var n=t(e.target).closest("li");n&&n.get(0)&&t.data(n.get(0),"tokeninput")?k(n):(z&&f(t(z),i.END),O(H))}).mouseover(function(n){var s=t(n.target).closest("li");s&&z!==this&&s.addClass(t(e).data("settings").classes.highlightedToken)}).mouseout(function(n){var s=t(n.target).closest("li");s&&z!==this&&s.removeClass(t(e).data("settings").classes.highlightedToken)}).insertBefore(_),V=t("<li />").addClass(t(e).data("settings").classes.inputToken).appendTo(W).append(H),q=t("<div>").addClass(t(e).data("settings").classes.dropdown).appendTo("body").hide(),K=t("<tester/>").insertAfter(H).css({position:"absolute",top:-9999,left:-9999,width:"auto",fontSize:H.css("fontSize"),fontFamily:H.css("fontFamily"),fontWeight:H.css("fontWeight"),letterSpacing:H.css("letterSpacing"),whiteSpace:"nowrap"});_.val("");var $=t(e).data("settings").prePopulate||_.data("pre");t(e).data("settings").processPrePopulate&&t.isFunction(t(e).data("settings").onResult)&&($=t(e).data("settings").onResult.call(_,$)),$&&$.length&&t.each($,function(t,e){g(e),r()}),t(e).data("settings").disabled&&l(!0),t.isFunction(t(e).data("settings").onReady)&&t(e).data("settings").onReady.call(),this.clear=function(){W.children("li").each(function(){0===t(this).children("input").length&&m(t(this))})},this.add=function(t){p(t)},this.remove=function(e){W.children("li").each(function(){if(0===t(this).children("input").length){var n=t(this).data("tokeninput"),s=!0;for(var a in e)if(e[a]!==n[a]){s=!1;break}s&&m(t(this))}})},this.getTokens=function(){return N},this.toggleDisabled=function(t){l(t)};var Q=new RegExp("[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\-]","g")},t.TokenList.Cache=function(e){var n=t.extend({max_size:500},e),s={},a=0,i=function(){s={},a=0};this.add=function(t,e){a>n.max_size&&i(),s[t]||(a+=1),s[t]=e},this.get=function(t){return s[t]}}}(jQuery);</script>
		<style>@charset "UTF-8";ul.token-input-list-facebook{overflow:hidden;height:auto!important;width:437px;cursor:text;font-family:Verdana;min-height:1px;z-index:999;margin:0;list-style-type:none;clear:left;float:left;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;-webkit-border-radius:0;-moz-border-radius:0;-ms-border-radius:0;-o-border-radius:0;border-radius:0;font-size:12px;color:#333;padding:0 0 0 5px;border:1px solid #d7d7d7;display:inline-block;background:#fdfdfd}ul.token-input-list-facebook li input{border:0;width:100px;margin:2px 0;padding:3px 8px;box-shadow:none;background-color:#fdfdfd;-webkit-appearance:caret}li.token-input-token-facebook{overflow:hidden;height:auto!important;margin:4px 5px 4px 0;padding:4px 5px;background-color:#eff2f7;color:#000;cursor:default;border:1px solid #ccd5e4;font-size:11px;float:left;white-space:nowrap}li.token-input-token-facebook p{display:inline;padding:0;margin:0}li.token-input-token-facebook span{color:#a6b3cf;margin-left:5px;font-weight:700;cursor:pointer}li.token-input-selected-token-facebook{background-color:#5670a6;border:1px solid #3b5998;color:#fff}li.token-input-input-token-facebook{float:left;margin:0;padding:0;list-style-type:none}div.token-input-dropdown-facebook{position:absolute;width:400px;background-color:#fff;overflow:hidden;border-left:1px solid #ccc;border-right:1px solid #ccc;border-bottom:1px solid #ccc;cursor:default;font-size:11px;font-family:Verdana;z-index:1}div.token-input-dropdown-facebook p{margin:0;padding:5px;font-weight:700;color:#777}div.token-input-dropdown-facebook ul{margin:0;padding:0}div.token-input-dropdown-facebook ul li{background-color:#fff;padding:3px;margin:0;list-style-type:none}div.token-input-dropdown-facebook ul li.token-input-dropdown-item-facebook,div.token-input-dropdown-facebook ul li.token-input-dropdown-item2-facebook{background-color:#fff}div.token-input-dropdown-facebook ul li em{font-weight:700;font-style:normal}div.token-input-dropdown-facebook ul li.token-input-selected-dropdown-item-facebook{background-color:#3b5998;color:#fff}</style>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#snid").tokenInput("/engine/ajax/search_news_collect.php", {
            	prePopulate: $news_array,
            });
        });
        </script>
		<div class="box">
			<div class="box-content">
				<form id="addnews" method="post" enctype="multipart/form-data" class="form-horizontal" name="add" action="">
					<div class="row box-section">
						<div class="form-group">
							<label class="control-label col-md-2">Имя коллекции</label>
							<div class="col-md-10">
								<input type="text" style="width:99%;max-width:437px;" name="title" id="title" value="{$row['title']}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">{$lang['edit_edate']}</label>
							<div class="col-md-10">
								<input type="text" name="newdate" data-rel="calendar" size="20" value="{$row['date']}">&nbsp;<input class="checkbox-inline" type="checkbox" name="allow_date" id="allow_date" value="yes" onclick="CheckStatus(addnews)" checked><label for="allow_date">&nbsp;{$lang['edit_ndate']}</label>&nbsp;<input class="checkbox-inline" type="checkbox" name="allow_now" id="allow_now" value="yes" disabled>&nbsp;<label for="allow_now">{$lang['edit_jdate']}</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Новости коллекции</label>
							<div class="col-md-10">
								<input type="text" style="width:99%;max-width:437px;" name="snid" id="snid" value="" placeholder="Поиск новостей">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Изображение</label>
							<div class="col-md-10">
								<input type="file" name="file" style="width:99%;max-width:437px;" id="file" value="Выбрать картинку">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Удалить картинку?</label>
							<div class="col-md-10">
								<input class="icheck" type="checkbox" id="allow_rating" name="img_remove" value="1">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Описание коллекции</label>
							<div class="col-md-10">
HTML;
		$bb_editor = true;
		include (ENGINE_DIR . '/inc/include/inserttag.php');
	echo <<<HTML
								{$bb_code}<textarea style="width:100%;max-width:950px;height:300px;" onfocus="setFieldName(this.name)" name="text" id="text">{$row['text']}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Альтернативное имя</label>
							<div class="col-md-10">
								<input type="text" name="alt_name" style="width:99%;max-width:437px;" id="alt_name" value="{$row['alt_name']}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Мета тег H1</label>
							<div class="col-md-10">
								<input type="text" name="metah1" style="width:99%;max-width:437px;" id="metah1" value="{$row['meta_h1']}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Мета тег Title</label>
							<div class="col-md-10">
								<input type="text" name="meta_title" style="width:99%;max-width:437px;" id="meta_title" value="{$row['mtitle']}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Мета тег Description</label>
							<div class="col-md-10">
								<input type="text" name="meta_descr" style="width:99%;max-width:437px;" id="meta_descr" value="{$row['descr']}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Мета тег Keywords</label>
							<div class="col-md-10">
								<textarea class="tags" name="meta_keywd" id='meta_keywd' style="width:437px;">{$row['keywd']}</textarea><br /><br />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Включить индлексацию</label>
							<div class="col-md-10">
								<input class="icheck" type="checkbox" id="allow_rating" name="index" value="1" {$ifrat}>
							</div>
						</div>
					</div>
					<div class="padded">
						<input type="submit" class="btn btn-green" value="{$lang['news_save']}">&nbsp;
						<button onclick="confirmDelete('?mod=collections&action=doedit&ifdelete=yes&id={$row['id']}&user_hash=$dle_login_hash', "{$row['id']}"); return false;" class="btn btn-red"><i class="icon-trash"></i> {$lang['edit_dnews']}</button>
					    <input type="hidden" name="id" value="$id" />
					    <input type="hidden" name="user_hash" value="$dle_login_hash" />
					    <input type="hidden" name="action" value="doedit" />
					    <input type="hidden" name="mod" value="collections" />
					    <input type="hidden" name="images" value="{$row['image']}"/>
					</div>
				</form>
			</div>
		</div>
HTML;

	echofooter();
}
elseif( $action == 'doedit' )
{
	if( $_GET['ifdelete'] == 'yes' )
	{
		$id = intval( $_GET['id'] );
		$a_mass = $db->super_query("SELECT id, title, image FROM ".PREFIX."_collections WHERE id = '{$id}'");
		$db->query("DELETE FROM " . PREFIX . "_collections WHERE id='{$id}'");

		@unlink(ROOT_DIR . '/uploads/' . $collect['folder_up'] . '/' . $a_mass['image']);
		@unlink(ROOT_DIR . '/uploads/' . $collect['folder_up'] . '/sm/' . $a_mass['image']);

		msg("info", $lang['edit_delok'], 'Данная коллекция была успешна удалена!', "?mod=collections");
	}
	else
	{
		$id = intval( $_GET['id'] );
		$title = $db->safesql( $_POST['title'] );
		$metah1 = $db->safesql( $_POST['metah1'] );
		$mtitle = $db->safesql($_POST['meta_title']);
		$descr = $db->safesql( $_POST['meta_descr'] );
		$keywd = $db->safesql( $_POST['meta_keywd'] );
		$text = $db->safesql( $_POST['text'] );
		$snid = $db->safesql( $_POST['snid'] );
		$indexd = intval( $_POST['index'] );

		if( trim( $title ) == "" and $ifdelete != "yes" ) msg( "error", $lang['cat_error'], $lang['addnews_alert'], "javascript:history.go(-1)" );

		if( trim( $_POST['alt_name'] ) == "" or ! $_POST['alt_name'] ) $alt_name = TotsAltName( stripslashes( $title ) );
		else $alt_name = TotsAltName( stripslashes( $_POST['alt_name'] ) );

		if( $_POST['img_remove'] )
		{
			@unlink(ROOT_DIR . '/uploads/' . $collect['folder_up'] . '/' . $_POST['images']);
			@unlink(ROOT_DIR . '/uploads/' . $collect['folder_up'] . '/sm/' . $_POST['images']);
			$_POST['images'] = '';
		}

		# Загрузка изображений
		if( $_FILES['file']['tmp_name'] )
		{
			$image = SaveImg($_FILES['file'], $alt_name, $collect['image'], $collect['sm_image'], $collect['folder_up'], $collect['quality_img'], $collect['sm_image_on']);
		}
		else
		{
			$image = $_POST['images'];
		}

		// Обработка даты и времени
		$added_time = time();
		$newdate = $_POST['newdate'];

		if( $_POST['allow_date'] != "yes" )
		{
			if( $_POST['allow_now'] == "yes" ) $thistime = date( "Y-m-d H:i:s", $added_time );
			elseif( (($newsdate = strtotime( $newdate )) === - 1) OR !$newsdate ) {
				msg( "error", $lang['cat_error'], $lang['addnews_erdate'], "javascript:history.go(-1)" );
			} else {

				$thistime = date( "Y-m-d H:i:s", $newsdate );

				if( ! intval( $config['no_date'] ) and $newsdate > $added_time ) {
					$thistime = date( "Y-m-d H:i:s", $added_time );
				}

			}
			
			$db->query("UPDATE ".PREFIX."_collections SET date='$thistime', meta_h1 = '{$metah1}', alt_name = '{$alt_name}', nid = '{$snid}', title = '{$title}', mtitle = '{$mtitle}', descr = '{$descr}', keywd = '{$keywd}', text = '{$text}', follow = '{$indexd}', image = '{$image}' WHERE id = '{$id}'");
		}
		else
		{
			$db->query("UPDATE ".PREFIX."_collections SET meta_h1 = '{$metah1}', alt_name = '{$alt_name}', nid = '{$snid}', title = '{$title}', mtitle = '{$mtitle}', descr = '{$descr}', keywd = '{$keywd}', text = '{$text}', follow = '{$indexd}', image = '{$image}' WHERE id = '{$id}'");
		}

		msg("info", $lang['edit_alleok'], $lang['edit_alleok_1'], "?mod=collections");
	}
}

if( $action == 'add' )
{
	echoheader( "<i class=\"icon-file-alt\"></i>Редактирование коллекции", "Изменение данных подборки" );

	if( $member_id['user_group'] == 1 )
	{
		$author_info = "<span class=\"newauthor\">,&nbsp;{$lang['edit_eau']}&nbsp;<input type=\"text\" name=\"new_author\" size=\"20\"  value=\"{$member_id['name']}\"></span>";
	}
	else
	{
		$author_info = "";
	}

	echo <<<HTML
		<script type="text/javascript">!function(t){function e(t){return String(null===t||void 0===t?"":t)}function n(t){return e(t).replace(l,function(t){return d[t]})}var s={method:"GET",queryParam:"q",searchDelay:null,minChars:1,propertyToSearch:"title",jsonContainer:null,contentType:"json",prePopulate:null,processPrePopulate:!1,hintText:"Type in a search term",noResultsText:"Нет результатов",searchingText:"Поиск...",deleteText:"&times;",animateDropdown:!0,theme:"facebook",zindex:999,resultsLimit:null,enableHTML:!1,resultsFormatter:function(t){var e=t[this.propertyToSearch];return"<li>"+(this.enableHTML?e:n(e))+"</li>"},tokenFormatter:function(t){var e=t[this.propertyToSearch];return"<li><p>"+(this.enableHTML?e:n(e))+"</p></li>"},tokenLimit:null,tokenDelimiter:",",preventDuplicates:!1,tokenValue:"id",allowFreeTagging:!1,onResult:null,onCachedResult:null,onAdd:null,onFreeTaggingAdd:null,onDelete:null,onReady:null,idPrefix:"token-input-",disabled:!1},a={tokenList:"token-input-list",token:"token-input-token",tokenReadOnly:"token-input-token-readonly",tokenDelete:"token-input-delete-token",selectedToken:"token-input-selected-token",highlightedToken:"token-input-highlighted-token",dropdown:"token-input-dropdown",dropdownItem:"token-input-dropdown-item",dropdownItem2:"token-input-dropdown-item2",selectedDropdownItem:"token-input-selected-dropdown-item",inputToken:"token-input-input-token",focused:"token-input-focused",disabled:"token-input-disabled"},i={BEFORE:0,AFTER:1,END:2},o={BACKSPACE:8,TAB:9,ENTER:13,ESCAPE:27,SPACE:32,PAGE_UP:33,PAGE_DOWN:34,END:35,HOME:36,LEFT:37,UP:38,RIGHT:39,DOWN:40,NUMPAD_ENTER:108,COMMA:188},d={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","/":"&#x2F;"},l=/[&<>"'\/]/g,r={init:function(e,n){var a=t.extend({},s,n||{});return this.each(function(){t(this).data("settings",a),t(this).data("tokenInputObject",new t.TokenList(this,e,a))})},clear:function(){return this.data("tokenInputObject").clear(),this},add:function(t){return this.data("tokenInputObject").add(t),this},remove:function(t){return this.data("tokenInputObject").remove(t),this},get:function(){return this.data("tokenInputObject").getTokens()},toggleDisabled:function(t){return this.data("tokenInputObject").toggleDisabled(t),this},setOptions:function(e){return t(this).data("settings",t.extend({},t(this).data("settings"),e||{})),this}};t.fn.tokenInput=function(t){return r[t]?r[t].apply(this,Array.prototype.slice.call(arguments,1)):r.init.apply(this,arguments)},t.TokenList=function(e,s){function d(s){return t(e).data("settings").enableHTML?s:n(s)}function l(n){"boolean"==typeof n?t(e).data("settings").disabled=n:t(e).data("settings").disabled=!t(e).data("settings").disabled,H.attr("disabled",t(e).data("settings").disabled),W.toggleClass(t(e).data("settings").classes.disabled,t(e).data("settings").disabled),z&&f(t(z),i.END),_.attr("disabled",t(e).data("settings").disabled)}function r(){return null!==t(e).data("settings").tokenLimit&&M>=t(e).data("settings").tokenLimit?(H.hide(),void T()):void 0}function u(){j!==(j=H.val())&&(K.html(n(j)),H.width(K.width()+30))}function c(){var n=t.trim(H.val()),s=n.split(t(e).data("settings").tokenDelimiter);t.each(s,function(n,s){if(s){t.isFunction(t(e).data("settings").onFreeTaggingAdd)&&(s=t(e).data("settings").onFreeTaggingAdd.call(_,s));var a={};a[t(e).data("settings").tokenValue]=a[t(e).data("settings").propertyToSearch]=s,p(a)}})}function g(n){var s=t(t(e).data("settings").tokenFormatter(n)),a=n.readonly===!0;a&&s.addClass(t(e).data("settings").classes.tokenReadOnly),s.addClass(t(e).data("settings").classes.token).insertBefore(V),a||t("<span>"+t(e).data("settings").deleteText+"</span>").addClass(t(e).data("settings").classes.tokenDelete).appendTo(s).click(function(){return t(e).data("settings").disabled?void 0:(m(t(this).parent()),_.change(),!1)});var i=n;return t.data(s.get(0),"tokeninput",n),N=N.slice(0,G).concat([i]).concat(N.slice(G)),G++,v(N,_),M+=1,null!==t(e).data("settings").tokenLimit&&M>=t(e).data("settings").tokenLimit&&(H.hide(),T()),s}function p(n){var s=t(e).data("settings").onAdd;if(M>0&&t(e).data("settings").preventDuplicates){var a=null;if(W.children().each(function(){var e=t(this),s=t.data(e.get(0),"tokeninput");return s&&s.id===n.id?(a=e,!1):void 0}),a)return h(a),V.insertAfter(a),void O(H)}(null==t(e).data("settings").tokenLimit||M<t(e).data("settings").tokenLimit)&&(g(n),r()),H.val(""),T(),t.isFunction(s)&&s.call(_,n)}function h(n){t(e).data("settings").disabled||(n.addClass(t(e).data("settings").classes.selectedToken),z=n.get(0),H.val(""),T())}function f(n,s){n.removeClass(t(e).data("settings").classes.selectedToken),z=null,s===i.BEFORE?(V.insertBefore(n),G--):s===i.AFTER?(V.insertAfter(n),G++):(V.appendTo(W),G=M),O(H)}function k(e){var n=z;z&&f(t(z),i.END),n===e.get(0)?f(e,i.END):h(e)}function m(n){var s=t.data(n.get(0),"tokeninput"),a=t(e).data("settings").onDelete,i=n.prevAll().length;i>G&&i--,n.remove(),z=null,O(H),N=N.slice(0,i).concat(N.slice(i+1)),G>i&&G--,v(N,_),M-=1,null!==t(e).data("settings").tokenLimit&&(H.show().val(""),O(H)),t.isFunction(a)&&a.call(_,s)}function v(n,s){var a=t.map(n,function(n){return"function"==typeof t(e).data("settings").tokenValue?t(e).data("settings").tokenValue.call(this,n):n[t(e).data("settings").tokenValue]});s.val(a.join(t(e).data("settings").tokenDelimiter))}function T(){q.hide().empty(),U=null}function y(){q.css({position:"absolute",top:t(W).offset().top+t(W).outerHeight(),left:t(W).offset().left,width:t(W).width(),"z-index":t(e).data("settings").zindex}).show()}function C(){t(e).data("settings").searchingText&&(q.html("<p>"+d(t(e).data("settings").searchingText)+"</p>"),y())}function b(){t(e).data("settings").hintText&&(q.html("<p>"+d(t(e).data("settings").hintText)+"</p>"),y())}function E(t){return t.replace(Q,"\\$&")}function w(t,e){return t.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)("+E(e)+")(?![^<>]*>)(?![^&;]+;)","gi"),function(t,e){return"<b>"+d(e)+"</b>"})}function D(t,e,n){return t.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)("+E(e)+")(?![^<>]*>)(?![^&;]+;)","g"),w(e,n))}function R(n,s){if(s&&s.length){q.empty();var a=t("<ul>").appendTo(q).mouseover(function(e){x(t(e.target).closest("li"))}).mousedown(function(e){return p(t(e.target).closest("li").data("tokeninput")),_.change(),!1}).hide();t(e).data("settings").resultsLimit&&s.length>t(e).data("settings").resultsLimit&&(s=s.slice(0,t(e).data("settings").resultsLimit)),t.each(s,function(s,i){var o=t(e).data("settings").resultsFormatter(i);o=D(o,i[t(e).data("settings").propertyToSearch],n),o=t(o).appendTo(a),s%2?o.addClass(t(e).data("settings").classes.dropdownItem):o.addClass(t(e).data("settings").classes.dropdownItem2),0===s&&x(o),t.data(o.get(0),"tokeninput",i)}),y(),t(e).data("settings").animateDropdown?a.slideDown("fast"):a.show()}else t(e).data("settings").noResultsText&&(q.html("<p>"+d(t(e).data("settings").noResultsText)+"</p>"),y())}function x(n){n&&(U&&F(t(U)),n.addClass(t(e).data("settings").classes.selectedDropdownItem),U=n.get(0))}function F(n){n.removeClass(t(e).data("settings").classes.selectedDropdownItem),U=null}function L(){var n=H.val();n&&n.length&&(z&&f(t(z),i.AFTER),n.length>=t(e).data("settings").minChars?(C(),clearTimeout(S),S=setTimeout(function(){A(n)},t(e).data("settings").searchDelay)):T())}function A(n){var s=n+P(),a=B.get(s);if(a)t.isFunction(t(e).data("settings").onCachedResult)&&(a=t(e).data("settings").onCachedResult.call(_,a)),R(n,a);else if(t(e).data("settings").url){var i=P(),o={};if(o.data={},i.indexOf("?")>-1){var d=i.split("?");o.url=d[0];var l=d[1].split("&");t.each(l,function(t,e){var n=e.split("=");o.data[n[0]]=n[1]})}else o.url=i;o.data[t(e).data("settings").queryParam]=n,o.type=t(e).data("settings").method,o.dataType=t(e).data("settings").contentType,t(e).data("settings").crossDomain&&(o.dataType="jsonp"),o.success=function(a){B.add(s,t(e).data("settings").jsonContainer?a[t(e).data("settings").jsonContainer]:a),t.isFunction(t(e).data("settings").onResult)&&(a=t(e).data("settings").onResult.call(_,a)),H.val()===n&&R(n,t(e).data("settings").jsonContainer?a[t(e).data("settings").jsonContainer]:a)},t.ajax(o)}else if(t(e).data("settings").local_data){var r=t.grep(t(e).data("settings").local_data,function(s){return s[t(e).data("settings").propertyToSearch].toLowerCase().indexOf(n.toLowerCase())>-1});B.add(s,r),t.isFunction(t(e).data("settings").onResult)&&(r=t(e).data("settings").onResult.call(_,r)),R(n,r)}}function P(){var n=t(e).data("settings").url;return"function"==typeof t(e).data("settings").url&&(n=t(e).data("settings").url.call(t(e).data("settings"))),n}function O(t){setTimeout(function(){t.focus()},50)}if("string"===t.type(s)||"function"===t.type(s)){t(e).data("settings").url=s;var I=P();void 0===t(e).data("settings").crossDomain&&"string"==typeof I&&(-1===I.indexOf("://")?t(e).data("settings").crossDomain=!1:t(e).data("settings").crossDomain=location.href.split(/\/+/g)[1]!==I.split(/\/+/g)[1])}else"object"==typeof s&&(t(e).data("settings").local_data=s);t(e).data("settings").classes?t(e).data("settings").classes=t.extend({},a,t(e).data("settings").classes):t(e).data("settings").theme?(t(e).data("settings").classes={},t.each(a,function(n,s){t(e).data("settings").classes[n]=s+"-"+t(e).data("settings").theme})):t(e).data("settings").classes=a;var S,j,N=[],M=0,B=new t.TokenList.Cache,H=t('<input type="text"  autocomplete="off">').css({outline:"none"}).attr("id",t(e).data("settings").idPrefix+e.id).focus(function(){return t(e).data("settings").disabled?!1:(null!==t(e).data("settings").tokenLimit&&t(e).data("settings").tokenLimit===M||b(),void W.addClass(t(e).data("settings").classes.focused))}).blur(function(){T(),t(this).val(""),W.removeClass(t(e).data("settings").classes.focused),t(e).data("settings").allowFreeTagging?c():t(this).val(""),W.removeClass(t(e).data("settings").classes.focused)}).bind("keyup keydown blur update",u).keydown(function(n){var s,a;switch(n.keyCode){case o.LEFT:case o.RIGHT:case o.UP:case o.DOWN:if(t(this).val()){var d=null;d=n.keyCode===o.DOWN||n.keyCode===o.RIGHT?t(U).next():t(U).prev(),d.length&&x(d)}else s=V.prev(),a=V.next(),s.length&&s.get(0)===z||a.length&&a.get(0)===z?n.keyCode===o.LEFT||n.keyCode===o.UP?f(t(z),i.BEFORE):f(t(z),i.AFTER):n.keyCode!==o.LEFT&&n.keyCode!==o.UP||!s.length?n.keyCode!==o.RIGHT&&n.keyCode!==o.DOWN||!a.length||h(t(a.get(0))):h(t(s.get(0)));return!1;case o.BACKSPACE:if(s=V.prev(),!t(this).val().length)return z?(m(t(z)),_.change()):s.length&&h(t(s.get(0))),!1;1===t(this).val().length?T():setTimeout(function(){L()},5);break;case o.TAB:case o.ENTER:case o.NUMPAD_ENTER:case o.COMMA:return U?(p(t(U).data("tokeninput")),_.change()):(t(e).data("settings").allowFreeTagging?c():t(this).val(""),n.stopPropagation(),n.preventDefault()),!1;case o.ESCAPE:return T(),!0;default:String.fromCharCode(n.which)&&setTimeout(function(){L()},5)}}),_=t(e).hide().val("").focus(function(){O(H)}).blur(function(){H.blur()}),z=null,G=0,U=null,W=t("<ul />").addClass(t(e).data("settings").classes.tokenList).click(function(e){var n=t(e.target).closest("li");n&&n.get(0)&&t.data(n.get(0),"tokeninput")?k(n):(z&&f(t(z),i.END),O(H))}).mouseover(function(n){var s=t(n.target).closest("li");s&&z!==this&&s.addClass(t(e).data("settings").classes.highlightedToken)}).mouseout(function(n){var s=t(n.target).closest("li");s&&z!==this&&s.removeClass(t(e).data("settings").classes.highlightedToken)}).insertBefore(_),V=t("<li />").addClass(t(e).data("settings").classes.inputToken).appendTo(W).append(H),q=t("<div>").addClass(t(e).data("settings").classes.dropdown).appendTo("body").hide(),K=t("<tester/>").insertAfter(H).css({position:"absolute",top:-9999,left:-9999,width:"auto",fontSize:H.css("fontSize"),fontFamily:H.css("fontFamily"),fontWeight:H.css("fontWeight"),letterSpacing:H.css("letterSpacing"),whiteSpace:"nowrap"});_.val("");var $=t(e).data("settings").prePopulate||_.data("pre");t(e).data("settings").processPrePopulate&&t.isFunction(t(e).data("settings").onResult)&&($=t(e).data("settings").onResult.call(_,$)),$&&$.length&&t.each($,function(t,e){g(e),r()}),t(e).data("settings").disabled&&l(!0),t.isFunction(t(e).data("settings").onReady)&&t(e).data("settings").onReady.call(),this.clear=function(){W.children("li").each(function(){0===t(this).children("input").length&&m(t(this))})},this.add=function(t){p(t)},this.remove=function(e){W.children("li").each(function(){if(0===t(this).children("input").length){var n=t(this).data("tokeninput"),s=!0;for(var a in e)if(e[a]!==n[a]){s=!1;break}s&&m(t(this))}})},this.getTokens=function(){return N},this.toggleDisabled=function(t){l(t)};var Q=new RegExp("[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\-]","g")},t.TokenList.Cache=function(e){var n=t.extend({max_size:500},e),s={},a=0,i=function(){s={},a=0};this.add=function(t,e){a>n.max_size&&i(),s[t]||(a+=1),s[t]=e},this.get=function(t){return s[t]}}}(jQuery);</script>
		<style>@charset "UTF-8";ul.token-input-list-facebook{overflow:hidden;height:auto!important;width:437px;cursor:text;font-family:Verdana;min-height:1px;z-index:999;margin:0;list-style-type:none;clear:left;float:left;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;-webkit-border-radius:0;-moz-border-radius:0;-ms-border-radius:0;-o-border-radius:0;border-radius:0;font-size:12px;color:#333;padding:0 0 0 5px;border:1px solid #d7d7d7;display:inline-block;background:#fdfdfd}ul.token-input-list-facebook li input{border:0;width:100px;margin:2px 0;padding:3px 8px;box-shadow:none;background-color:#fdfdfd;-webkit-appearance:caret}li.token-input-token-facebook{overflow:hidden;height:auto!important;margin:4px 5px 4px 0;padding:4px 5px;background-color:#eff2f7;color:#000;cursor:default;border:1px solid #ccd5e4;font-size:11px;float:left;white-space:nowrap}li.token-input-token-facebook p{display:inline;padding:0;margin:0}li.token-input-token-facebook span{color:#a6b3cf;margin-left:5px;font-weight:700;cursor:pointer}li.token-input-selected-token-facebook{background-color:#5670a6;border:1px solid #3b5998;color:#fff}li.token-input-input-token-facebook{float:left;margin:0;padding:0;list-style-type:none}div.token-input-dropdown-facebook{position:absolute;width:400px;background-color:#fff;overflow:hidden;border-left:1px solid #ccc;border-right:1px solid #ccc;border-bottom:1px solid #ccc;cursor:default;font-size:11px;font-family:Verdana;z-index:1}div.token-input-dropdown-facebook p{margin:0;padding:5px;font-weight:700;color:#777}div.token-input-dropdown-facebook ul{margin:0;padding:0}div.token-input-dropdown-facebook ul li{background-color:#fff;padding:3px;margin:0;list-style-type:none}div.token-input-dropdown-facebook ul li.token-input-dropdown-item-facebook,div.token-input-dropdown-facebook ul li.token-input-dropdown-item2-facebook{background-color:#fff}div.token-input-dropdown-facebook ul li em{font-weight:700;font-style:normal}div.token-input-dropdown-facebook ul li.token-input-selected-dropdown-item-facebook{background-color:#3b5998;color:#fff}</style>
        <script type="text/javascript">
        $(document).ready(function()
        {
            $("#snid").tokenInput("/engine/ajax/search_news_collect.php");
        });
        </script>
		<div class="box">
			<div class="box-content">
				<form method="post" enctype="multipart/form-data" class="form-horizontal" name="add" action="">
					<div class="row box-section">
						<div class="form-group">
							<label class="control-label col-md-2">Имя коллекции</label>
							<div class="col-md-10">
								<input type="text" style="width:99%;max-width:437px;" name="title" id="title" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Дата</label>
							<div class="col-md-10">
								<input data-rel="calendar" type="text" name="newdate" size="20" >&nbsp;<input class="checkbox-inline" type="checkbox" id="allow_date" name="allow_date" value="yes" checked>&nbsp;<label for="allow_date">{$lang['edit_jdate']}</label>{$author_info}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Новости коллекции</label>
							<div class="col-md-10">
								<input type="text" style="width:99%;max-width:437px;" name="snid" id="snid" value="" placeholder="Поиск новостей">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Изображение</label>
							<div class="col-md-10">
								<input type="file" name="file" style="width:99%;max-width:437px;" id="file" value="Выбрать картинку">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Описание коллекции</label>
							<div class="col-md-10">
HTML;
		$bb_editor = true;
		include (ENGINE_DIR . '/inc/include/inserttag.php');
	echo <<<HTML
								{$bb_code}<textarea style="width:100%;max-width:950px;height:300px;" onfocus="setFieldName(this.name)" name="text" id="text"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Альтернативное имя</label>
							<div class="col-md-10">
								<input type="text" name="alt_name" style="width:99%;max-width:437px;" id="alt_name" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Мета тег H1</label>
							<div class="col-md-10">
								<input type="text" name="metah1" style="width:99%;max-width:437px;" id="metah1" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Мета тег Title</label>
							<div class="col-md-10">
								<input type="text" name="meta_title" style="width:99%;max-width:437px;" id="meta_title" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Мета тег Description</label>
							<div class="col-md-10">
								<input type="text" name="meta_descr" style="width:99%;max-width:437px;" id="meta_descr" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Мета тег Keywords</label>
							<div class="col-md-10">
								<textarea class="tags" name="meta_keywd" id='meta_keywd' style="width:437px;"></textarea><br /><br />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Включить индлексацию</label>
							<div class="col-md-10">
								<input class="icheck" type="checkbox" id="allow_rating" name="index" value="1" checked>
							</div>
						</div>
					</div>
					<div class="padded">
						<input type="submit" class="btn btn-green" value="Добавить">&nbsp;
					    <input type="hidden" name="user_hash" value="$dle_login_hash" />
					    <input type="hidden" name="action" value="doadd" />
					    <input type="hidden" name="mod" value="collections" />
					</div>
				</form>
			</div>
		</div>
HTML;

	echofooter();
}
elseif( $action == 'doadd' )
{
	$title = $db->safesql( $_POST['title'] );
	$metah1 = $db->safesql( $_POST['metah1'] );
	$mtitle = $db->safesql($_POST['meta_title']);
	$descr = $db->safesql( $_POST['meta_descr'] );
	$keywd = $db->safesql( $_POST['meta_keywd'] );
	$text = $db->safesql( $parse->process( $parse->BB_Parse( $_POST['text'] ) ) );
	$snid = $db->safesql( $_POST['snid'] );
	$indexd = intval( $_POST['index'] );

	if( trim( $title ) == "" and $ifdelete != "yes" ) msg( "error", $lang['cat_error'], $lang['addnews_alert'], "javascript:history.go(-1)" );

	if( trim( $_POST['alt_name'] ) == "" or ! $_POST['alt_name'] ) $alt_name = TotsAltName( stripslashes( $title ) );
	else $alt_name = TotsAltName( stripslashes( $_POST['alt_name'] ) );

	# Загрузка изображений
	if( $_FILES['file']['tmp_name'] )
	{
		$image = SaveImg($_FILES['file'], $alt_name, $collect['image'], $collect['sm_image'], $collect['folder_up'], $collect['quality_img'], $collect['sm_image_on']);
	}

	// Обработка даты и времени
	$up_times = trim(@implode ('', @file($serv_time)));
	$added_time = time();
	$newdate = $_POST['newdate'];
	
	if( $_POST['allow_date'] != "yes" ) {
		
		if( (($newsdate = strtotime( $newdate )) === - 1) OR !$newsdate ) {
			msg( "error", $lang['addnews_error'], $lang['addnews_erdate'], "javascript:history.go(-1)" );
		} else {
			$thistime = date( "Y-m-d H:i:s", $newsdate );
		}
		
		if( ! intval( $config['no_date'] ) and $newsdate > $added_time ) {
			$thistime = date( "Y-m-d H:i:s", $added_time );
		}
	
	} else
		$thistime = date( "Y-m-d H:i:s", $added_time );

	// Смена автора публикации
	$author = $member_id['name'];
	$userid = $member_id['user_id'];

	if( $member_id['user_group'] == 1 AND $_POST['new_author'] != $member_id['name'] ) {

		$_POST['new_author'] = $db->safesql( $_POST['new_author'] );
					
		$row = $db->super_query( "SELECT name, user_id  FROM " . USERPREFIX . "_users WHERE name = '{$_POST['new_author']}'" );
					
		if( $row['user_id'] ) {

			$author = $row['name'];
			$userid = $row['user_id'];

		}
	}

	$db->query("INSERT INTO ".PREFIX."_collections (date, autor, meta_h1, alt_name, nid, title, mtitle, descr, keywd, text, follow, image) VALUES('{$thistime}','{$author}','{$metah1}','{$alt_name}','{$snid}','{$title}','{$mtitle}','{$descr}','{$keywd}','{$text}','{$indexd}','{$image}')");

	msg( "info", $lang['addnews_ok'], $lang['addnews_ok_1'] . " \"" . stripslashes( stripslashes( $title ) ) . "\" " . $lang['addnews_ok_2'], "?mod=collections" );
}
?>