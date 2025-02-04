<?php 
$servername = "localhost";
$username = "root";
$password = "";

try{
	$conn = new PDO("mysql:host=$servername;dbname=sxoleio", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "sindethikame";
}catch(PDOException $e){
	echo "I sindesi den einai dinati ".$e->getMessage();
}






?>