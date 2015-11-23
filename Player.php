<?php
if (!defined('Check')) {
	header('HTTP/1.1 404 Not Found');
	exit();
}
### Tạo đường dẫn đến các file js và css phục vụ cho videojs ###
$GLOBALS['css']			= 'Player/video-js.min.css';				// Link CSS videojs
$GLOBALS['js']			= 'Player/video.min.js';					// Link JS videojs
$GLOBALS['ie8']			= 'Player/ie8/videojs-ie8.min.js';			// Link hỗ trợ IE8 videojs
$GLOBALS['quality_js']	= 'Player/videojs-resolution-switcher.js';	// Link hỗ trợ chất lượng phim
$GLOBALS['quality_css']	= 'Player/videojs-resolution-switcher.css'; // Link hỗ trợ chất lượng phim
### Tạo đường dẫn đến các file js và css phục vụ cho videojs ###

### Chỉnh sửa các tùy chọn cho player videojs ###
$GLOBALS['flash']		= 1; // Nếu muốn dùng flash thì thay đổi thành 1, ngược lại nếu muốn dùng html5 thì đổi lại thành 0
$GLOBALS['width']		= '1000';	// Chiều rộng của player
$GLOBALS['height']		= '500';	// Chiều cao của player
$GLOBALS['text']		= 'Không hỗ trợ HTML5';		// Text hiển thị khi trình duyệt của người dùng không hỗ trợ HTML5
### Chỉnh sửa các tùy chọn cho player videojs ###
?>
