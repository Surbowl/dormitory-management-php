<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	//如果用户已经登录,直接跳转
	if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type'])){
		$user_type=$_SESSION['user_type'];
		header("Location: ../$user_type/home.php");
	}
	
	if($_POST){
		require './_share/_pdo.php';
		$account=$_POST['account'];
		$pwd=$_POST['pwd'];
		$captch=$_POST['captch'];
		$type=$_POST['type'];
		if(strtolower($captch)==strtolower($_SESSION['captcha'])){
			$type=$_POST['type'];
			if(!empty($account)&&!empty($pwd)&&!empty($type)){
				$sql="select id,name from t_$type where account='$account' and pwd='$pwd'";
				$result=$pdo->query($sql);
				$row=$result->fetch();
				$id=$row['id'];
				$name=$row['name'];
				if(!empty($id)){
					$_SESSION['user_id']=$id;
					$_SESSION['user_account']=$account;
					$_SESSION['user_type']=$type;
					$_SESSION['user_name']=$name;
					header("Location: ../$type/home.php");
				}else{
					$pwd=null;
					$msg="您输入的账号或密码有误，请重试";
				}
			}
		}else{
			$msg="您输入的验证码有误，请重试";
		}
	}

	require './view/login_html.php';
?>