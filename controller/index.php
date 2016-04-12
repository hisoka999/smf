<?php
class Index extends BaseController {
	public function __construct() {
		parent::__construct('main');
	}
	
	public function main(){
		// load all users
		$data = [];
		$data['users'] = UserModel::all();
		// User::objects::all();
		$model = new UserModel();
		$model->username = "test";
		$model->userid = 123;
		echo gettype ($model->userid);
		$model->save();
		
		$this->view->render('index/main',$data);
	}
	
	
	public function user($id)
	{
		$user = UserModel::get($id);
		$data['user'] = $user;
		$this->view->render('index/user',$data);
	}
	
}