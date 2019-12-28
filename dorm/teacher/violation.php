<?php
	header('content-type:text/html;charset=utf-8');
	define('APP','itcast');
	session_start();
	
	if(isset($_SESSION['user_id'])&&isset($_SESSION['user_type'])){
		$user_type=$_SESSION['user_type'];
		if($user_type!="teacher"){
			//非教师用户不允许访问教师平台
			header("Location: ../$user_type/home.php");
		}else{
			$user_id=$_SESSION['user_id'];
			
			require '../public/_share/_pdo.php';
			
			//处理表单提交
			if($_POST){
				$violation_id=$_POST['id'];
				$response="已读";
				if(!empty($violation_id)){
					$sql="update t_student_violation set teacher_response=? where id=?";
					$stmt=$pdo->prepare($sql);
					$stmt->bindParam(1,$response);
					$stmt->bindParam(2,$violation_id);
					if(!$stmt->execute())
					{
						exit("提交失败，请重试。".$stmt->errorInfo());
					}
					header('Location: ./violation.php');
				}
			}
			
			//处理分页
			$page_size=5;
			$result=$pdo->query("select count(*) from t_student_violation as a join t_student as b on a.student_id=b.id join t_class as c on b.class_id=c.id
								where c.teacher_id=$user_id");
			$count=$result->fetch()[0];
			$max_page=ceil($count/$page_size);
			$page=isset($_GET['page']) ? intval($_GET['page']) : 1;
			$page=$page>$max_page ? $max_page : $page;
			$page=$page < 1 ? 1 : $page;
			$lim=($page -1)*$page_size;
			
			$sql="select a.id,detail,date,account,teacher_response,b.name as student_name,c.name as class_name
				from t_student_violation as a join t_student as b on a.student_id=b.id join t_class as c on b.class_id=c.id
				where c.teacher_id=$user_id
				order by date desc limit $lim,$page_size";
			$result=$pdo->query($sql);
			$violation_list=$result->fetchAll();
	
			require './view/violation_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>