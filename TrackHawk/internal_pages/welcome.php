<html>
<?php
	session_start();
	if($_SESSION['login']==0)
		header("Location:../index.php"); 
 ?>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<script src="/javascript/load.php"></script>
		<script src="/javascript/track.php"></script>
		<link rel="stylesheet" type="text/css" href="../css/welcome.css">
		<title>Welcome</title>
	</head>
	<body onload="initializeall(0)">
		<div id="header">
			<img id="amblem" src="/images/police.jpeg">
			<h2 id="head">Tracking System</h2>
			<h3 id="prev" onclick="lastLogin()">My Previous Login</h3>
			<h3 id="history" onclick="toggle()" onmouseover="enlarge()" onblur="shrink()">Track History</h3>
			<h3 id="about" onclick="JavaScript:newPopup('/internal_pages/Aboutus.php')">About us</h3>
			<h3 id="logout"><a id="white" href="http://localhost/">Logout</a></h3>
		</div>
		<div id="tab">
			<h3 id="newDev"><a class="black" href="JavaScript:newPopup('/internal_pages/newDevice.php')">New Device</a></h3>
			<h3 id="regUser"><a class="black" href="JavaScript:newPopup('/internal_pages/regUser.php')">Register User</a></h3>
			<h3 id="CreateStation"><a class="black" href="JavaScript:newPopup('/internal_pages/createStation.php')">Create Station</a></h3>			
			<h3 id="Live" onclick="setIntervals()">Goto Live</h3>	
			<h3 id="Accidents" onclick="Accidents(0)">Incidents</h3>

		</div>
		
		<div id="DeviceList">	
			<h3 id="devlist" onclick="JavaScript:newPopup('/internal_pages/patrolinglist.php')">Device List</h3>
			
		</div>
			<img id="load" src="../images/loading.gif">
		<div id="map-canvas">

		</div>

		<div id="date"><br><br><br>
			Start Date&nbsp;&nbsp;&nbsp;<input type="text" id="start" placeholder="yyyy-mm-dd hh:mm:ss"/><br><br>
			<br><br>
			End date&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="yyyy-mm-dd hh:mm:ss" id="end"/>&nbsp;&nbsp;<br><br>
			<input type="hidden" value="a" id="del"/>
			<input type="submit" onclick="track_it()" value="Get Devices"/><input type="hidden" value="a" id="inc"/> <input type="submit" id="trackincidents" onclick="track_accidents()" value="Incidents"/>
			<br>
			<br><br><br>
			<div id="accidentsDownload">
				<a id="theft" href="../javascript/theft.csv">Thefts</a>
				<a id="Accidents" href="../javascript/accidents.csv">Accidents</a>
			</div>			
			<div id="station">
			Stations<br><br>
			<select id="stations" onclick="changedStations()">
			<option>None </option>
			</select>
			</div>
			
			<div id="devic">
			Devices<br><br>
			<select id="devices" onclick="changed()">
			<option>None </option>
			</select>
			</div>
		</div>
	
	</body>
</html>
	
