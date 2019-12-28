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
			
			//处理排序
			//默认order by building
			$sql_order="building";
			if(isset($_GET['order'])){
				$order=$_GET['order'];
				switch($order){
					case "building_desc":
						$sql_order="building desc";
						break;
					case "number":
						$sql_order="number";
						break;
					case "number_desc":
						$sql_order="number desc";
						break;
					case "bed":
						$sql_order="bed";
						break;
					case "bed_desc":
						$sql_order="bed desc";
						break;
					case "count":
						$sql_order="count";
						break;
					case "count_desc":
						$sql_order="count desc";
						break;
				}
			}
			
			//处理分页
			$page_size=5;
			$result=$pdo->query("select count(*) from t_dorm_maintain");
			$count=$result->fetch()[0];
			$max_page=ceil($count/$page_size);
			$page=isset($_GET['page']) ? intval($_GET['page']) : 1;
			$page=$page>$max_page ? $max_page : $page;
			$page=$page < 1 ? 1 : $page;
			$lim=($page -1)*$page_size;
			
			$sql="select a.id,building,number,bed,sex,count
				from t_dorm as a join 
				(select count(b.id) as count,c.id from t_student_dorm as b right join t_dorm as c on b.dorm_id=c.id group by c.id) as d on a.id=d.id
				order by ".$sql_order." limit $lim,$page_size";
			$result=$pdo->query($sql);
			$dorm_list=$result->fetchAll();
			
			require './view/dorm_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>