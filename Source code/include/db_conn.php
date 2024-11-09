


<?php
$sname = "localhost";
$unamae = "root";
$password = "";
$db_name = "project";

$conn= new mysqli($sname,$unamae,$password,$db_name);

if($conn->connect_error){
die("Connection failed ".$conn->connect_error);

}

?>


