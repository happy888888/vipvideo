<?php
	class interface2
	{
		const apiurl = 'http://mimijiexi.top/';
		static public function get($url){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, self::apiurl."?url={$url}");
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
			curl_setopt($curl, CURLOPT_TIMEOUT, 60);
			$contents = curl_exec($curl);
			$error = curl_error($curl);
			curl_close($curl);
			if($error){
				return array('code'=>-1,'info'=>$error);
			}
			if($contents){
				$regex1="/\/m3u8-dp\.php\?url=(.*?)\">/";
				if(preg_match($regex1, $contents, $matches) == 0)
					return array('code'=>-1,'info'=>'unknown error');
				return array('code'=>0,'info'=>'OK','type'=>'hls','url'=>$matches[1]);
			}
			return array('code'=>-1,'info'=>'unknown error');
		}
	}
?>
