<?php

### Vui lòng không sửa code dưới mọi hình thức!
### Nếu có nhu cầu, có thể liên hệ mình để fix lại code cho phù hợp với nhu cầu sử dụng

if (!defined('Check')) {
	header('HTTP/1.1 404 Not Found');
	exit();
}
require_once 'LoadPlugins.php';
foreach ($Plugins_List as $value) {
	require_once('Lib/Plugins/' . $value);
}

Class Player_Load
{
	Private $__Server 	= NULL;
	static $__Swf		= 'http://vjs.zencdn.net/c/video-js.swf';

	Function __construct()
	{
		$GLOBALS['css'] = ($GLOBALS['css'] == '') ? NULL : $GLOBALS['css'];
		$GLOBALS['js'] = ($GLOBALS['js'] == '') ? NULL : $GLOBALS['js'];
		$GLOBALS['ie8'] = ($GLOBALS['ie8'] == '') ? NULL : $GLOBALS['ie8'];
	}

	Public Function _Embed()
	{
		if (!is_null($GLOBALS['css']) && !is_null($GLOBALS['js']) && !is_null($GLOBALS['quality_js']) && !is_null($GLOBALS['quality_css']) == 1) {
			$Embed = '';
			$Embed .= '<link href="' . $GLOBALS['css'] . '" rel="stylesheet">' . "\n";
			$Embed .= '<link href="' . $GLOBALS['quality_css'] . '" rel="stylesheet">' . "\n";
			$Embed .= '<script src="' . $GLOBALS['js'] . '"></script>' . "\n";
			$Embed .= '<script src="' . $GLOBALS['quality_js'] . '"></script>' . "\n";
			if (!is_null($GLOBALS['ie8']) == 1) {
				$Embed .= '<script src="' . $GLOBALS['ie8'] . '"></script>' . "\n";
			}
			unset($GLOBALS['css'], $GLOBALS['js'], $GLOBALS['ie8']);
			echo $Embed;
		}
		else {
			exit();
		}
	}

	Private Function _CheckInclude()
	{
		if ($this->__Server == 1) {
			if (!class_exists('Picasa')) {
				exit('Bạn chưa nhập thêm plugins cho server này!');
			}
		}
		elseif ($this->__Server == 2) {
			if (!class_exists('YoutbeDownloader')) {
				exit('Bạn chưa nhập thêm plugins cho server này!');
			}
		}
		else {
			return '#Error';
		}
	}

	Private Function _SetServer($Url)
	{
		if (strpos($Url, 'picasaweb.google.com') == TRUE) {
			$Google = preg_match('/^https:\/\/picasaweb.google.com\/lh\/photo\/(.*?)\?feat=directlink$/', $Url);
			if ($Google == 1) {
				$this->__Server = 1;
			}
			elseif (preg_match('/^https:\/\/picasaweb.google.com\/([0-9]+)\/(.*?)\?authkey=(.*?)$/', $Url) == 1) {
				$this->__Server = 1;
			}
			else {
				$this->__Server = NULL;
			}
		}
		elseif (strpos($Url, 'youtube.com') == TRUE) {
			if (preg_match('/^https:\/\/www.youtube.com\/watch\?v=(.*?)$/', $Url) == 1) {
				$this->__Server = 2;
			}
			else {
				$this->__Server = NULL;
			}
		}
		else {
			return '#Error';
		}
	}

	Private Function _CheckServer($Url)
	{
		if ($this->__Server == 1) {
			$Goo = New Picasa($Url);
			$Link = $Goo->_get();
			unset($Goo);
		}
		elseif ($this->__Server == 2) {
			$Link = YoutbeDownloader::getInstance()->getLink($Url);
		}
		else {
			return '#Error';
		}
		return $Link;
	}

	Private Function _CheckFlash()
	{
		if ($GLOBALS['flash'] == 1) {
			$Flash = $GLOBALS['path_flash'] = 'videojs("Sum_Plugin", {techOrder: ["flash"]});';
		}
		else {
			$Flash = '';
		}
		return $Flash;
	}

	Public Function _Player($Url)
	{
		$this->_SetServer($Url);
		$this->_CheckInclude();
		$Link = $this->_CheckServer($Url);
		$Flash = $this->_CheckFlash();
		$Player = '<video id="Sum_Plugin" class="video-js" controls preload="auto" width="' . $GLOBALS['width'] . '" height="' . $GLOBALS['height'] . '" data-setup="{  \'techOrder\': [\'flash\'] }">
			' . $Link . '
			<p class="vjs-no-js">' . $GLOBALS['text'] . '</p>
		</video>
		<script type="text/javascript">' . $Flash . 'videojs("Sum_Plugin").videoJsResolutionSwitcher();</script>';
		unset($GLOBALS['text'], $Url, $GLOBALS['width'], $GLOBALS['height'], $GLOBALS['flash'], $GLOBALS['path_flash']);
		echo $Player;
	}
}
?>
