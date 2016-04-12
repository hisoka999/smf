<?php
class UrlHelper {
	
	public static function generate($path,$params = array()){
		global $config;
		
		$para = implode('/', $params);
		if(strlen($para) > 0)
			$para = '/'.$para;
		
		$path = $config['PATHS']['BASE_URL'].$path.$para;
		return $path;
	}
	
}