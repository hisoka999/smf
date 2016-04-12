<?php
class BaseView {
	
	function __construct() {
		
	}
	
	public function render($name,$args = array())
	{
		extract($args);
		require 'views/'.$name.'.view.php';
		
	}
}