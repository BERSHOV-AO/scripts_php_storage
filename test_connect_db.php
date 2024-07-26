<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "users";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$sql = "SHOW TABLES LIKE '$table_name'";
$result = $connect->query($sql);

if($result->num_rows > 0) {
    echo "true";
} else {
    echo "false";
}

$connect->close();
?>