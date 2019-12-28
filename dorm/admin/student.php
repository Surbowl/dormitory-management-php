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
			
			//搜索学生页面被其他模块调用时，有多种形态
			if(isset($_GET['func'])){
				$html_func=$_GET['func'];
			}
			
			//接收关键词并搜索
			if(isset($_GET['keyword'])){ 
				$keyword=$_GET['keyword'];

				require '../public/_share/_pdo.php';
				
				//处理分页
				$page_size=5;
				$result=$pdo->query("select count(*) from t_student where name like '%$keyword%' or account like '%$keyword%'");
				$count=$result->fetch()[0];
				$max_page=ceil($count/$page_size);
				$page=isset($_GET['page']) ? intval($_GET['page']) : 1;
				$page=$page>$max_page ? $max_page : $page;
				$page=$page < 1 ? 1 : $page;
				$lim=($page -1)*$page_size;

				$sql="select student_id,dorm_id,building,number,c.sex,account,c.name as student_name,d.name as class_name
					from t_student_dorm as a right join t_dorm as b on a.dorm_id=b.id right join t_student as c on c.id=a.student_id left join t_class as d on d.id=c.class_id
					where c.name like '%$keyword%' or account like '%$keyword%'
					limit $lim,$page_size";
				$result=$pdo->query($sql);
				$student_list=$result->fetchAll();
			}
			
			require './view/student_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>