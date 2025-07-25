<?php
$host="localhost";
$user="root";
$pass="";
$db="web_db";
$conn=new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
    echo "connection failed to db".$conn->connect_error;
}
?>