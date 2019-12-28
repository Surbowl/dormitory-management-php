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
				$maintain_id=$_POST['id'];
				$response=$_POST['response'];

				$sql="update t_dorm_maintain set admin_response=? where id=?";
				$stmt=$pdo->prepare($sql);
				$stmt->bindParam(1,$response);
				$stmt->bindParam(2,$maintain_id);
				if(!$stmt->execute())
				{
					exit("提交失败，请重试。".$stmt->errorInfo());
				}
				header('Location: ./maintain.php');
			}
			
			$maintain_id=$_GET['id'];
			if(empty($maintain_id)){
				//如果没有$maintain_id参数就返回maintain列表
				header('Location: ./maintain.php');
			}
			
			$sql="select a.id,date,request,admin_response,building,number
				from t_dorm_maintain as a join t_dorm as b on a.dorm_id=b.id 
				where a.id=$maintain_id";
			$result=$pdo->query($sql);
			$maintain_detail=$result->fetch();
			
			require './view/maintain_detail_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>