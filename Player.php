<?php

/*
	Không hỗ trợ flash cho videojs :)
*/

### Chỉnh sửa các tùy chọn cho player videojs ###
$GLOBALS['width']		= '1000';	// Chiều rộng của player
$GLOBALS['height']		= '500';	// Chiều cao của player
$GLOBALS['text']		= 'Kh&ocirc;ng h&#7895; tr&#7907; HTML5';		// Text hiển thị khi trình duyệt của người dùng không hỗ trợ HTML5
$GLOBALS['autoplay']	= 'true';	// Thay đổi thành true hay false
$GLOBALS['preload']		= 'auto';	// Nên để mặc định là auto
$GLOBALS['playbackRates'] = '0.5, 1, 1.5, 2';	// Tốc độ khi play video
### Chỉnh sửa các tùy chọn cho player videojs ###

### Cấu hình cache link phim ###
$GLOBALS['Cache']			= 1;		// 1: Mở cache ; 2: Tắt cache
$GLOBALS['Cache_Folder'] 	= 'Cache/';	// Luôn có dấu "/" ở sau cùng
$GLOBALS['Cache_Time_Picasa'] 		= '6000';	// Tính bằng giây
$GLOBALS['Cache_Time_Youtube'] 		= '4000';	// Tính bằng giây
$GLOBALS['Cache_Time_ZingTV'] 		= '2000';	// Tính bằng giây
### Cấu hình cache link phim ###
?>
