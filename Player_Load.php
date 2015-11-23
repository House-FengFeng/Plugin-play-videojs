<?php
define('Check', true);
require_once 'Player.php';
require_once 'Lib/Embed.php';
require_once 'LoadPlugins.php';

Class Player extends Player_Load
{
	Public Function __Show($Url)
	{
    	if (isset($GLOBALS['css'], $GLOBALS['js'], $GLOBALS['ie8'], $GLOBALS['text'], $GLOBALS['quality_css'], $GLOBALS['quality_js'], $GLOBALS['width'], $GLOBALS['height'], $GLOBALS['flash']) === TRUE) {
			parent::_Embed();
			parent::_Player($Url);
		}
		else {
			exit('Lỗi trong quá trình trao đổi dữ liệu');
		}
	}
}
?>
