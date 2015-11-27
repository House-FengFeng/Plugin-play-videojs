<?php

### Ver: 3.0.0 ###

require_once 'Player.php';
require_once 'Lib/Embed.php';
require_once 'LoadPlugins.php';

Class Player extends Player_Load
{
	Private Function __Options()
	{
		if (isset(
				$GLOBALS['logo'],
				$GLOBALS['des_logo'],
				$GLOBALS['text'],
				$GLOBALS['width'],
				$GLOBALS['height'],
				$GLOBALS['Cache']
			) === TRUE) {
		}
		else {
			exit($this->Err_6);
		}
	}

	Public Function __Show($Url, $Sub = '', $Poster = '')
	{
		$this->__Options();
		parent::_Embed();
		parent::_Player($Url, $Sub, $Poster);
	}
}
?>
