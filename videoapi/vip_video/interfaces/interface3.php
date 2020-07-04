<?php
	class interface3
	{
		const apiurl = 'https://jx.wxtv.net/api.php';
		static public function get($url){
			$data = ['url'=>$url];
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, self::apiurl);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
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
				$result = json_decode($contents);
				return array('code'=>0,'info'=>'OK','type'=>$result->type,'url'=>$result->url);
				}
			return array('code'=>-1,'info'=>'unknown error');
		}
	}
?>
