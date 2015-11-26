<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Test Code</title>
</head>
<body>
	<style type='text/css'>
		body {
			font-family: Arial, sans-serif;
			background: #777;
		}
		.video-js {
			margin: 40px auto;
		}
	</style>

	<?php

	### Hỗ trợ 3 server là: Picasa, Youtube, Zing TV (Hỗ trợ cho cả host nước ngoài bị chặn IP)
	### Version: 2.0.0.2

	require 'Player_Load.php';
	$Object = new Player();
	$Object->__Show('https://picasaweb.google.com/111679342576603394295/Bask?authkey=Gv1sRgCKqoyvGZ_aGN1gE#6153409278111438402');
	//$Object->__Show('http://tv.zing.vn/video/Haikyuu-Tap-25-END/IWZAC066.html');
	//$Object->__Show('https://www.youtube.com/watch?v=oClscAn5ou4');
	unset($Object);
	?>
</body>
</html>
