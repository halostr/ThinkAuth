<?php
namespace Admin\Model;
use Think\Model;
/**
* 
*/
class AuthRuleModel extends Model
{
	protected $tableName = 'auth_rule';

	protected $_validate = array(

		array('title',"require","请填写规格描述",1),
		array('pid',"require","请选择所属模块",1),
		array('name',"require","请填写唯一标识",1),
	);

	public function save_data(){
		$arr = array();
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

	public function del_rule(){
		$id = I('post.id');
		$save = $this->delete($id);
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