<?php

function OpenCon(){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$db = "university";
	
	$conn = new mysqli($dbhost, $dbuser, $dbpassword, $db) or die("Connection failed: %s\n". $conn -> error);
	
	return $conn;
}

function CloseCon($conn){
	$conn -> close();
}

function dbQuery($sqlQuery){
	$conn = OpenCon();
	
	$result = mysqli_query($conn, $sqlQuery);
	
	CloseCon($conn);
}

?>