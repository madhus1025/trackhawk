<?php



function connector(){

session_start();
$dbname = $_SESSION['dbname'];
		$con=mysqli_connect("127.0.0.1","root","",$dbname);
		return $con;
}
function connector_db(){
		$con=mysqli_connect("127.0.0.1","root","");
		return $con;
}

header("../index.php");
?>
