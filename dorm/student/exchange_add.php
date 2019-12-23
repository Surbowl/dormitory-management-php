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
			
			//获取当前宿舍信息
			$dorm_building=$_SESSION['dorm_building'];
			$dorm_number=$_SESSION['dorm_number'];
			
			if($_POST){
				//目标宿舍的信息
				$to_dorm_building=$_POST['building'];
				$to_dorm_number=$_POST['number'];
				//换宿舍的原因
				$request=$_POST['request'];
				if($to_dorm_building==$dorm_building&&$to_dorm_number==$dorm_number){
					echo "<script>alert('您当前已在此宿舍')</script>";
				}else{
					require '../public/_share/_pdo.php';
					
					$sql="select id from t_dorm where building='$to_dorm_building' and number='$to_dorm_number'";
					$result=$pdo->query($sql);
					$row=$result->fetch();
					$to_dorm_id=$row['id'];
					if(empty($to_dorm_id)){
						echo "<script>alert('目标宿舍不存在，请核对。')</script>";
					}else{
						$sql="insert into t_student_dorm_exchange(`student_id`,`to_dorm_id`,`request`) values($user_id,?,?)";
						$stmt=$pdo->prepare($sql);
						$stmt->bindParam(1,$to_dorm_id);
						$stmt->bindParam(2,$request);
						if(!$stmt->execute())
						{
							exit("申请失败，请重试。".$stmt->errorInfo());
						}
						header('Location: ./exchange.php');
					}
				}
			}
			
			require './view/exchange_add_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>