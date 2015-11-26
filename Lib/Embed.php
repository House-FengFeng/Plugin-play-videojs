<?php
require_once 'LoadPlugins.php';

foreach ($Plugins_List as $value) {
	require_once('Lib/Plugins/' . $value);
}

Class Player_Load
{
	Private $__Server 	= NULL;
	Private $__Link;

	Protected $Err_1	= 'Cache directory does not exist!';
	Protected $Err_2	= 'B&#7841;n ch&#432;a nh&#7853;p th&ecirc;m plugin cho server n&agrave;y!';
	Protected $Err_3	= 'Kh&ocirc;ng th&#7875; ki&#7875;m tra server!';
	Protected $Err_4	= 'Kh&ocirc;ng th&#7875; kh&#7903;i t&#7841;o Server';
	Protected $Err_5	= 'Kh&ocirc;ng t&igrave;m th&#7845;y d&#7919; li&#7879;u c&#7847;n d&ugrave;ng';
	Protected $Err_6	= 'L&#7895;i trong qu&aacute; trinh trao &#273;&#7893;i d&#7919; li&#7879;u!';

	Function __construct()
	{
		$GLOBALS['autoplay'] = ($GLOBALS['autoplay'] == '') ? 'False' : $GLOBALS['autoplay'];
		$GLOBALS['text'] = ($GLOBALS['text'] == '') ? 'No support for HTML5' : $GLOBALS['text'];
		if (isset($GLOBALS['Cache']) == TRUE && $GLOBALS['Cache'] === 1) {
			if (!file_exists($GLOBALS['Cache_Folder']) === 1) {
				exit($this->Err_1);
			}
		}
	}

	Public Function _Embed()
	{
		$Embed 	= '';
		$Embed .= '<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">';
		$Embed .= '<link rel="stylesheet" type="text/css" href="Player/css/video-js-ad.css" />';
		$Embed .= '<link rel="stylesheet" type="text/css" href="Player/css/videojs.css" />';
		$Embed .= '<script type="text/javascript" src="Player/js/video.js"></script>';
		$Embed .= '<script type="text/javascript" src="Player/js/quality.js"></script>';
		echo $Embed;
	}

	Private Function __ReadCache($Url, $Cache_Time)
	{
		$Cache_File = $GLOBALS['Cache_Folder'] . MD5($Url);
		if (file_exists($Cache_File) && time() - $Cache_Time < filemtime($Cache_File)) {
			$Text = "<!-- The file is created at " . date('H:i', filemtime($Cache_File)) . " --> \n";
			$Js = file_get_contents($Cache_File) . '<br />' . $Text;
			return $Js;
		}
		return 0;
	}

	Private Function __WriteCache($Url, $Data)
	{
		$Cache_File = $GLOBALS['Cache_Folder'] . MD5($Url);
		$Open = fopen($Cache_File, 'w');
		file_put_contents($Cache_File, $Data);
		fclose($Open);
	}

	Private Function _CheckInclude()
	{
		if ($this->__Server == 1) {
			if (!class_exists('Picasa')) {
				exit($this->Err_2);
			}
		}
		elseif ($this->__Server == 2) {
			if (!class_exists('YoutbeDownloader')) {
				exit($this->Err_2);
			}
		}
		elseif ($this->__Server == 3) {
			if (!class_exists('ZingTV')) {
				exit($this->Err_2);
			}
		}
		else {
			return 0;
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
		elseif (strpos($Url, 'tv.zing.vn') == TRUE) {
			if (preg_match('/^http:\/\/tv.zing.vn\/video\/(.*?)\/(.*?).html$/', $Url) == 1) {
				$this->__Server = 3;
			}
			else {
				$this->__Server = NULL;
			}
		}
		else {
			return 0;
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
		elseif ($this->__Server == 3) {
			$Object = New ZingTV($Url);
			$Link = $Object->_Get();
			unset($Object);
		}
		else {
			return $this->Err_3;
		}
		return $Link;
	}

	Private Function __Cache($Time)
	{
		if ($GLOBALS['Cache'] === 1 AND $GLOBALS['Cache_Folder'] AND $Time != '') {
			$ReadCache = $this->__ReadCache($this->__Link, $Time);
			if ($ReadCache === 0) {
				$DataCache = $this->_CheckServer($this->__Link);
				$this->__WriteCache($this->__Link, $DataCache);
				return $DataCache;
			}
			return $ReadCache;
		}
		else {
			return $this->_CheckServer($this->__Link);
		}
	}

	Private Function __TimeServer()
	{
		switch ($this->__Server) {
			case 1:
				$Data = $this->__Cache($GLOBALS['Cache_Time_Picasa']);
				break;
			case 2:
				$Data = $this->__Cache($GLOBALS['Cache_Time_Youtube']);
				break;
			case 3:
				$Data = $this->__Cache($GLOBALS['Cache_Time_ZingTV']);
				break;
			default:
				$Data = $this->Err_5;
				break;
		}
		return $Data;
	}

	Public Function _Player($Url, $Sub)
	{
		$this->__Link = $Url;
		$Sv = $this->_SetServer($this->__Link);
		$this->_CheckInclude();
		if ($Sv === 0) {
			exit($this->Err_4);
		}
		$Cache = $this->__TimeServer();
		if (!empty($Sub)) {
			$Sub = '<track kind="subtitles" src="' . $Sub . '" srclang="vi" label="Tiếng Việt" default></track>';
		}
		else {
			$Sub = '';
		}
		$Player = '<video id="Sum_Plugin" class="video-js vjs-default-skin vjs-big-play-centered" controls="true" autoplay="' . $GLOBALS['autoplay'] . '" preload="' . $GLOBALS['preload'] . '" width="' . $GLOBALS['width'] . '" height="' . $GLOBALS['height'] . '" data-setup=\'{ "plugins" : { "resolutionSelector" : {} }, "playbackRates": [' . $GLOBALS['playbackRates'] . ']}\'>
			' . $Cache .
			$Sub . '
			<p class="vjs-no-js">' . $GLOBALS['text'] . '</p>
		</video>
		<script type="text/javascript">console.log("%cVersion: 2.0.0.2\nCopyright (C) Jkey C Phong\nVui l\u00f2ng kh\u00f4ng ch\u1ec9nh s\u1eeda file d\u01b0\u1edbi m\u1ecdi h\u00ecnh th\u1ee9c\nN\u1ebfu c\u00f3 nhu c\u1ea7u c\u1ea7n th\u00eam b\u1edbt ch\u1ee9c n\u0103ng h\u00e3y li\u00ean h\u1ec7 v\u1edbi ch\u00fang t\u00f4i!","color: red; font-size: large");</script>';
		unset($GLOBALS['text'], $Url, $GLOBALS['width'], $GLOBALS['height'], $GLOBALS['Cache_Time'], $GLOBALS['Cache_Folder'], $GLOBALS['autoplay'], $GLOBALS['preload'], $GLOBALS['playbackRates']);
		echo $Player;
	}
}
?>
