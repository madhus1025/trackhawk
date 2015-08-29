<?php	
	session_start();
	if($_SESSION['login']==0)
		header("Location:../index.php"); 
	$_SESSION['station']=$_GET['station'];
?>
