﻿<html>
	<head>
		<?php
			include 'Connector.php';
			$con=connector();
			$username=$_POST["username"];
			$password=$_POST["password"];
			if($username==""||$password=="")
			{
				header("Location:../index.php");
			}
			$result = mysqli_query($con,"SELECT * FROM login where username='$username' and password='$password'");
			$row = mysqli_fetch_array($result);
			$verify=$row['username'];
			if($verify==null)
			{				
			echo "<script>alert('Login Failed')
				window.location='../index.php'
				</script>";
			}
			else
			{
				date_default_timezone_set('Asia/Kolkata');
				$date=date('Y-m-d H:i:s');
				session_start(); 
				$_SESSION['login']=1;
				$_SESSION['extract']=0;
				$_SESSION['user']=$username;
				$_SESSION['district']=$row['district'];
                                $dist=$_SESSION['district'];
				$ser=$_SERVER['REMOTE_ADDR'];
				$result = mysqli_query($con,"select time from log where username='$username'"); 
				$row = mysqli_fetch_array($result);
				mysqli_query($con,"delete from log");
				mysqli_query($con,"insert into log values('$dist','$ser','$date')");
		
				$_SESSION['date']=$row['time'];
				$result = mysqli_query($con,"update register set date='$d'  where username='$c'");
				header("Location:../internal_pages/welcome.php"); 
			}
		?>
	</head>
</html>
