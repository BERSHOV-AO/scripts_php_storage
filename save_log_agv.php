<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "log";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$typeLog = mysqli_real_escape_string($connect, $data['typeLog']);
$tabelNum = mysqli_real_escape_string($connect, $data['tabelNum']);
$timeOpenApp = mysqli_real_escape_string($connect, $data['timeOpenApp']);
$serialNumberAgv = mysqli_real_escape_string($connect, $data['serialNumberAgv']);
$nameTO = mysqli_real_escape_string($connect, $data['nameTO']);
$timeToAgv = mysqli_real_escape_string($connect, $data['timeToAgv']);


$sql = "INSERT INTO $table_name (typeLog, tabelNum, timeOpenApp, serialNumberAgv, nameTO, timeToAgv) VALUES ('$typeLog', '$tabelNum', '$timeOpenApp', '$serialNumberAgv', '$nameTO', '$timeToAgv')";

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "AGV saved!"));
} else {
    echo json_encode(array("message" => "AGV not saved! Get some error!"));
}
$connect->close();
?>