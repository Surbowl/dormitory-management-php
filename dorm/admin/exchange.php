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
			$result=$pdo->query("select count(*) from t_student_dorm_exchange");
			$count=$result->fetch()[0];
			$max_page=ceil($count/$page_size);
			$page=isset($_GET['page']) ? intval($_GET['page']) : 1;
			$page=$page>$max_page ? $max_page : $page;
			$page=$page < 1 ? 1 : $page;
			$lim=($page -1)*$page_size;
			
			$sql="select a.id,a.date,admin_response,a.student_id,a.to_dorm_id,d.dorm_id as from_dorm_id,name,account,c.building as to_dorm_building,c.number as to_dorm_number,e.building as from_dorm_building,e.number as from_dorm_number,e.id as from_dorm_id
				from t_student_dorm_exchange as a left join t_student as b on a.student_id=b.id left join t_dorm as c on a.to_dorm_id=c.id left join t_student_dorm as d on d.student_id=b.id left join t_dorm as e on e.id=d.dorm_id
				order by a.id desc limit $lim,$page_size";
			$result=$pdo->query($sql);
			$exchange_list=$result->fetchAll();
			
			require './view/exchange_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>