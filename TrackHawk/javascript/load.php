﻿<?php
	session_start();
	if($_SESSION['login']==0)               // If page directly accessed without login redirect user to login page
		header("Location:../index.php"); 

?>
var liveFlag=0;
var flightPath=new google.maps.Polyline();
var strig=[];

var mapping;

function get(column){            //This get's the current live positions of the people on the patroling

	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}


	xmlhttp.open("GET","../javascript/GetLocation.php?column="+column);

	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){	
			mapping=xmlhttp.response;
			place_it(mapping);
			return xmlhttp.response;
		}
	}
	xmlhttp.send();
}





function place_it(mapping){    //This function seperates the lattitudes,longitudes and deviceid's from the response from the server

	lattitude=[];
	longitude=[];
	deviceid=[];
	phone=[];
	way=[];
	phones=0;
	lattitudes=0;
	longitudes=0;
	deviceids=0;
	ways=0;
	flag=0;
	temp="";
	index1=0;
	for(index=0;index<mapping.length;index++){
		if(mapping[index]==','){
			
			if(flag%5==0){
				lattitude[lattitudes]=temp;
				lattitudes++;
				flag++;
			}
			else if(flag%5==1){
				longitude[longitudes]=temp;
				longitudes++;
				flag++;
			}
			else if((flag)%5==2){
				deviceid[deviceids]=temp;
				deviceids++;
				flag++;
			}	
			else if(flag%5==3){

				phone[phones]=temp;
				phones++;
				flag++;
			}
			else if(flag%5==4){

				way[ways]=temp;
				ways++;
				flag++;
			}
			temp="";
		}
		else{
			temp=temp+mapping[index];
		}
	}

	initialize(lattitude,longitude,0,deviceid,phone,way);
}

function set_it(lattitude,longitude,deviceid){
	
	getNames(deviceid,lattitude,longitude);	
}








function getNames(column,lattitude,longitude) {      // This gets the names of the persons of whose details are in the locations table

	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("GET","../javascript/GetNames.php?deviceid="+column);

	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{	
			mapping=xmlhttp.response;
			map_it(mapping,lattitude,longitude);
			return xmlhttp.response;
		}
	}
	xmlhttp.send();
}

var names=[];
function map_it(mapping,lattitude,longitude){
	names = mapping.split(',');	
	initialize(lattitude,longitude,0,names,names);
	
}


function newPopup(url) {
	popupWindow = window.open(
			url,'popUpWindow','height=500,width=500,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
}

var map;
var length=0;
var marker=[];
var coordinates=[];


var myVar;  //This checks and  updates the locations


var accidents;  //This listens for the incidents around the city

var messages;  //This listens for the messages from the patrolers


function accidentCheck(){

	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("GET","../javascript/accidents.php");

	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{	
			if(xmlhttp.response!="")
				showIt(xmlhttp.response);
		}
	}
	xmlhttp.send();
} 


function messageChecker(){

	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("GET","../javascript/messages.php");

	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{	
			if(xmlhttp.response!="")
				show_theft(xmlhttp.response);
		}
	}
	xmlhttp.send();
} 



function showIt(response){

	var index=0,flag=0;
	
	var dead=0;
	var major=0;
	var minor=0;
	var cause="";
	var comments="";

	

	
	for(index=0;index<response.length;index++){

		if(response[index]!=','){

			if(flag==0){
				dead=dead*10+response[index];
			}
			else if(flag==1){
				major=major*10+response[index];
			}
		
			else if(flag==2){
				cause=cause+response[index];	

			}
			else if(flag==3){
				comments=comments+response[index];
			}
		}
		else{
			if(flag<3)
				flag++;
			else{
					alert("******Alert******\nDead: "+dead+"\nMajor Injury: "+major+"\nCause: "+cause+"\nComments: "+comments);
				flag=0;		
				cause="";
				comments="";
				dead=0;
				major=0;
				minor=0;
			}
		}
	}


}




function show_theft(response){

	var index=0,flag=0;
	

	var property="";
	var comments="";

	

	
	for(index=0;index<response.length;index++){


		if(response[index]!=','){

		
			if(flag==0){
				property=property+response[index];	
			}
			else if(flag==1){
				comments=comments+response[index];
			}
		}
		else{
			if(flag<1)
				flag++;
			else{
					alert("******Alert******\nProperty: "+property+"\nComments: "+comments);
				flag=0;		
				property="";
				comments="";
			}
		}
	}


}

function setIntervals(){
	liveFlag=1;
	document.getElementById("accidentsDownload").style.display="none";
	loading();
	myVar=setInterval(function(){initializeall(1)},3000);
	removeLine();

	document.getElementById("date").style.display="none";
	document.getElementById("Live").style.display = "none";

}

function initializeall(flags) {   // On load this method will be executed



	if(flags==0){
		map=init();
	}
	lattitude=[];
	mapping=get("lattitude");
	accidents=setInterval(function(){accidentCheck()},3000);
	messages=setInterval(function(){messageChecker()},3000);
	

}

function changed(){ 
 // When the option selected is changed to view the history this function is called 

	changed_map(map);
}
function changedStations(){ 
 // When the option selected is changed to view the history this function is called 

	changed_Stations(map);
}

function track_it(){
	track_it_map(map);
}
function track_accidents(){
	
	document.getElementById("accidentsDownload").style.display="block";
	track_accidents_map(map);
}
function init(){  // This is called for the first time to load the map and to set the focus point

	map = new google.maps.Map(document.getElementById('map-canvas'), {
		zoom: 10,
		center: new google.maps.LatLng(17.1200, 78.4200),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	return map;

}

function lastLogin(){             //To get the last login

	var date='<?php echo $_SESSION['date'] ;?>';
	var element=document.getElementById("prev");
	element.innerHTML=date;
}




function addLine() {                // Adds line to the map with the specified points in the map
	flightPath.setMap(map);
}

function removeLine() {                //Removes the previous line on the request of newer line

	flightPath.setMap(map);
	flightPath.setMap(null);
}

var users=[];

var markers=0;

function initialize(lattitude,longitude,lineFlag,names,phones,data){          // Loads the current location of patrolers when the pageis loaded


	length_coord=lattitude.length;	
	var  i,infowindow;

	var image='../images/policeCar.png';

	if(lineFlag!=8){
		//alert(marker.length);
		for(i=0;i<marker.length;i++){
			marker[i].setMap(map);
			marker[i].setMap(null);
		}
		marker=[];
		markers=0;
	}
	else{
		if(markers==0)
		markers=marker.length;

	}



	for (i = 0,j=markers; i <length_coord; i++,j++) {  
	
		var name="";
		users[i]=names[i];

		var patroler=names[i];		

		if(lineFlag==2)
			name="Deaths: "+names[i]+"\nInjury :"+phones[i];
		else if(lineFlag==8){
			 name="Property:"+names[i];	

		}
		else
			name="Name: "+names[i]+"\nPhone :"+phones[i];
	
		if((i>0 &&i < length_coord-1&&lineFlag>=1)||(lineFlag>=2)){
		

			if(lineFlag==8){
				if(names[i]<50000)
					image='../images/Thief.png';
				else
					image='../images/Grave.png';
			}
			
			else{
				if(phones[i]==0)
					image='../images/orange.png';
				else{
					image='../images/inter.png';

				}				
			}
		
		}	
		
		else{
			accidentsFlag=0;
			image=new Image(10,10);

			if(lineFlag==1){
				image='../images/policeCar.png';
			}
			else{

			if(data[i]==1)
				image='../images/policeCar.png';
			
			else
				image='../images/policeCar2.png';
			}
		}

		  var infowindow = new google.maps.InfoWindow({
				content: name
			});
	
		marker[j] = new google.maps.Marker({
			position: new google.maps.LatLng(lattitude[i], longitude[i]),
			map: map,
			icon: image,
			infowindow: infowindow
		});

		/*if(lineFlag==0){
		 google.maps.event.addListener(marker[j], 'click', function() {

			var message = prompt("Enter your Message Below for\n"+users[i], " ");
			if(message!=null){
			
				sendMessage(patroler,message);
				
			}
   			map.setCenter(marker.getPosition());
 		 });
		}
	
*/
		google.maps.event.addListener(marker[j], 'click', (function(marker, j) {
		return function() {
				        this.infowindow.open(map, this);
			}
		})(marker, j));
		liveFlag=0;

	}
	var Direction_Array=[];
	if(lineFlag==1)				// for history the lineFlag will be 1 so this block will be executed for the history request
	{
		removeLine();
		var coordinates=[];
		for(i=0;i<lattitude.length;i++)
		{

			coordinates.push(new google.maps.LatLng(lattitude[i],longitude[i]));
		}
		flightPath = new google.maps.Polyline({
			path: coordinates,
			geodesic: true,
			travelMode: google.maps.DirectionsTravelMode.DRIVING,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
		});
		addLine();
	}
	unloading();
	google.maps.event.addDomListener(window, 'load', initialize);
	return marker;
}

function sendMessage(patroler,message){

	var xmlhttp;

	if (window.XMLHttpRequest)

	{

		xmlhttp=new XMLHttpRequest();

	}

	else

	{

		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("GET","../internal_pages/sendmessage.php?message="+message+"&patroler="+patroler);

	xmlhttp.onreadystatechange=function()

	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)

		{	
			if(xmlhttp.response!="")
				showIt(xmlhttp.response);
		}
	}
	xmlhttp.send();
	


}

var accidentLoader;
var accidentsFlag=0;
var incidentsTrack=0;

function Accidents(flag)
{	
        if(flag!=1)
	document.getElementById("accidentsDownload").style.display="none";
	if(flag==1){
		accidentsFlag=0;
		incidentsTrack=1;
	}

	if((liveFlag==1||accidentsFlag==1)&&(flag!=0))
		if(incidentsTrack==0)		
			return;
		else
			incidentsTrack=0;
	accidentsFlag=1;
	unset();
	document.getElementById("Live").style.display='block';
	
	for(i=0;i<marker.length;i++){
		marker[i].setMap(map);
		marker[i].setMap(null);
	}

	loadAccidents(flag);

	

}

function loadThefts(flag){


	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}


	xmlhttp.open("GET","../javascript/GetThefts.php?flag="+flag);

	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){	
			mapping=xmlhttp.response;

			place_thefts(mapping);
			return xmlhttp.response;
		}
	}
	xmlhttp.send();


}

function loadAccidents(flag){

	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}


	xmlhttp.open("GET","../javascript/GetAccidents.php?flag="+flag);

	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){	
			mapping=xmlhttp.response;
			place_accidents(mapping);
			loadThefts(flag);
			return xmlhttp.response;
		}
	}
	xmlhttp.send();

}
function place_accidents(mapping){

	lattitude=[];
	longitude=[];
	death=[];
	injury=[]
	lattitudes=0;
	longitudes=0;
	deaths=0;
	injuries=0;
	flag=0;
	temp="";
	index1=0;
	for(index=0;index<mapping.length;index++){
		if(mapping[index]==','){
			
			if(flag%4==0){
				lattitude[lattitudes]=temp;
				lattitudes++;
				flag++;
			}
			else if(flag%4==1){
				longitude[longitudes]=temp;
				longitudes++;
				flag++;
			}
			else if((flag)%4==2){
				death[deaths]=temp;
				deaths++;
				flag++;
			}	
			else if(flag%4==3){
				injury[injuries]=temp;
				injuries++;
				flag++;
			}
			temp="";
		}
		else{
			temp=temp+mapping[index];
		}
	}

	initialize(lattitude,longitude,2,death,injury);

}



function place_thefts(mapping){

	lattitude=[];
	longitude=[];
	property=[];
	grave=[];
	lattitudes=0;
	longitudes=0;
	properties=0;
	graves=0;
	flag=0;
	temp="";
	index1=0;
	for(index=0;index<mapping.length;index++){
		if(mapping[index]==','){
			
			if(flag%3==0){
				lattitude[lattitudes]=temp;
				lattitudes++;
				flag++;
			}
			else if(flag%3==1){
				longitude[longitudes]=temp;
				longitudes++;
				flag++;
			}
			else if((flag)%3==2){
				property[properties]=temp;
				properties++;
				flag++;
				if(temp>50000){
					grave[graves]=1;
				}
				else
					grave[graves]=0;
			}	
			temp="";
		}
		else{
			temp=temp+mapping[index];
		}
	}

	initialize(lattitude,longitude,8,property,grave);

}
function removeOptions(selectbox)
{
    var i;
    for(i=selectbox.options.length-1;i>=0;i--)
    {
        selectbox.remove(i);
    }
}
var width;
var height;

function enlarge(){

}
