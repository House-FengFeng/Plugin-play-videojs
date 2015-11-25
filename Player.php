<?php

### Update version 2.0.0.1 ###

### Tạo đường dẫn đến các file js và css phục vụ cho videojs ###
$GLOBALS['css']			= 'Player/temp/player_style.css';			// Link CSS videojs
$GLOBALS['js']			= 'Player/temp/player_script.js';			// Link JS videojs
$GLOBALS['ie8']			= 'Player/ie8/videojs-ie8.min.js';			// Link hỗ trợ IE8 videojs
$GLOBALS['quality_js']	= 'Player/temp/quality.js';
$GLOBALS['quality_css']	= 'Player/temp/quality.css';
### Tạo đường dẫn đến các file js và css phục vụ cho videojs ###

### Chỉnh sửa các tùy chọn cho player videojs ###
$GLOBALS['flash']		= 0; // Nếu muốn dùng flash thì thay đổi thành 1, ngược lại nếu muốn dùng html5 thì đổi lại thành 0
// Lưu ý: Do player nghiêng khá nhiều về html5 nên khi sử dụng FLASH sẽ không hiển thị chất lượng phim, mặc định sẽ play chất lượng cao nhất, còn với HTML5 thì vô tư
// Bạn nào muốn sử dụng FLASH mà có hiển thị chất lượng thì hãy thay player và link quality :)
// Mặc định sẽ tắt chế độ FLASH để player có thể hiển thị đầy đủ nhất có thể!
$GLOBALS['width']		= '1000';	// Chiều rộng của player
$GLOBALS['height']		= '500';	// Chiều cao của player
$GLOBALS['text']		= 'Kh&ocirc;ng h&#7895; tr&#7907; HTML5';		// Text hiển thị khi trình duyệt của người dùng không hỗ trợ HTML5
### Chỉnh sửa các tùy chọn cho player videojs ###

### Cấu hình cache link phim ###
$GLOBALS['Cache']			= 1;		// 1: Mở cache ; 2: Tắt cache
$GLOBALS['Cache_Folder'] 	= 'Cache/';	// Luôn có dấu "/" ở sau cùng
$GLOBALS['Cache_Time'] 		= '2000';	// Tính bằng giây
### Cấu hình cache link phim ###
?>
