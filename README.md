# Hướng dẫn sử dụng mã nguồn:

##**Mục Lục:**
- [Mục đích của bộ mã nguồn](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#m%E1%BB%A5c-%C4%91%C3%ADch)
- [Kiến thức cần thiết để sử dụng](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#ki%E1%BA%BFn-th%E1%BB%A9c-c%E1%BA%A7n-thi%E1%BA%BFt)
- [Hướng dẫn sử dụng](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#h%C6%B0%E1%BB%9Bng-d%E1%BA%ABn-s%E1%BB%AD-d%E1%BB%A5ng)
- [Cập nhập](https://github.com/House-FengFeng/Plugin-play-videojs/blob/master/README.md#c%E1%BA%ADp-nh%E1%BA%ADp)
- [Tác giả](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#t%C3%A1c-gi%E1%BA%A3-zhu-jin-feng)
- [Facebook](https://github.com/House-FengFeng/Plugin-play-videojs/tree/master#facebook-httpswwwfacebookcomprofilephpid100004989074517)

####**Mục đích:**
- Hỗ trợ cho những ai chưa tích hợp được player cho site

####**Kiến thức cần thiết:**
- Biết đọc code index.php ~.~

####**Hướng dẫn sử dụng:**
- Sau khi tải xuống thành công, việc đầu tiên của bạn sẽ là copy hết vào localhost, chạy file index.php để xem thành quả!
- Các bạn mở file index.php lên để xem cách nó truyền link vào!
- Để cấu hình player, các bạn vào file Player.php, ở đấy mình đã chú thích đầy 
- Ở file LoadPlugins.php, nếu bạn chỉ sử dụng server Picasa thì hãy bỏ dòng
```sh
$Plugins_List[] = 'Class-Youtube.php';
```
đi để tránh include dư thừa
- Những file còn lại các bạn vui lòng không chỉnh sửa, nếu có nhu cầu muốn update thêm chức năng hay bất cứ thứ gì liên quan có thể inbox mình, nếu được mình sẽ update
- Vui lòng share source nhớ ghi rõ nguồn
- Nếu bạn bị lỗi khi get về từ github thì có thể download bản zip tại link này: http://goo.gl/b35aFx [Ver 3.0]
- Pass: VideoJs-JkeyCPHong-PHP (Nếu link chết vui lòng liên hệ với nick facebook bên dưới để update lại link)

####**Cập nhập:**
#####Version 3.0.0.0:
*- Cải tiến:*
<ul>
<li>CSS cho sub đẹp mắt ( *Nate Love* cung cấp )</li>
<li>Thêm chức năng download video tại player ( *Nate Love* cung cấp )</li>
<li>Hỗ trợ logo, poster</li>
<li>Hỗ trợ get link thêm 2 server: Google Photo và Dailymotion</li>
</ul>

*- Nhược điểm:*
<ul>
<li>Không hỗ trợ Flash</li>
<li>Chưa hỗ trợ caption sub</li>
</ul>

#####Version 2.0.0.2:
*- Cải tiến:*
<ul>
<li>Thêm cache time cho từng server</li>
<li>Thay đổi player (Do bạn *Nate Love* cung cấp)</li>
<li>Hỗ trợ sub</li>
<li>Fix lỗi http status code 500 trên một số site dùng phiên bản PHP thấp</li>
<li>Fix lại tùy chọn width và height trên một số site</li>
<li>Fix lại một số lỗi trong code</li>
</ul>

*- Nhược điểm:*
<ul>
<li>Không hỗ trợ flash</li>
<li>Chưa hỗ trợ caption cho sub</li>
<li>Và một số lỗi nhỏ khác</li>
</ul>

#####Version 2.0.0.1:
*- Cải tiến:*
<ul>
<li>Fix lại lỗi play youtube khi bật cache</li>
<li>Fix lại code</li>
</ul>

*- Nhược điểm:*
<ul>
<li>Chưa thể fix được lỗi chạy link Zing TV vì lý do bên site mình vẫn chạy ổn nhưng một số site khác thì có vấn đề nên chưa tìm ra hướng giải quyết</li>
<li>Xuất hiện lỗi 500 với một số site ( Chưa biết lý do nên chưa thể fix )</li>
<li>Không hiện chất lượng phim nếu sử dụng FLASH, để có thể hiển thị chất lượng trên FLASH thì phải đổi player, để khắc phục các bạn có thể chỉ cần chạy html5 thôi hoặc thay player, ngoài ra vẫn còn một số phương pháp khác mà mình chưa biết</li>
</ul>

#####Version 2.0.0.0:
*- Cải tiến:*
<ul>
<li>Thêm tùy chọn (flash, cache)</li>
<li>Tích hợp cache vào code, tùy chọn tắt hoặc mở cache</li>
<li>Hỗ trợ 3 server Picasa, Youtube, Zing TV</li>
<li>Hỗ trợ get link trung gian Zing TV với những host nước ngoài bị chặn IP</li>
<li>Thay đổi player cho đẹp mắt ( Được cung cấp bởi một bạn trên group facebook mà quên mất tên nên mình sẽ update lại sau )</li>
<li>Fix lại code và một số lỗi chính tả</li>
</ul>

*- Nhược điểm sau khi cải tiến:*
<ul>
<li>Không hiện chất lượng phim nếu sử dụng FLASH, để có thể hiển thị chất lượng trên FLASH thì phải đổi player, để khắc phục các bạn có thể chỉ cần chạy html5 thôi hoặc thay player, ngoài ra vẫn còn một số phương pháp khác mà mình chưa biết</li>
</ul>

#####Version 1.0.0.0:
- Thêm tùy chọn (css, js, quality, width, height, text, ...)
- Hỗ trợ server Picasa, Youtube

####**Tác giả:** Zhu Jin Feng

####**Facebook:** https://www.facebook.com/profile.php?id=100004989074517
