<?php
	//左侧菜单
	function getColumn($data){
		$arr = array();
		foreach ($data as $key => $vo) {
			if($vo['pid'] == 0){
				$auth=0;
				$vo['child']=getChild($data,$vo['id']);
				foreach($vo['child'] as $v){
					$auth = $v['auth']+$auth;
				}

				$vo['auth'] = 0;
				if($auth > 0 ){
					$vo['auth'] = 1;
				}

				if(empty($vo['child'])){
					$url = $vo['m']."/".$vo['c']."/".$vo['a'];
					$a = checkAuth($url);
					$vo['auth'] = $a;
				}
				$arr['column'][]=$vo;	
			}
		}

		$arr['module'] = CONTROLLER_NAME;

		return $arr;
	}


	function getChild($data,$pid){
		$child = array();
		foreach ($data as $key => $vo) {
			if ($vo['pid'] == $pid) {
				$url = $vo['m']."/".$vo['c']."/".$vo['a'];
				$vo['url']=U($url);
				$vo['auth']=checkAuth($url);
				//echo $url."<br>";
				$child[]=$vo;
			}
		}
		return $child;
	}

	//权限规则列表
	function getRules(){
		$arr = array();
		$rules = M("auth_rule")->order("pid,id")->select();
		$column = M("column")->where(array("pid"=>0))->field("id,name")->select();
		foreach ($column as $vo) {
			foreach($rules as $v){
				if($v['pid'] == $vo['id']){
					$vo['child'][]=$v;
				}
			}
			$arr[] = $vo;
		}
		return $arr;
	}


	function checkAuth($url){
		
	   $auth = new \Org\Util\Authority();
	   if(!$auth->getAuth($url,session('uid'))){
	   		return false;
	   }

	   return true;

	}

	function format_ids($arr){
		return implode(',', $arr);
	}