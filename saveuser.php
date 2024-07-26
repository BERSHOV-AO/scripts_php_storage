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

$login = "4";
$email = "1@ru";
$pass = "4";

$sql = "INSERT INTO $table_name (login, email, pass) VALUES ('$login', '$email', '$pass')";

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "User saved!"));
} else {
    echo json_encode(array("message" => "User not saved! Get some error!"));
}
$connect->close();
?>