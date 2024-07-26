<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "test_db";
$table_name = "users";

$connect = new mysqli($server_name, $user_name, $password,$db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$sql = "DELETE FROM $table_name";
$result = $connect->query($sql);

if($result->num_rows == 0) {
    echo json_encode(array("message" => "list is empty"));
}
$connect->close();
?>