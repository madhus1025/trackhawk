﻿<html>

	<head>
		<title>Patroling List</title>
		<script type="text/javascript">
		function changed(imei){
			
		var xmlhttp;
		if (window.XMLHttpRequest){
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
		xmlhttp.open("GET","../internal_pages/patrolstatus.php?imei="+imei);    

		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					document.getElementById(imei).value=xmlhttp.response;
					if(xmlhttp.response=="Start Patrol"){
						document.getElementById(imei).style.backgroundColor="#33FF66";
					}
					else{
						document.getElementById(imei).style.backgroundColor="#FF3333";
					}
					
				}
			}
			xmlhttp.send();		
	
		}
		</script>
	<style type="text/css">
		#hid
		{
			display:none;	
		}	
		#d1	
		{
			background-color:#6495ed;
			font-size:22pt
		} 
		#z1	
		{
			color:black;
		}
	</style>
	</head>
	<body>
	<center>
		<div id="d1">
			<h3><center>Patroling List</center></h3>
			<hr>
		</div>
		<br><br><br><br>
		<?php
			include 'Connector.php';
			$con=connector();
			$date=date("Y-m-d");	
			$result=mysqli_query($con,"select * from devices where deviceid in(select deviceid from locations)");

			echo "<table>";
			while($row=mysqli_fetch_array($result)){
				$imei=$row['imei'];

				if($row['status']==0){
					$value="Start Patrol";
					$color="#33FF66";
				}
				else{
					$value="End Patrol";
					$color="#FF3333";
				}
				echo "<tr><td>";
				echo $row['name']."&nbsp;&nbsp;";
				echo "</td><td>"; 
				echo $row['currentholder']."&nbsp;&nbsp;";
				echo "</td><td>"; 			
				
				echo "<input type='button' style=\"background-color:".$color.";\" value='$value' id=\"".$row['imei']."\" onclick=\"changed(".$row['imei'].")\"'>";
				echo "</td></tr>"; 			
			}
		?>
	
	</center>
	</body>	
</html>
