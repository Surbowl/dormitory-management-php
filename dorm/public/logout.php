<?php
	session_start();
	$_SESSION['user_id']=null;
	$_SESSION['user_account']=null;
	$_SESSION['user_type']=null;
	$_SESSION['user_name']=null;
	
	$_SESSION['dorm_id']=null;
	$_SESSION['dorm_building']=null;
	$_SESSION['dorm_number']=null;
	
	header('Location: ./login.php');
?>