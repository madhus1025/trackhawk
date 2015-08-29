<?php
	
	include 'Connector.php';
	$path    = '../q!@#';
	$files = scandir($path);
	$count=count($files);
	$count++;
	$con=connector();
	echo getcwd();
	$result=mysqli_query($con,"select * from history");
	if(mysqli_num_rows($result)<10){
		try{
			//$backup=fopen($path."/q!@#".$count, "w") or die("Unable to open file!");	
			$backup_file="/opt/lampp/htdocs/q!@#.sql";
			$result = mysqli_query($con,"SELECT * INTO OUTFILE '$backup_file' FROM deviceholders");
			//$result=mysqli_query($con,"delete from history");

		}
		catch(Exception $e){
			echo $e;
		}
	}
?>
