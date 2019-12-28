<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type'])){
		$user_type=$_SESSION['user_type'];
		if($user_type!="admin"){
			//非管理员用户不允许访问管理员平台
			header("Location: ../$user_type/home.php");
		}else{
			if(isset($_GET['id'])){ 
				$student_id=$_GET['id'];
				
				require '../public/_share/_pdo.php';

				$sql="select student_id,dorm_id,building,number,supervisor,c.sex,c.account,c.name as student_name,d.name as class_name,department,e.name as teacher_name
					from t_student_dorm as a right join t_dorm as b on a.dorm_id=b.id right join t_student as c on c.id=a.student_id right  join t_class as d on d.id=c.class_id right join t_teacher as e on d.teacher_id=e.id
					where c.id=$student_id";
				$result=$pdo->query($sql);
				$student_detail=$result->fetch();
			}else{
				header('Location: ./student.php');
			}
			
			require './view/student_detail_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>