<?php
/**
* 
*/
namespace Admin\Controller;
use Admin\Controller\BaseController;
class CommonController extends BaseController
{
	public function _initialize(){

		if(!session('uid')){
			$this->redirect('Auth/login');
		}

		//权限检测
	  	$auth=new \Think\Authority();
	
		$rule =  MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;

   	   	if(!$auth->getAuth($rule,session('uid'))){
   	   		$this->inf = '你所属用户组还没有该权限!';
   	   		if(IS_AJAX){
   	   			$this->error($this->inf);
   	   		}
			$this->display("Public:auth");
			exit();

       	}
   	   
   	   
		$columnData = $this->column();
		$this->column = $columnData['column'];
		$this->nowModule = $columnData['module'];
		$this->location = $this->location();
		

	}

	//左侧菜单
	private function column(){
		F("column",null);
		$db = M("column");
		if(!F("column")){
			$data = $db->where(array("status"=>1))->order("pid,level")->select();
			F('column',$data);
		}else{
			$data = F('column');
		}
		$data = getColumn($data);
		return $data;
	}

	//当前位置
	private function location(){

		$column = M("column");
		if(!F("column")){
			$data = $db->where(array("status"=>1))->order("pid,level")->select();
			F('column',$data);
		}else{
			$data = F('column');
		}
		$cat    = new \Org\Util\Category(array('id','pid','name','cname'));

		$group = MODULE_NAME;
		$module= CONTROLLER_NAME;
		$action = ACTION_NAME;
		$path = $column->where(array("m"=>$group,"c"=>$module,"a"=>$action))->find();
		
		$s=$cat->getPath($data,$path['id']);
		$count = count($s);
		foreach($s as $vo){
			$count--;
			$arr[]=$s[$count];
		}

		return $arr;
		
	}
}