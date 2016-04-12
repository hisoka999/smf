<?php 


class UserModel extends DBModel{
	
	public $username;
	public $userid;
	
	function __construct(){
		parent::__construct();
		$this->setFieldProperty("username", "required",true);
		$this->setFieldProperty("userid", "type","integer");
	}

}
UserModel::$tablename = "sbb_user";
UserModel::$pk = 'userid';