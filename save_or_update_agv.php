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
$description = mysqli_real_escape_string($connect, $data['description']);
$maintenanceTime = mysqli_real_escape_string($connect, $data['maintenanceTime']);

// Проверяем существование записи по серийному номеру
$result = $connect->query("SELECT * FROM $table_name WHERE serialNumber = '$serialNumber'");
if ($result->num_rows > 0) {
    // Если запись с таким серийным номером уже существует, обновляем данные
    $sql = "UPDATE $table_name SET description='$description', maintenanceTime='$maintenanceTime' WHERE serialNumber='$serialNumber'";
} else {
    // Если записи с таким серийным номером нет, добавляем новую запись
    $sql = "INSERT INTO $table_name (name, serialNumber, description, maintenanceTime) VALUES ('$name', '$serialNumber', '$description', '$maintenanceTime')";
}

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "AGV saved!"));
} else {
    echo json_encode(array("message" => "AGV not saved! Get some error!"));
}
$connect->close();
?>
