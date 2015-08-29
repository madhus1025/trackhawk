<?php
	$con=mysqli_connect("119.82.105.141","root1","root@123","hawk");

	$imei=$_GET['imei'];
		       	
	$result=mysqli_query($con,"select deviceid from devices where imei='$imei'");

	$row=mysqli_fetch_array($result);

	$deviceid=$row['deviceid'];

	$lattitude=$_GET['lattitude'];

	$longitude=$_GET['longitude'];

	$date=$_GET['date'];
	
	$message="";

	$date=date("y-m-d h-i-s");
	
	session_start();

	$username=$_SESSION['user'];

	try{
		$message=$_GET['message'];
	}	
	catch(Exception $e){
		echo " ";
	}
	
        $date=str_replace("%20"," ",$date);
	

	if($message!=""){

		$result=mysqli_query($con,"select * from messages");

		$rows=$result->num_rows;

		$rows++;

		$result=mysqli_query($con,"select * from devices where imei='$imei'");

		$row=mysqli_fetch_array($result);

		$patroler=$row['currentholder'];
	
		$name=$row['name'];

		$result=mysqli_query($con,"insert into messages values($rows,'$message','$patroler','$name','$username','$date',1,0)");

	}
  
	$result=mysqli_query($con,"select * from locations where deviceid=$deviceid");
      
        if( mysqli_num_rows($result)!=0){

	$row=mysqli_fetch_array($result);
	
      
	$result1=mysqli_query($con,"select * from devices where imei='$imei'");	

	$row1=mysqli_fetch_array($result1);

	

	if($row1['status']==0){
	
		echo "The patrol has been not yet started or been ended by the Server";

	}
	else if($row['lattitude']==$lattitude && $row['longitude']==$longitude){

		$stayed=$row['stayed'];

		$stayed=$stayed+1;                       // This is the time he stayed at a particular location


		$result=mysqli_query($con,"update locations set stayed=$stayed where deviceid=$deviceid");

                $result=mysqli_query($con,"select from history where lattitude=$lattitude and longitude=$longitude");
                
                if($result==false){

			$result=mysqli_query($con,"insert into history(deviceid,lattitude,longitude,date,stayed) select deviceid,lattitude,longitude,date,stayed from locations where deviceid=$deviceid");                            
                }	
        }
	else{
			$result=mysqli_query($con,"insert into history(deviceid,lattitude,longitude,date,stayed) select deviceid,lattitude,longitude,date,stayed from locations where deviceid=$deviceid");                  

			$result=mysqli_query($con,"delete from locations where deviceid=$deviceid");

			$result = mysqli_query($con,"insert into locations values($deviceid,$lattitude,$longitude,'$date',0)");
	}
     }
      else{
              $result = mysqli_query($con,"insert into locations values($deviceid,$lattitude,$longitude,'$date',0)");
     }     
		$result=mysqli_query($con,"select * from messages where patroler in(select currentholder from devices where deviceid='$deviceid')and status=1");
		
	  if(mysqli_num_rows($result)!=0){

		$id=$row['id'];		

		$result=mysqli_query($con,"update messages set status=0 where id=$id");		
	}
		
?>

		
