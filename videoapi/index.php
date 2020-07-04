<?php
	require dirname(__FILE__).'/vip_video/Vip_video.php';
	function is_url($v){
		$pattern="#(http|https)://(.*\.)?.*\..*#i";
		return preg_match($pattern,$v);
	}

	header('Content-Type:application/json; charset=utf-8');
	/*if(!isset($_SERVER["HTTP_REFERER"])){
		header("HTTP/1.1 403 Forbidden");
		exit(json_encode(array('code'=>-1,'info'=>'Bad request')));
	}else{
		$url_array = parse_url($_SERVER["HTTP_REFERER"]); 
		if($_SERVER['HTTP_HOST'] != $url_array["host"]){ 
			header("HTTP/1.1 403 Forbidden");
			exit(json_encode(array('code'=>-1,'info'=>'Bad request')));
		}
	}*/
	$url = urldecode($_POST["url"]);
	if(!is_url($url))
		exit(json_encode(array('code'=>-1,'info'=>'unknown parameter')));
	exit(Vip_video::get($url))
?>