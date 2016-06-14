<?php

function check_auth($rule){
	
   	$auth=new \Think\Authority();
	
   	if(!$auth->getAuth($rule,session('uid'))){
   		return false;
	}

	return true;
}