<?php
	spl_autoload_register(function($name){
		if(substr($name, 0, 9) == 'interface')
			if(file_exists(dirname(__FILE__).'/interfaces/'.$name.'.php'))
				require dirname(__FILE__).'/interfaces/'.$name.'.php';
	});

	function httpcode($url){
		$ch = curl_init();
		$timeout = 4;
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $code;
	}

	class Vip_video
	{
		static public function get($url){
			$num = 1;
			$name = 'interface'.$num;
			while(class_exists($name)){
				$r = $name::get($url);
				if($r['code'] == 0){
					if(substr($r['url'], 0, 2) == '//'){
						/*$u = 'http:'.$r['url'];
						if(httpcode($u) != 0){
							$r['url'] = $u;
							return json_encode($r);
						}*/
						$u = 'https:'.$r['url'];
						if(httpcode($u) != 0){
							$r['url'] = $u;
							return json_encode($r);
						}
					}else{
						if(httpcode($r['url']) != 0)
							return json_encode($r);
					}
				}
				$num++;
				$name = 'interface'.$num;
			}
			return json_encode(array('code'=>-1,'info'=>'unknown error'));
		}
	}
?>