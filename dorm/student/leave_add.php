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
			//获取学生信息
			$user_account=$_SESSION['user_account'];
			$user_name=$_SESSION['user_name'];
			$user_id=$_SESSION['user_id'];
			
			if($_POST){
				$date_start=$_POST['date_start'];
				$date_end=$_POST['date_end'];
				$request=$_POST['request'];
				if(strtotime($date_start)<time()){
					echo "<script>alert('起始时间应大于当前时间')</script>";
				}else if(strtotime($date_end)<=strtotime($date_start)){
					echo "<script>alert('返校时间应大于起始时间')</script>";
				}else{
					require '../public/_share/_pdo.php';
					$sql="insert into t_student_leave(`student_id`,`date_start`,`date_end`,`request`) values($user_id,?,?,?)";
					$stmt=$pdo->prepare($sql);
					$stmt->bindParam(1,$date_start);
					$stmt->bindParam(2,$date_end);
					$stmt->bindParam(3,$request);
					if(!$stmt->execute())
					{
						exit("申请失败，请重试。".$stmt->errorInfo());
					}
					header('Location: ./leave.php');
				}
			}
			
			require './view/leave_add_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>