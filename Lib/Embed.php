<?php
//setlocale(LC_TIME, 'vn_VN');
//date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once 'LoadPlugins.php';
foreach ($Plugins_List as $value) {
	require_once('Lib/Plugins/' . $value);
}

Class Player_Load
{
	Private $__Server 	= NULL;
	Private $__Link;

	Function __construct()
	{
		$GLOBALS['css']	= ($GLOBALS['css'] == '')	? NULL : $GLOBALS['css'];
		$GLOBALS['js']	= ($GLOBALS['js'] == '')	? NULL : $GLOBALS['js'];
		$GLOBALS['ie8']	= ($GLOBALS['ie8'] == '')	? NULL : $GLOBALS['ie8'];
		$GLOBALS['text'] = ($GLOBALS['text'] == '') ? 'Kh&ocirc;ng h&#7895; tr&#7907; HTML5' : $GLOBALS['text'];
		if (!file_exists($GLOBALS['Cache_Folder']) == 1) {
			exit('Folder cache không tồn tại, vui lòng kiểm tra!');
		}
	}

	Public Function _Embed()
	{
		if ($GLOBALS['css'] AND $GLOBALS['js'] != '') {
			$Embed = '';
			$Embed .= '<link href="' . $GLOBALS['css'] . '" rel="stylesheet">' . "\n";
			$Embed .= '<script src="' . $GLOBALS['js'] . '"></script>' . "\n";
			if ($GLOBALS['ie8'] != '') {
				$Embed .= '<script src="' . $GLOBALS['ie8'] . '"></script>' . "\n";
			}
			if ($GLOBALS['quality_js'] and $GLOBALS['quality_css'] != '') {
				$Embed .= '<link href="' . $GLOBALS['quality_css'] . '" rel="stylesheet">' . "\n";
				$Embed .= '<script src="' . $GLOBALS['quality_js'] . '"></script>' . "\n";
			}
			unset($GLOBALS['css'], $GLOBALS['js'], $GLOBALS['ie8'], $GLOBALS['quality_js'], $GLOBALS['quality_css']);
			echo $Embed;
		}
		else {
			exit();
		}
	}

	/* Function &#273;&#7885;c cache */

	Private Function __ReadCache($Url, $Cache_Time)
	{
		$Cache_File = $GLOBALS['Cache_Folder'] . MD5($Url);
		if (file_exists($Cache_File) && time() - $Cache_Time < filemtime($Cache_File)) {
			$Text = "<!-- The file is created at " . date('H:i', filemtime($Cache_File)) . " --> \n";
			$Open = fopen($Cache_File, 'r');
			$Js = file_get_contents($Cache_File) . '<br />' . $Text;
			fclose($Open);
			return $Js;
		}
		return 0;
	}

	/* Function t&#7841;o cache */

	Private Function __WriteCache($Url, $Data)
	{
		$Cache_File = $GLOBALS['Cache_Folder'] . MD5($Url);
		$Open = fopen($Cache_File, 'w');
		fwrite($Open, $Data);
		fclose($Open);
	}

	Private Function _CheckInclude()
	{
		$Msg = 'B&#7841;n ch&#432;a nh&#7853;p th&ecirc;m plugin cho server n&agrave;y!';
		if ($this->__Server == 1) {
			if (!class_exists('Picasa')) {
				exit($Msg);
			}
		}
		elseif ($this->__Server == 2) {
			if (!class_exists('YoutbeDownloader')) {
				exit($Msg);
			}
		}
		elseif ($this->__Server == 3) {
			if (!class_exists('ZingTV')) {
				exit($Msg);
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
		elseif (strpos($Url, 'tv.zing.vn') == TRUE) {
			if (preg_match('/^http:\/\/tv.zing.vn\/video\/(.*?)\/(.*?).html$/', $Url) == 1) {
				$this->__Server = 3;
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
		elseif ($this->__Server == 3) {
			$Object = New ZingTV($Url);
			$Link = $Object->_Get();
			unset($Object);
		}
		else {
			return '#Error';
		}
		return $Link;
	}

	Private Function __Cache()
	{
		if ($GLOBALS['Cache'] === 1 AND $GLOBALS['Cache_Folder'] AND $GLOBALS['Cache_Time'] != '') {
			$ReadCache = $this->__ReadCache($this->__Link, $GLOBALS['Cache_Time']);
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

	Private Function _CheckFlash()
	{
		if ($GLOBALS['flash'] === 1) {
			$Flash = '<script type="text/javascript">videojs("Sum_Plugin", {techOrder: ["flash"]});</script>';
		}
		else {
			$Flash = '';
		}
		return $Flash;
	}

	Public Function _Player($Url)
	{
		$this->__Link = $Url;
		$this->_SetServer($this->__Link);
		$this->_CheckInclude();
		$Cache = $this->__Cache();
		$Flash = $this->_CheckFlash();
		$Player = '<video id="Sum_Plugin" class="video-js vjs-default-skin" controls="true" autoplay="false" width="' . $GLOBALS['width'] . '" height="' . $GLOBALS['height'] . '" data-setup=\'{ "plugins" : { "resolutionSelector" : { "default_res" : "1080,720,480,360" } }, "preload": "auto" }\'>
			' . $Cache . '
			<p class="vjs-no-js">' . $GLOBALS['text'] . '</p>
		</video>
		' . $Flash . '
		<script type="text/javascript">console.log("%cVersion: 2.0.0.0\nCopyright (C) Jkey C Phong\nVui l\u00f2ng kh\u00f4ng ch\u1ec9nh s\u1eeda file d\u01b0\u1edbi m\u1ecdi h\u00ecnh th\u1ee9c\nN\u1ebfu c\u00f3 nhu c\u1ea7u c\u1ea7n th\u00eam b\u1edbt ch\u1ee9c n\u0103ng h\u00e3y li\u00ean h\u1ec7 v\u1edbi ch\u00fang t\u00f4i!","color: red; font-size: large");</script>';
		unset($GLOBALS['text'], $Url, $GLOBALS['width'], $GLOBALS['height'], $GLOBALS['flash'], $GLOBALS['Cache_Time'], $GLOBALS['Cache_Folder']);
		echo $Player;
	}
}
?>
