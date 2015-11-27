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

	### Hỗ trợ 5 server là: Picasa, Youtube, Dailymotion, Google Photo, Zing TV (Hỗ trợ cho cả host nước ngoài bị chặn IP)
	### Version: 3.0.0

	require 'Player_Load.php';
	$Object = new Player();
	//$Object->__Show('https://picasaweb.google.com/111679342576603394295/Bask?authkey=Gv1sRgCKqoyvGZ_aGN1gE#6153409278111438402', 'sub/sub.srt');
	//$Object->__Show('http://tv.zing.vn/video/Haikyuu-Tap-25-END/IWZAC066.html');
	//$Object->__Show('https://www.youtube.com/watch?v=oClscAn5ou4','sub/sub.srt', 'capture.png');
	$Object->__Show('http://www.dailymotion.com/video/x3azrmi_adele-hello-cover-by-alice-olivia_music');
	//$Object->__Show('https://photos.google.com/share/AF1QipPP_M4EaHgKVuzpgaTqK-Ql-flIWITx5QF-hfPzLuR0SdC971MQYYhLN-_8yaQulg/photo/AF1QipPhlqVQlq0VT-6fPeKH7ogcZZ7f94OJu_klKKyz?key=N2dCVDJLd1NCREJFQnM3WEpUNDItMDhxWmtpZzdn');
	unset($Object);
	?>
</body>
</html>
