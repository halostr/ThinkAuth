<?php
//权限模块
namespace Admin\Controller;
use Think\Controller;
class RbacController extends CommonController{

	//权限列表
	public function index(){
		$col_inf = array('name'=>"权限列表");	
		$this->col_inf = $col_inf;
		$rule = M("auth_rule");
		$count = $rule->count();
		$page = new \Think\Page($count,12);
		$rules = $rule->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
		$show = $page->show();
		$this->count = $count;
		$this->show = $show;
		$this->rules = $rules;
		$this->display();
	}

	

	public function groupDel(){
		if (IS_POST) {
			$id = intval(I("post.id"));
			$del = M("auth_group")->where(array("id"=>$id))->delete();
			if(!$del){
				$this->error("删除出错");
			}
			$this->success("删除成功");
		}
	}
	
	public function rulesDel(){
		if(IS_POST){
			$inf = D("AuthRule")->del_rule();
			self::sys($inf);
		}
		
	}

	public function rules_info(){
		if(IS_POST){
			$inf = D("AuthRule")->save_data();
			self::sys($inf);
		}else{
			$col_inf = array('name'=>"规则信息");	
			$this->col_inf = $col_inf;
			$id =intval(I("get.id")) ;
			if($id){
				$info = M("auth_rule")->where(array("id"=>$id))->find();
				$this->inf = $info;
			}
			$this->display();
		}
		
	}

	public function group_info(){
		if(IS_POST){
			$inf = D("AuthGroup")->save_data();
			self::sys($inf);
		}else{
			$col_inf = array('name'=>"用户组信息");	
			$this->col_inf = $col_inf;
			$id = I("get.id");
			if($id){
				$info = M("auth_group")->where(array("id"=>$id))->find();
				$rules = explode(",",$info['rules']);
				$this->rules = $rules;
				$this->inf = $info;
				
			}
			$arr = getRules($column,$rules);
			$this->arr = $arr;
			$this->display();
		}
		
	}

	public function group_list(){
		$col_inf = array('name'=>"用户组列表");	
		$this->col_inf = $col_inf;
		$group = D("AuthGroup")->select();
		$this->group = $group;
		$this->display();
	}
}
?>