<?php
Class ZingTV
{
	Private $link;

	Function __construct($Url) {
		$this->link = 'http://getlinkfs.com/getfile/zingtv.php?link=' . $Url;
	}

	private function view_source(){
		$timeout = 15;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->link);
		curl_setopt($ch, CURLOPT_HTTPGET,true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING , 'gzip, deflate');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		$result = curl_exec($ch);
		if(curl_errno($ch)){
			return false;
		}else{
			return $result;
		}
	}

	Public Function _Get()
	{
		$Source =  $this->view_source();
		preg_match_all('#http://(.*?)/streaming/(.*?)format=f([0-9]+)&device=other#', $Source, $Match);
		foreach ($Match[0] as $value) {
				if (strpos($value, 'format=f360')) {
					$m360 = $value;
				} elseif (strpos($value, 'format=f480')) {
					$m480 = $value;
				} elseif (strpos($value, 'format=f720')) {
					$m720 = $value;
				} else {
					return 'Not support';
				}
		}
			if (isset($m720, $m480, $m360)) {
				$js = '<source data-res="720" src="' . $m720 . '" type="video/mp4" />
                       <source data-res="480" src="' . $m480 . '" type="video/mp4" />
                       <source data-res="360" src="' . $m360 . '" type="video/mp4" />';
			} elseif (isset($m720, $m360)) {
				$js = '<source data-res="720" src="' . $m720 . '" type="video/mp4" />
                       <source data-res="360" src="' . $m360 . '" type="video/mp4" />';
			} elseif (isset($m480, $m360)) {
				$js = '<source data-res="480" src="' . $m480 . '" type="video/mp4" />
                       <source data-res="360" src="' . $m360 . '" type="video/mp4" />';
			} elseif (isset($m360)) {
				$js = '<source data-res="360" src="' . $m360 . '" type="video/mp4" />';
			}
		return $js;
	}
}
?>
