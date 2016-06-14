<?php
/**
* 
*/
namespace Admin\Model;
use Think\Model\RelationModel;
class AdminModel extends RelationModel
{
	protected $tableName = "admin";

	protected $_auto = array(
		 array('pwd','md5',3,'function') , 
	);

	protected $_link = array(
	 	'group'=> array(  
	     'mapping_type'=>self::BELONGS_TO ,
	          'class_name'=>'auth_group',
	          'foreign_key'=>'gid',
	          'mapping_name'=>'group',
	          
	 	),
 	);

 	protected $_validate = array(

		array('gid',"require","请选择用户组"),
		array('title','require','请输入名称'),
		array('name','require','请输入账号',0),
		array('name','','此账号已经存在！',0,'unique',1),

		array('pwd','require','请输入密码',1,'',1), 
		array('repassword','require','请再次输入密码',1,'',1), 
		array('repassword','pwd','密码不一样',1,'confirm',1),

		array('pwd','require','请输入密码',2,'',2), 
		array('repassword','require','请再次输入密码',2,'',2), 
		array('repassword','pwd','密码不一样',2,'confirm',2),

		array('status',"require","请选择状态"),

	);

	
	public function getUserInfo($uid,$type){
		$info = $this->where(array("id"=>$uid))->find();
		return $info[$type];
	}

	/**
	 * 获取管理用户列表
	 * @return [type] [description]
	 */
	public function get_admin($gid = 0){
		$arr = array();
		$map['type'] = 2;
		$map['gid'] = $gid;
		$arr = $this->where($map)->field("pwd",true)->select();
		return $arr;
	}

	public function do_login(){
		$arr = array();
		$name = I('post.name','','');
		$pwd  = md5(I('post.pwd','',''));
		$inf  = $this->where(array('name'=>$name,'pwd'=>$pwd))->find();
		if(!$inf){
			$arr['status'] = 0;
			$arr['inf'] = '账号或密码错误';
			return $arr;
		}
		session('uid',$inf['id']);
		$arr['status'] = 1;
		$arr['inf'] = '登录成功';
		return $arr;
		
	}

	public function get_inf($id = 0){
		$arr = array();
		$arr = $this->relation(true)->find($id);
		return $arr;
	}

	public function get_group_list(){
		if(!F("group_list")){
			$data = M('auth_group')->select();
			F("group_list",$data);
		}
		else{
			$data = F('group_list');
		}
		return $data;
	}

	public function save_user_inf(){
		$arr = array();
		if(!$this->create()){
			$arr['status'] = 0;
			$arr['inf'] = $this->getError();
			return $arr;
		}

		if(!I('post.id')){
			$save = $this->add();
			$add['uid'] = $save;
			$add['group_id'] = I('post.gid');
			$saves = M('auth_group_access')->add($add);
		}else{
			$uid = I('post.id');
			$save = $this->save();
			$saves = M('auth_group_access')->where(array('uid'=>$uid))->save(array('group_id'=>I('post.gid')));
		}

		if(!$save){
			$arr['status'] = 0;
			$arr['inf'] = '操作出错';
		}else{
			$arr['status'] = 0;
			$arr['inf'] = '操作成功';
		}

		return $arr;
	}

}