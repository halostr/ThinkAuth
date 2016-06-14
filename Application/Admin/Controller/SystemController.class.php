<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
/**
* 
*/
class SystemController extends CommonController
{
	
	public function index(){
		$col_inf = array('name'=>"账号列表");
		$db = D("Admin");
		$uid = session("uid");
		$data = $db->relation(true)->select();
		$this->data = $data;
		$this->col_inf = $col_inf;

		$this->display();
	}

	public function user_info(){
		$col_inf = array('name'=>"账号信息");	
		$this->col_inf = $col_inf;
		$Admin = D('Admin');
		if(IS_POST){
			$inf = $Admin->save_user_inf();
			$this->sys($inf);
		}else{
			$uid = I('get.id');
			$inf = $Admin->get_inf($uid);	
			$group = $Admin->get_group_list();
			$this->group = $group;
			$this->inf = $inf;
			$this->display();

		}
		
	}
	public function delUser(){
		if(IS_POST){
			$uid = session("uid");
			$id = $this->_post("id");

			if(is_numeric($id && $uid != $id)){
				if($id ==1){
					$this->error("不能删除超级管理账号");
				}
				M("admin")->where(array("id"=>$id))->save(array("status"=>-1));
				M("auth_group_access")->where(array("uid"=>$id))->delete();
				$this->success("删除成功");
			}
			$this->error("你不能删除自己");
		}
	}

}