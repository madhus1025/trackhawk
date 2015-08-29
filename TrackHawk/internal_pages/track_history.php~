<html>
	<head>
		<title>Tracking History</title>
		<link rel="stylesheet" type="text/css" href="/css/track_history.css">
		<script src="/javascript/track.php"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<script>
			function hide()
			{
				document.getElementById("date").style.display='block';
			}
		</script>
		</head>
	<body>
		<div id="center">
			<h1 align="center" onclick="hide()">Track History</h1>
		</div>
		<hr>
		<div id="date"><br><br><br>
			Day&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="day" placeholder="Day"/><br><br>
			Month<input type="text" placeholder="month" id="month"/>&nbsp;&nbsp;<br><br>
			Year&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="year" id="year"/>&nbsp;&nbsp;<br><br>
			<input type="hidden" value="a" id="del"/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" onclick="track_it()" value="Get Devices"/>
			<br>
			<br><br><br>
			Devices<br><br>
			<select id="devices" onclick="changed()">
			<option>None </option>
			</select>
		</div>
			<div id="map-canvas"></div>
	</body>
</html>
