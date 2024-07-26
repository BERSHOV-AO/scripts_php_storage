<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "agv";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$name = mysqli_real_escape_string($connect, $data['name']);
$serialNumber = mysqli_real_escape_string($connect, $data['serialNumber']);
$versionFW = mysqli_real_escape_string($connect, $data['versionFW']);
$model = mysqli_real_escape_string($connect, $data['model']);
$ePlan = mysqli_real_escape_string($connect, $data['ePlan']);
$dataLastTo = mysqli_real_escape_string($connect, $data['dataLastTo']);

$sql = "INSERT INTO $table_name (name, serialNumber, versionFW, model, ePlan, dataLastTo) VALUES ('$name', '$serialNumber', '$versionFW', '$model', '$ePlan', '$dataLastTo')";

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "AGV saved!"));
} else {
    echo json_encode(array("message" => "AGV not saved! Get some error!"));
}
$connect->close();
?>