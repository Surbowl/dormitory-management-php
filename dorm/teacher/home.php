<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type'])){
		$user_type=$_SESSION['user_type'];
		if($user_type!="teacher"){
			//非教师用户不允许访问教师平台
			header("Location: ../$user_type/home.php");
		}else{
			//获取教师信息
			$user_account=$_SESSION['user_account'];
			$user_name=$_SESSION['user_name'];
			$user_id=$_SESSION['user_id'];
			
			//获取班级信息
			require '../public/_share/_pdo.php';
			$sql="select * from t_class where teacher_id=$user_id";
			$result=$pdo->query($sql);
			$class_list=$result->fetchAll();
			require './view/home_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>