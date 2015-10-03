<html>
	<head>
		<title>Device Enrollment</title>
		<script>


		function ajax_call2()         //makes an async call to the database with the date extracted and fetches the devices present in that date
		{
			var xmlhttp;
			if(window.XMLHttpRequest){

				xmlhttp=new XMLHttpRequest();	
			}
			else{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.open("GET","../internal_pages/StationList.php",true);

			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){


					setstation(xmlhttp.responseText);
				}

			}
			xmlhttp.send();
		}
		
		function setstation(devices){

			alert(devices);	
			var imeis = devices.split(',');	
			var x=document.getElementById("stations");
			x.remove(x.selectedIndex);
			for(index=0;index<imeis.length-1;index++){
				var option = document.createElement("option");
				option.text=imeis[index];
				option.value=imeis[index];
				x.add(option);
			}
		}
		</script>	
	</head>
<body onload="ajax_call2()">


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
	<script type="text/JavaScript">
		function check()
		{
			document.getElementById("station").value=document.getElementById("stations").value;
			var imei=document.getElementById("imei").value;
			var length=imei.length;
			if(length<14||length>17)
			{
				alert("Check the IMEI code Entered");
				document.getElementById("imei").value="";
			}
		
			var imei=document.getElementById("imei").value;
			re = /^[0-9]+$/;
			if(!re.test(document.getElementById("textboxID").value))
			{
				alert("Check the IMEI code Entered");
				document.getElementById("imei").value="";
			}
		}
	</script>
	<div id="d1">
			<h3><center>Enroll a Device</center></h3>
			<hr>
	</div>
	<center>
	<table border="1">
		<tr><td>
			<form name="form" action="/internal_pages/enroll.php"  method="post"><b>
			<br><br>Device Name&nbsp&nbsp<input type="text" id="name" name="name"><br><br>
Station&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select id="stations" name="stations">
				<option>none</option>
				</select>
			<br><br>IMEI&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" id="imei" name="imei">
<input type="hidden" name="station" id="station">
<br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Submit" onClick="check()"><br><br>
</form>
</td></tr>
</b>
</table>
<div id="txtHint">
</div>
</center>
</body>
</html>
