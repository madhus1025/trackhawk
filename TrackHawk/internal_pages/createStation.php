<html>
	<head>
		<title>Register User</title>
			<script type="text/JavaScript">

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
			<h3><center>Create Station</center></h3>
			<hr>
	</div>
	<center>
	<table border="1">
		<tr><td>
			<form name="form" action="/internal_pages/newStation.php"  method="post"><b>
			<br><br>Station Name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" id="user" name="station">
		
<br><br><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Submit" onClick="check()"><br><br>
<input type="hidden" id="imei" name="imei">
<input type="hidden" id="way" name="ways">
</form>
</td></tr>
</b>
</table>
<div id="txtHint">
</div>
</center>
</body>
</html>
