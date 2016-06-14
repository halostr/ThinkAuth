<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
    	$this->display();
		// $redis = new \Redis();
		// $redis->connect('127.0.0.1', 6379);
		// //$len = $redis->lSize('queue');
		
		// Vendor("phpmailer.phpmailer");
		// while (true) {
		//  // 读取一个队列任务
		//  $task = $redis->brPop('queue', 10);
		//  // 获取队列任务的信息
		//  if ($task) {
		//     list ($name, $id)  = $task;
		//  }
		//  $data = explode(':', $task[1]);
		 
		//  if(empty($data)){
		//  	exit('no-data');
		//  }
		
    	
		// 	try {
		// 		$mail = new \PHPMailer(true); 
		// 		$mail->IsSMTP();
		// 		$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
		// 		$mail->SMTPAuth   = true;                  //开启认证
		// 		$mail->Port       = 25;                    
		// 		$mail->Host       = "smtp.163.com"; 
		// 		$mail->Username   = "ivwqrsf@163.com";    
		// 		$mail->Password   = "1255900858ecw//";            
		// 		//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
		// 		$mail->AddReplyTo("ivwqrsf@163.com","mckee");//回复地址
		// 		$mail->From       = "ivwqrsf@163.com";
		// 		$mail->FromName   = "www.substr.cn";
		// 		$to = $data[0];
		// 		$mail->AddAddress($to);
		// 		$mail->Subject  = $data[1];
		// 		$mail->Body = "<h1>phpmail演示</h1>这是php点点通（<font color=red>www.phpddt.com</font>）对phpmailer的测试内容";
		// 		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
		// 		$mail->WordWrap   = 80; // 设置每行字符串的长度
		// 		//$mail->AddAttachment("f:/test.png");  //可以添加附件
		// 		$mail->IsHTML(true); 
		// 		$mail->Send();
		// 		echo 'ok';
		// 	} catch (phpmailerException $e) {
		// 		//echo "error".$e->errorMessage();
		// 	}
		// }
		  
    }

    

    public function test(){

    	$redis = new \Redis();
		$redis->connect('127.0.0.1', 6379);
		$len = $redis->lSize('queue');
		for ($i=0; $i <5 ; $i++) { 
			$len++;
			$redis->lPush('queue', '758861884@qq.com:'.'hello world'.$len);
		}
    	$ch = curl_init("http://localhost/think3/index.php/Home/Index/index") ;  
		curl_setopt($ch, CURLOPT_TIMEOUT, 1) ; // 获取数据返回  

		curl_exec($ch) ;  
		  

    }
}