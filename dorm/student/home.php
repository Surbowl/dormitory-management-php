<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type'])){
		$user_type=$_SESSION['user_type'];
		if($user_type!="student"){
			//非学生用户不允许访问学生平台
			header("Location: ../$user_type/home.php");
		}else{
			$user_account=$_SESSION['user_account'];
			$user_name=$_SESSION['user_name'];
			$user_id=$_SESSION['user_id'];
			//获取学生的宿舍信息
			require '../public/_share/_pdo.php';
			$sql="select * from t_student_dorm where dorm_id=(select dorm_id from t_student_dorm where student_id=$user_id)";
			$result=$pdo->query($sql);
			$row=$result->fetch();
			$dorm_id=$row['dorm_id'];
			$is_supervisor=$row['supervisor']=="y"?"是":"否";
			if(!empty($dorm_id)){
				//获取宿舍详细信息
				$sql="select * from t_dorm where id=$dorm_id";
				$result=$pdo->query($sql);
				$row=$result->fetch();
				$dorm_building=$row["building"];
				$dorm_number=$row["number"];
				$_SESSION['dorm_id']=$dorm_id;
				$_SESSION['dorm_building']=$dorm_building;
				$_SESSION['dorm_number']=$dorm_number;
			}
			require './view/home_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>