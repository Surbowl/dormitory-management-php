<?php
	//初始化数据库连接
	header('content-type:text/html;charset=utf-8');
	$dsn="mysql:host=localhost;port=3306;dbname=db_dorm;charset=utf8";
	try{
		$pdo=new PDO($dsn,'root','123456');
	}catch(BDOException $e){
		echo $e->getMessage();
	}
?>