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

$sql = "SELECT * FROM $table_name WHERE serialNumber = '$serialNumber'";
$result = $connect->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Создаем объект класса AgvDiagnostic
    $agvDiagnostic = new AgvDiagnostic(
        $row['id'],
        $row['serialNumber'],
        (bool)$row['diagnosticShassi'],
        (bool)$row['diagnosticsBattery'],
        (bool)$row['diagnosticSensoryPanel'],
        (bool)$row['diagnosticsPin'],
        (bool)$row['diagnosticLaserScanner'],
        (bool)$row['diagnosticRfidReader'],
        (bool)$row['diagnosticSoundSignal'],
        (bool)$row['diagnosticLightIndication'],
        $row['timeLastDiagnostics']
    );

    echo json_encode($agvDiagnostic);
} else {
    echo json_encode(array("message" => "Object not found"));
}

$connect->close();

class AgvDiagnostic {
    public $id;
    public $serialNumber;
    public $diagnosticShassi;
    public $diagnosticsBattery;
    public $diagnosticSensoryPanel;
    public $diagnosticsPin;
    public $diagnosticLaserScanner;
    public $diagnosticRfidReader;
    public $diagnosticSoundSignal;
    public $diagnosticLightIndication;
    public $timeLastDiagnostics;

    function __construct($id, $serialNumber, $diagnosticShassi, $diagnosticsBattery, $diagnosticSensoryPanel, $diagnosticsPin, $diagnosticLaserScanner, $diagnosticRfidReader, $diagnosticSoundSignal, $diagnosticLightIndication, $timeLastDiagnostics) {
        $this->id = $id;
        $this->serialNumber = $serialNumber;
        $this->diagnosticShassi = $diagnosticShassi;
        $this->diagnosticsBattery = $diagnosticsBattery;
        $this->diagnosticSensoryPanel = $diagnosticSensoryPanel;
        $this->diagnosticsPin = $diagnosticsPin;
        $this->diagnosticLaserScanner = $diagnosticLaserScanner;
        $this->diagnosticRfidReader = $diagnosticRfidReader;
        $this->diagnosticSoundSignal = $diagnosticSoundSignal;
        $this->diagnosticLightIndication = $diagnosticLightIndication;
        $this->timeLastDiagnostics = $timeLastDiagnostics;
    }
}
?>
