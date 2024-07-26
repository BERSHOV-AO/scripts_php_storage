<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "diagnostic";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$serialNumber = mysqli_real_escape_string($connect, $data['serialNumber']);
$diagnosticShassi = mysqli_real_escape_string($connect, $data['diagnosticShassi']);
$diagnosticsBattery = mysqli_real_escape_string($connect, $data['diagnosticsBattery']);
$diagnosticSensoryPanel = mysqli_real_escape_string($connect, $data['diagnosticSensoryPanel']);
$diagnosticsPin = mysqli_real_escape_string($connect, $data['diagnosticsPin']);
$diagnosticLaserScanner = mysqli_real_escape_string($connect, $data['diagnosticLaserScanner']);
$diagnosticRfidReader = mysqli_real_escape_string($connect, $data['diagnosticRfidReader']);
$diagnosticSoundSignal = mysqli_real_escape_string($connect, $data['diagnosticSoundSignal']);
$diagnosticLightIndication = mysqli_real_escape_string($connect, $data['diagnosticLightIndication']);
$timeLastDiagnostics = mysqli_real_escape_string($connect, $data['timeLastDiagnostics']);

// Проверяем существование записи по серийному номеру
$result = $connect->query("SELECT * FROM $table_name WHERE serialNumber = '$serialNumber'");
if ($result->num_rows > 0) {
    // Если запись с таким серийным номером уже существует, обновляем данные
    $sql = "UPDATE $table_name SET diagnosticShassi='$diagnosticShassi', diagnosticsBattery='$diagnosticsBattery', diagnosticSensoryPanel='$diagnosticSensoryPanel', diagnosticsPin='$diagnosticsPin', diagnosticLaserScanner='$diagnosticLaserScanner', diagnosticRfidReader='$diagnosticRfidReader', diagnosticSoundSignal='$diagnosticSoundSignal', diagnosticLightIndication='$diagnosticLightIndication', timeLastDiagnostics='$timeLastDiagnostics' WHERE serialNumber='$serialNumber'";
} else {
    // Если записи с таким серийным номером нет, добавляем новую запись
    $sql = "INSERT INTO $table_name (serialNumber, diagnosticShassi, diagnosticsBattery, diagnosticSensoryPanel, diagnosticsPin, diagnosticLaserScanner, diagnosticRfidReader, diagnosticSoundSignal, diagnosticLightIndication, timeLastDiagnostics) VALUES ('$serialNumber', '$diagnosticShassi', '$diagnosticsBattery', '$diagnosticSensoryPanel', '$diagnosticsPin', '$diagnosticLaserScanner', '$diagnosticRfidReader', '$diagnosticSoundSignal', '$diagnosticLightIndication', '$timeLastDiagnostics')";
}

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "AGV diagnostics saved!"));
} else {
    echo json_encode(array("message" => "AGV diagnostics not saved! Get some error!"));
}
$connect->close();
?>
