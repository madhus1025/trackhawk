<html>
	<head>
		<title>Register User</title>
			<script type="text/JavaScript">
		function ajax_call()         //makes an async call to the database with the date extracted and fetches the devices present in that date
		{
			var xmlhttp;
			if(window.XMLHttpRequest){

				xmlhttp=new XMLHttpRequest();	
			}
			else{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.open("GET","../internal_pages/DeviceList.php",true);

			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){

					setimei(xmlhttp.responseText);

				}
			}
			xmlhttp.send();
		}

		

		function setimei(devices){
			var imeis = devices.split(',');	
		
			var x=document.getElementById("imeis");
			x.remove(x.selectedIndex);
			for(index=0;index<imeis.length-1;index++){
				var option = document.createElement("option");
				option.text=imeis[index];
				option.value=imeis[index];
				x.add(option);
			}
		}
	
		function check()
		{
			document.getElementById("imei").value=document.getElementById("imeis").value;
			document.getElementById("district").value=document.getElementById("stations").value;
			var type=document.getElementById("types").value;
			if(type=="Highway - Blue Color"){
				document.getElementById("way").value=1;			
			}
			else
				document.getElementById("way").value=0;
			var phone=document.getElementById("phone").value;

		}
	</script>
	</head>
<body onload="ajax_call()">

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

	<div id="d1">
			<h3><center>Enroll User to Device</center></h3>
			<hr>
	</div>
	<center>
	<table border="1">
		<tr><td>
			<form name="form" action="/internal_pages/assignUserToDevice.php"  method="post"><b>
			<br><br>User&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" id="user" name="user">
			<br><br>Phone Model&nbsp&nbsp&nbsp&nbsp&nbsp<select id="imeis" name="imeis">
				<option>none</option>
				</select>
			<br><br>Phone&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" id="phone" name="phone">
			
			<br><br>Patroling Type&nbsp&nbsp<select id="types" name="types">
				<option>Highway - Blue Color</option>
				<option>Town Road - Green Color</option>
				</select>

<br><br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Submit" onClick="check()"><br><br>
<input type="hidden" id="imei" name="imei">
<input type="hidden" id="way" name="ways">
<input type="hidden" id="district" name="">
</form>
</td></tr>
</b>
</table>
<div id="txtHint">
</div>
</center>
</body>
</html>
