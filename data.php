<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "docify";
$conn = "";

try{
    $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);
    echo"Well you're connected to the server";
}
catch(mysqli_sql_exception){
    echo"Could not connect!";
}
?>