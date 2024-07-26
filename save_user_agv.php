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

$data = json_decode(file_get_contents("php://input"), true);

$login = mysqli_real_escape_string($connect, $data['login']);
$email = mysqli_real_escape_string($connect, $data['email']);
$pass = mysqli_real_escape_string($connect, $data['pass']);

$sql = "INSERT INTO $table_name (login, email, pass) VALUES ('$login', '$email', '$pass')";

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "User saved!"));
} else {
    echo json_encode(array("message" => "User not saved! Get some error!"));
}
$connect->close();
?>