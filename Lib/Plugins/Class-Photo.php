<?php

### Nguồn: Sưu tầm ###

Class GooglePhoto
{
	Private $__Link;
	
	Function __construct($Url)
	{
		if (!empty($Url)) {
			$Check = preg_match('/^https:\/\/photos.google.com\/share\/(.*?)\/photo\/(.*?)\?key=(.*?)$/', $Url);
			$this->__Link = $Url;
		}
	}

	Private Function Curl($Url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		$head[] = "Connection: keep-alive";
		$head[] = "Keep-Alive: 300";
		$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$head[] = "Accept-Language: en-us,en;q=0.5";
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		$page = curl_exec($ch);
		if (!$page) {
			die('Không thể lấy dữ liệu từ Goolge Photo');
		}
		curl_close($ch);
		return $page;
	}

	Public function get(){
		$get = $this->Curl($this->__Link);
		$data = explode('url\u003d', $get);
		$url = explode('%3Dm', $data[1]);
		$decode = urldecode($url[0]);
		$count = count($data);
		$Js = '';
		if($count > 4) {
			$Js .= '<source data-res="360p" src="' . $decode . '=m18" type="video/mp4" />';
			$Js .= '<source data-res="720p" src="' . $decode . '=m22" type="video/mp4" />';
			$Js .= '<source data-res="1080p" src="' . $decode . '=m37" type="video/mp4" />';
	    }
	    elseif($count > 3) {
	       	$Js .= '<source data-res="360p" src="' . $decode . '=m18" type="video/mp4" />';
			$Js .= '<source data-res="720p" src="' . $decode . '=m22" type="video/mp4" />';
	    }
	    elseif($count > 2) {
	        $Js .= '<source data-res="360p" src="' . $decode . '=m18" type="video/mp4" />';
	    }
	    return $Js;
	}
}
?>
