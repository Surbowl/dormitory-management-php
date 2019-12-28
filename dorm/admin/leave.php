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
			
			//处理分页
			$page_size=5;
			$result=$pdo->query("select count(*) from t_student_leave");
			$count=$result->fetch()[0];
			$max_page=ceil($count/$page_size);
			$page=isset($_GET['page']) ? intval($_GET['page']) : 1;
			$page=$page>$max_page ? $max_page : $page;
			$page=$page < 1 ? 1 : $page;
			$lim=($page -1)*$page_size;
			
			$sql="select a.student_id,request,date_start,date_end,account,b.name,building,number,c.dorm_id
				from t_student_leave as a join t_student as b on a.student_id=b.id join t_student_dorm as c on b.id=c.student_id join t_dorm as d on c.dorm_id=d.id
				where teacher_response='批准'
				order by date_end desc limit $lim,$page_size";
			$result=$pdo->query($sql);
			$leave_list=$result->fetchAll();
			
			require './view/leave_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>