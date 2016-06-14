<?php
/**
* 
*/
namespace Admin\Controller;
use Admin\Controller\BaseController;
class AuthController extends BaseController
{
	public function login(){
		if(IS_POST){
			$inf = D("Admin")->do_login();
			$this->sys($inf,"Admin/Index/index",2);
		}else{
			$this->display();
		}
	}

	public function signout(){
		session(null);
		$this->redirect('Auth/login');
	}
}