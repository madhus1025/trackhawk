
<?php
	session_start();
	$h="hello";
	clearstatcache();
	if($_SESSION['login']==0)
		header("Location:../index.php"); 
	
	$con=mysqli_connect("localhost","root","","hawk");
	$result=mysqli_query($con,"select * from devices");
	
	while($row=mysqli_fetch_array($result))
	{
		$index=1;
		$ext=".txt";
		$path="../Dropbox/Dropbox/Apps/SandeepTrial/TrackHawks/";
		$file_name=$row['imei'].$ext;
		$file_name=$path.$file_name;
		
		while(get($file_name,$row['deviceid'],$path)>0)
		{
			echo "Went";
			$add=" (".$index.")".$ext;
			$file_name=$path.$row['imei'].$add;
			$index++;
		}
	}

	function get($file_name,$deviceid,$path)
	{
		$con=mysqli_connect("localhost","root","","hawk");
		$i=0;
		$s="";
		$values=array("","","","");
		if(!(file_exists($file_name)))
		{
			echo "Some Error while working";
			echo $file_name;
			return -1;
		}
		$myfile = fopen($file_name, "r") or die("Unable to open file!");
		$myfile1 = fopen($file_name, "r") or die("Unable to open file!");
		while(!feof($myfile)) 
		{
			if(fgetc($myfile1)==',')
			{
				$values[$i]=$s;
				$i++;
				$s="";
			}
			$p=fgetc($myfile);
			if($p!=',')
				$s.=$p;
		}

		$values[$i]=$s;
		$result=mysqli_query($con,"insert into history(deviceid,lattitude,longitude,date) select deviceid,lattitude,longitude,date from locations where deviceid=$deviceid");
		$result=mysqli_query($con,"delete from locations where deviceid='$deviceid'");
		$result = mysqli_query($con,"insert into locations values($deviceid,$values[1],$values[2],'$values[3]')");
		fclose($myfile);

		fclose($myfile1);


		$src = '/opt/lampp/htdocs/Dropbox/Dropbox/Apps/Sandeep Trial/TrackHawks/';
		$dst = '/opt/Backup/';
		$files = glob($src."/*.*");
      		foreach($files as $file){
      			$file_to_go = str_replace($src,$dst,$file);
      			copy($file, $file_to_go);
      		}
		unlink($file_name);
		return 1;
	}
mysqli_close($con);
?>  





