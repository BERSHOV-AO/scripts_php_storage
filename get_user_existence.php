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
$pass = mysqli_real_escape_string($connect, $data['pass']);

$sql = "SELECT * FROM $table_name WHERE login='$login' AND pass='$pass'";
$result = $connect->query($sql);

if($result->num_rows > 0) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false));
}

$connect->close();
?>
