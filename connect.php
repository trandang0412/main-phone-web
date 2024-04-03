<?php
	$host="localhost";
	$post="3306";
	$dbName="assignment";
	$DbUserName="root";
	$dbPass="";

	$conn= new mysqli($host,$DbUserName,$dbPass,$dbName,$post);
	
/*if($conn->connect_error){
	echo 'loi';
	die($conn->connect_error);
}else{
	echo 'xong';
}*/

?>
