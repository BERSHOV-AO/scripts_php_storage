<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "agv_to";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$nameTo = mysqli_real_escape_string($connect, $data['nameTo']);
$serialNumberAGV = mysqli_real_escape_string($connect, $data['serialNumberAGV']);
$frequencyOfTo = mysqli_real_escape_string($connect, $data['frequencyOfTo']);
$statusTo = mysqli_real_escape_string($connect, $data['statusTo']);
$dataTo = mysqli_real_escape_string($connect, $data['dataTo']);

$sql = "INSERT INTO $table_name (nameTo, serialNumberAGV, frequencyOfTo, statusTo, dataTo) VALUES ('$nameTo', '$serialNumberAGV', '$frequencyOfTo', '$statusTo', '$dataTo')";

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "AGV saved!"));
} else {
    echo json_encode(array("message" => "AGV not saved! Get some error!"));
}
$connect->close();
?>