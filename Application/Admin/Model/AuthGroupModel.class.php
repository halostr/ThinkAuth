<?php
namespace Admin\Model;
use Think\Model;
/**
* 
*/
class AuthGroupModel extends Model
{
	
	protected $tableName = 'auth_group';

	protected $_auto = array(
		array('rules','format_ids',3,'function'),
	);



	protected $_validate = array(
		array('title','require','请填写用户组名称'),
		array('rules','check_rules','请选择用户组权限',1,'callback'),
	);

	function check_rules($arr){
		if(empty($arr)){
			return false;
		}
		return true;
	}

	public function save_data(){
		$arr  = array();
		if(!$this->create()){
			$arr['status'] = 0;
			$arr['inf'] = $this->getError();
			return $arr;
		}

		if(!I('post.id')){
			$save = $this->add();
		}else{
			$save = $this->save();
		}


		if(!$save){
			$arr['status'] = 0;
			$arr['inf'] = '操作失败';
		}else{
			$arr['status'] = 1;
			$arr['inf'] = '操作成功';
		}

		return $arr;
	}
}