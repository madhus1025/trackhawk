<?php
		session_start();
if($_SESSION['login']==0)
	header("Location:../index.php"); 
?>

function unset(){
	removeLine();
	clearTimeout(myVar);
	removeLine();
}

function track_it_map(map)                                                   // Gets the date entered 
{
	document.getElementById("accidentsDownload").style.display="none";
	var xmlhttp=new XMLHttpRequest();
	unset();
	document.getElementById("Live").style.display='block';
	var start=document.getElementById("start").value;

	var end=document.getElementById("end").value;
	

	if(start==""||end=="")
		return;
	else
		ajax_call(start,end,map);

}
function track_accidents_map(map)                                                   // Gets the date entered 
{

	document.getElementById("accidentsDownload").style.display="block";
	var xmlhttp=new XMLHttpRequest();
	unset();
	document.getElementById("Live").style.display='block';
	var start=document.getElementById("start").value;

	var end=document.getElementById("end").value;
	
	if(start==""||end=="")
		return;
	else
		ajax_call_stations(start,end,map);


}

function ajax_call_stations(start,end,map){

	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("GET","../internal_pages/getStations.php?start="+start+"&end="+end,true);


	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
			set_stations(xmlhttp.responseText,map);
			document.getElementById("stations").style.display="block";
			document.getElementById("devices").style.display="none";
		}
	}
	xmlhttp.send();
	


}


function ajax_call(start,end,map)    //makes an async call to the database with the date extracted and fetches the devices present in that date
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("GET","../internal_pages/getdevices.php?start="+start+"&end="+end,true);


	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
			set_devices(xmlhttp.responseText,map);
			document.getElementById("stations").style.display="none";
			document.getElementById("devices").style.display="block";
		}
	}
	xmlhttp.send();
}

function ajax_call_accidents(station,map)    //makes an async call to the database with the date extracted and fetches the devices present in that date
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("GET","../internal_pages/getincidents.php?station="+station,true);


	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			accidentsFlag=0;
			Accidents(1);
		}
	}
	xmlhttp.send();
}




function set_devices(devices,map)                     //Places all the devices that are present on that day into the select tag
{
	devicelist=[];
	var x=document.getElementById("devices");
	placer(devices,devicelist);
	x.remove(x.selectedIndex);
	while (x.length > 0) {
		x.remove(x.length-1);
	}
	for(index=0;index<devicelist.length;index++)
	{
		var option = document.createElement("option");
		option.text=devicelist[index];
		option.value=devicelist[index];
		x.add(option);
	}
}


function set_stations(devices,map)                     //Places all the devices that are present on that day into the select tag
{
	devicelist=[];
	var x=document.getElementById("stations");
	placer(devices,devicelist);
	x.remove(x.selectedIndex);
	while (x.length > 0) {
		x.remove(x.length-1);
	}
	for(index=0;index<devicelist.length;index++)
	{
		var option = document.createElement("option");
		option.text=devicelist[index];
		option.value=devicelist[index];
		x.add(option);
	}
}



function placer(strig,locator)                              //converts string to array "1,2,3,4" -> [1,2,3,4]
{
	temp="";
	index1=0;

	for(index=0;index<strig.length;index++)
	{
		if(strig[index]==',')
		{
			locator[index1]=temp;
			index1++;
			temp="";
			index++;
		}
		temp=temp+strig[index];
	}
}


function changed_map(map)                                        //Gets the device selected by the user
{
	var x=document.getElementById("devices");
	deviceid=x.options[ x.selectedIndex ].text; 
	ajax_call_dev(deviceid);
}
function changedStations(map){
	var x=document.getElementById("stations");
	station=x.options[ x.selectedIndex ].text;

	ajax_call_accidents(station,map);

}
function loading(){
	document.getElementById("map-canvas").setAttribute("style","-webkit-filter:blur(3px)");
	document.getElementById("map-canvas").style.filter="blur(3px)";
	document.getElementById("load").style.zIndex="1";
}

function unloading(){
    document.getElementById("map-canvas").setAttribute("style","-webkit-filter:blur(0px)");
		document.getElementById("map-canvas").style.filter="blur(0px)";
	document.getElementById("load").style.zIndex="-1";
}

function ajax_call_dev(device)                       //Makes an async call by sending the device id as request and gets location as response
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	loading();
	xmlhttp.open("GET","../internal_pages/getlocation.php?deviceid="+device,true);

	xmlhttp.onreadystatechange=function(){

		if (xmlhttp.readyState==4 && xmlhttp.status==200){

			set_location(xmlhttp.responseText);
		}
	}
	xmlhttp.send();
}

function set_location(location,map)                  /*Map those locations on to map*/
{
	
	var lattitude=[];
	var longitude=[];
	var dates=[];
	var lat=0,lon=0,date=0;
	temp="";
	var flag=0,index=0;


	for(index=0;index<location.length;index++)
	{
		if(location[index]==',')
		{
			if(flag==0)
			{
				lattitude[lat]=temp;
				lat++;
				flag=1;
			}
			else if(flag==1)
			{
				longitude[lon]=temp;
				lon++;
				flag=2;
			}
			else
			{
				dates[date]=temp;
				date++;
				flag=0;
			}
			temp="";
			continue;
		}
		temp=temp+location[index];
	}
	names=[];
	numbers=[];
	phones=[];
	placer(mapping,phones);
	unloading();
	initialize(lattitude,longitude,1,dates,numbers,1);

}

function toggle()              // If track history option is selected options are displayed 
{
	document.getElementById("stations").style.display="none"
	document.getElementById("accidentsDownload").style.display="none";
	document.getElementById("devices").style.display="none"
	var x=document.getElementById("date");
	if(x.style.display=='none'){
		x.style.display='block';
		removeOptions(document.getElementById("devices"));
		removeOptions(document.getElementById("stations"));
	}
	else
		x.style.display='none';
}






