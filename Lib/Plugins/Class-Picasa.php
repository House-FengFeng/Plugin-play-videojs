<?php

### Update version 2.0.0.2 ###
### Tác giả: Jkey C Phong ###
### Khi đem class public vui lòng giữ lại header này!###

Class Picasa {
	private $link;
	private $type;
	private $obj_array;
	public function __construct($link) {
		$this->link = $link;
		$this->type = $this->check_link();
		$this->obj_array = $this->get_json($this->get_xml_link());
	}
	
	private function check_link(){
	if (preg_match('/directlink/', $this->link)){
		return 1;
	}else {
		return 2;
	}
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
	
	private function get_xml_link(){
		$source = $this->view_source($this->link);
		if (!$source){
			echo 'Không thể lấy dữ liệu';
			exit();
		}
		$xml_link = '';
		switch ($this->type){
			case 1:
				$xml_link = explode('"application/atom+xml","href":"', $source)[1];
				$xml_link = explode('"}', $xml_link)[0];
				break;
			case 2:
				$start = strpos($source, 'https://picasaweb.google.com/data/feed/base/user/');
				$end = strpos($source, '?alt=');
				$xml_link = substr($source, $start, $end - $start);
				$photoid = trim(explode('#', $this->link)[1], ' ');
				$xml_link .= '/photoid/' . $photoid . '?alt=jsonm&authkey=';
				$xml_link .= explode('#', explode('authkey=', $this->link)[1])[0];
				$xml_link = str_replace('base', 'tiny', $xml_link);
				break;
		}
		return $xml_link;
	}
	
	private function get_json($xml_link){
		$sourceJson = file_get_contents($xml_link);
		$decodeJson = json_decode($sourceJson);
		return $decodeJson->feed->media->content;
	}
 
	private function get_720p_mp4(){
		for ($i = count($this->obj_array) - 1; $i >= 0; $i--){
			if ( $this->obj_array[$i]->type == 'video/mpeg4'){
				return $this->obj_array[$i]->url;
			}
		}
	}
	
	private function get_480p_mp4(){
		for ($i = 0; $i < count($this->obj_array); $i++){
			if ( $this->obj_array[$i]->type == 'video/mpeg4'){
				return $this->obj_array[$i]->url;
			}
		}
	}

	public function _get()
	{
		$Data = array();
		$Data[0] = $this->get_480p_mp4();
		$Data[1] = $this->get_720p_mp4();
		if(strpos($Data[1],'=m18')) {
			unset($Data[1]);
			$Js = '<source data-res="360p" src="' . $Data[0] . '" type="video/mp4" />';
		}
		else {
			$Js = '<source data-res="720p" src="' . $Data[1] . '" type="video/mp4" /><source data-res="360p" src="' . $Data[0] . '" type="video/mp4" />';
		}
		return $Js;
	}
}
?>
