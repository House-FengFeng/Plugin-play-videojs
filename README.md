# Hướng dẫn sử dụng mã nguồn:

##**Mục Lục:**
- [Mục đích của bộ mã nguồn](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#m%E1%BB%A5c-%C4%91%C3%ADch)
- [Kiến thức cần thiết để sử dụng](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#ki%E1%BA%BFn-th%E1%BB%A9c-c%E1%BA%A7n-thi%E1%BA%BFt)
- [Hướng dẫn sử dụng](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#h%C6%B0%E1%BB%9Bng-d%E1%BA%ABn-s%E1%BB%AD-d%E1%BB%A5ng)
- [Cập nhập]()
- [Tác giả](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#t%C3%A1c-gi%E1%BA%A3-zhu-jin-feng)
- [Facebook](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#facebook-httpswwwfacebookcomprofilephpid100004989074517)

####**Mục đích:**
- Hỗ trợ cho những ai chưa tích hợp được player cho site

####**Kiến thức cần thiết:**
- Biết đọc code index.php ~.~

####**Hướng dẫn sử dụng:**
- Sau khi tải xuống thành công, việc đầu tiên của bạn sẽ là copy hết vào localhost, chạy file index.php để xem thành quả!
- Các bạn mở file index.php lên để xem cách nó truyền link vào!
- Để cấu hình player, các bạn vào file Player.php, ở đấy mình đã chú thích đầy đủ
- Ở file LoadPlugins.php, nếu bạn chỉ sử dụng server Picasa thì hãy bỏ dòng **$Plugins_List[] = 'Class-Youtube.php';** đi để tránh include dư thừa
- Những file còn lại các bạn vui lòng không chỉnh sửa, nếu có nhu cầu muốn update thêm chức năng hay bất cứ thứ gì liên quan có thể inbox mình, nếu được mình sẽ update
- Vui lòng share source nhớ ghi rõ nguồn

####**Cập nhập:**
#####Version 2.0.0.0:
- Thêm tùy chọn (flash, cache)
- Tích hợp cache vào code, tùy chọn tắt hoặc mở cache
- Hỗ trợ 3 server Picasa, Youtube, Zing TV
- Hỗ trợ get link trung gian Zing TV với những host nước ngoài bị chặn IP
- Thay đổi player cho đẹp mắt ( Được cung cấp bởi một bạn trên group facebook mà quên mất tên nên mình sẽ update lại sau )
- Fix lại code và một số lỗi chính tả

#####Version 1.0.0.0:
- Thêm tùy chọn (css, js, quality, width, height, text, ...)
- Hỗ trợ server Picasa, Youtube

####**Tác giả:** Zhu Jin Feng

####**Facebook:** https://www.facebook.com/profile.php?id=100004989074517
