<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type'])){
		$user_name=$_SESSION['user_name'];
		$user_id=$_SESSION['user_id'];
		$user_type=$_SESSION['user_type'];
		
		if($_POST){
			
			$old_pwd=$_POST['old_pwd'];
			$new_pwd=$_POST['new_pwd'];
			$check_pwd=$_POST['check_pwd'];
			
			if($new_pwd!=$check_pwd){
				$msg="两次输入的新密码不一致，请核对";
				
			}else{
				require './_share/_pdo.php';
				
				//判断用户输入的旧密码是否正确
				$sql="select pwd from t_$user_type where id=$user_id";
				$result=$pdo->query($sql);
				$pwd=$result->fetch()['pwd'];
				
				if($old_pwd!=$pwd){
					$msg="您输入的旧密码有误，请核对";
					
				}else if($new_pwd==$pwd){
					$msg="旧密码不能与新密码相同";
					
				}else{
					$sql="update t_$user_type set pwd='$new_pwd'";
					if(!$pdo->query($sql)){
						exit("密码修改失败，请重试。".$stmt->errorInfo());
					}
					echo "<script>alert('新密码设置成功。');</script>";
				}
			}
		}
		
	}else{
		//如果用户未登录,跳转到登录界面
		header("Location: ./logout.php");
	}

	require './view/changepwd_html.php';
?>