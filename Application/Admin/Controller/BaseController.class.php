<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class BaseController extends Controller
{


	protected function sys($inf,$url,$type = 1){

		if($inf['status'] == 0){
			$this->error($inf['inf']);
		}

		if($type == 1){
			$this->success($inf['inf'],U($url));
		}else{
			$this->redirect($url);
		}
		
	}
}