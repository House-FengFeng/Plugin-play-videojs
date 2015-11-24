<?php
define('Check', true);
require_once 'Player.php';
require_once 'Lib/Embed.php';
require_once 'LoadPlugins.php';

### Version: 2.0.0.0 ###

Class Player extends Player_Load
{
	Public Function __Show($Url)
	{
    	if (isset($GLOBALS['css'], $GLOBALS['js'], $GLOBALS['ie8'], $GLOBALS['text'], $GLOBALS['width'], $GLOBALS['height'], $GLOBALS['flash'], $GLOBALS['quality_js'], $GLOBALS['quality_css']) === TRUE) {
			parent::_Embed();
			parent::_Player($Url);
		}
		else {
			exit('L&#7895;i trong qu&aacute; tr&igrave;nh trao &#273;&#7893;i d&#7919; li&#7879;u');
		}
	}
}
?>
