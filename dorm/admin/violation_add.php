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
			
			require '../public/_share/_pdo.php';
			
			//处理表单提交
			if($_POST){
				$student_id=$_POST['id'];
				$date=$_POST['date'];
				$detail=$_POST['detail'];
				
				if(strtotime($date)>time()){
					echo "<script>alert('您选择的违规时间有误，请重试')</script>";
				}else{
					$sql="insert t_student_violation set student_id=? ,date=? ,detail=?";
					$stmt=$pdo->prepare($sql);
					$stmt->bindParam(1,$student_id);
					$stmt->bindParam(2,$date);
					$stmt->bindParam(3,$detail);
					if(!$stmt->execute())
					{
						exit("提交失败，请重试。".$stmt->errorInfo());
					}
					header('Location: ./violation.php');
				}
			}
			
			if(isset($_GET['id'])){ 
				$student_id=$_GET['id'];
				
				//获取学生详细信息
				$sql="select student_id,dorm_id,building,number,c.sex,account,name,supervisor
					from t_student_dorm as a join t_dorm as b on a.dorm_id=b.id join t_student as c on c.id=a.student_id
					where c.id=$student_id";
				$result=$pdo->query($sql);
				$student_detail=$result->fetch();
			}else{
				//如果没有传入学生id,跳转到搜索学生页面
				header("Location: ./student.php?func=违规登记");
			}
			
			require './view/violation_add_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>