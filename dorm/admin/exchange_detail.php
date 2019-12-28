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
			
			$exchange_id=$_GET['id'];
			if(empty($exchange_id)){
				//如果没有$exchange_id参数就返回exchange列表
				header('Location: ./exchange.php');
			}
			
			//处理表单提交
			if($_POST){
				//表单Post有两种功能,根据func字段判断
				$func=$_POST['func'];
				if($func=="移至目标宿舍"){
					$student_id=$_POST['student_id'];
					$to_dorm_id=$_POST['to_dorm_id'];
					
					$sql="delete from t_student_dorm where student_id=?;
						insert into t_student_dorm(student_id,dorm_id,supervisor) values(?,?,'否')";
					$stmt=$pdo->prepare($sql);
					$stmt->bindParam(1,$student_id);
					$stmt->bindParam(2,$student_id);
					$stmt->bindParam(3,$to_dorm_id);
					if(!$stmt->execute())
					{
						exit("提交失败，请重试。".$stmt->errorInfo());
					}
					//echo "<script>alert('成功移入目标宿舍');</script>";
					//不用header强制刷新一次的话,会莫名其妙报错
					header("Location: ./exchange_detail.php?id=$exchange_id");
					
				}else{
					$exchange_id=$_POST['id'];
					$admin_response=$_POST['response'];
					
					$sql="update t_student_dorm_exchange set admin_response=? where id=?";
					$stmt=$pdo->prepare($sql);
					$stmt->bindParam(1,$admin_response);
					$stmt->bindParam(2,$exchange_id);
					if(!$stmt->execute())
					{
						exit("提交失败，请重试。".$stmt->errorInfo());
					}
				}
			}
			
			
			
			$sql="select a.id,a.date,request,teacher_response,admin_response,a.student_id,a.to_dorm_id,d.dorm_id as from_dorm_id,name,account,c.building as to_dorm_building,c.number as to_dorm_number,e.building as from_dorm_building,e.number as from_dorm_number,e.id as from_dorm_id
				from t_student_dorm_exchange as a right join t_student as b on a.student_id=b.id left join t_dorm as c on a.to_dorm_id=c.id left join t_student_dorm as d on d.student_id=b.id left join t_dorm as e on e.id=d.dorm_id
				where a.id=$exchange_id";
			$result=$pdo->query($sql);
			$exchange_detail=$result->fetch();
			
			require './view/exchange_detail_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>