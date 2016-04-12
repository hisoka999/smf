<?php
class Bootstrap {
	function __construct($url) {
		global $config;
		$urls = $this->parse_url($url);
		if (isset($urls[0]) && $urls[0] != null){
			$contr = $urls[0];
		}else{
			$contr = 'index';
		}
		$filename = 'controller/'.$contr.'.php';
		DBModel::initDB($config['DB_CONF']['PRODUCTION']);
		if (file_exists($filename)){
			require $filename;
			$class = ucfirst($contr);
			$controller = new $class();
			if (isset($urls[1])){
				if(isset($urls[2]))
					$controller->{$urls[1]}($urls[2]);
				else
					$controller->{$urls[1]}();
			}else{
				$controller->call_default();
			}
			
		}
		
		
	}

	private function parse_url($url)
	{
		$url = rtrim($url,'/');
		$urls = explode('/',$url);
		return $urls;
	}
}