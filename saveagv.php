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

$dateTime = new DateTime();
// Преобразуем объект DateTime в метку времени Unix (timestamp) в секундах
$timestamp = $dateTime->getTimestamp();
// Преобразуем секунды в миллисекунды, умножив на 1000

$name = "AGV 6";
$serialNumber = "424";
$description = "work!";
$maintenanceTime = $timestamp * 1000;


$sql = "INSERT INTO $table_name (name, serialNumber, description, maintenanceTime) VALUES ('$name', '$serialNumber', '$description', '$maintenanceTime')";

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "AGV hard saved!"));
} else {
    echo json_encode(array("message" => "AGV hard not saved! Get some error!"));
}
$connect->close();
?>