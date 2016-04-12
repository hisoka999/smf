<?php
class BaseController {
	protected $view = null;
	private $default;
	function __construct($default= null) {
		$this->view = new BaseView();
		$this->default = $default;
	}
	
	public function call_default(){
		if (!is_null($this->default))
			$this->{$this->default}();
	}
}