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
			
			$dorm_id=$_GET['id'];
			if(empty($dorm_id)){
				//如果没有$dorm_id参数就返回dorm列表
				header('Location: ./dorm.php');
			}
			
			//宿舍信息
			$sql="select * from t_dorm where id=$dorm_id";
			$result=$pdo->query($sql);
			$dorm_detail=$result->fetch();
			
			//处理表单提交
			if($_POST){
				//表单Post有两种功能,根据func字段判断
				$func=$_POST['func'];
				
				if($func=="添加学生"){
					$account=$_POST['account'];
					
					//先找到这名学生
					$sql="select id,sex from t_student where account='$account'";
					$result=$pdo->query($sql);
					$row=$result->fetch();
					$student_id=$row['id'];
					$student_sex=$row['sex'];
					$dorm_sex=$dorm_detail['sex'];
					
					if(empty($student_id)){
						echo "<script>alert('没有找到这名学生，请核对您输入的学号。');</script>";
					}else if($dorm_sex!=$student_sex){
						echo "<script>alert('无法将".$student_sex."生添加到".$dorm_sex."生宿舍。');</script>";
					}else{
						$sql="delete from t_student_dorm where student_id=?;
							insert into t_student_dorm(student_id,dorm_id,supervisor) values(?,?,'否')";
						$stmt=$pdo->prepare($sql);
						$stmt->bindParam(1,$student_id);
						$stmt->bindParam(2,$student_id);
						$stmt->bindParam(3,$dorm_id);
						if(!$stmt->execute())
						{
							exit("提交失败，请重试。".$stmt->errorInfo());
						}
						//echo "<script>alert('成功添加学生。');</script>";
						header("Location: ./dorm_detail.php?id=$dorm_id");	
					}

				}else if($func=="移出宿舍"){
					$student_ids=$_POST['student_id'];
					
					$sql_student_ids=implode("," ,$student_ids);
					$sql="delete from t_student_dorm where student_id in ($sql_student_ids)";
					if(!$pdo->query($sql)){
						exit("移出失败，请重试。".$stmt->errorInfo());
					}
					echo "<script>alert('移出成功。');</script>";
					
				}else if($func=="设为舍长"){
					$student_ids=$_POST['student_id'];
					
					$sql_student_ids=implode("," ,$student_ids);
					$sql="update t_student_dorm set supervisor='否';
						update t_student_dorm set supervisor='是' where student_id in ($sql_student_ids)";
					if(!$pdo->query($sql)){
						exit("舍长设置失败，请重试。".$stmt->errorInfo());
					}
					echo "<script>alert('舍长设置成功。');</script>";
				}
			}
			
			//住在宿舍的学生信息
			$sql="select account,name,supervisor,student_id
				from t_student as a join t_student_dorm as b on a.id=b.student_id
				where b.dorm_id=$dorm_id";
			$result=$pdo->query($sql);
			$dorm_student=$result->fetchAll();
			
			require './view/dorm_detail_html.php';
		}
	}else{
		//如果用户未登录
		header('Location: ../public/logout.php');
	}
?>