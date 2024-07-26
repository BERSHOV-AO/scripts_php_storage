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

$serialNumberAGV = $_GET['serialNumberAGV']; // Получаем serialNumberAGV из запроса

$sql = "SELECT * FROM $table_name WHERE serialNumberAGV = '$serialNumberAGV'";
$result = $connect->query($sql);

if($result->num_rows > 0) {

    $data = array();
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $nameTo = $row['nameTo'];
        $serialNumberAGV = $row['serialNumberAGV'];
        $frequencyOfTo = $row['frequencyOfTo'];
        $statusTo = (bool)$row['statusTo'];
        $dataTo = $row['dataTo'];

        $toName = array(
            "id" => $id,
            "nameTo" => $nameTo,
            "serialNumberAGV" => $serialNumberAGV,
            "frequencyOfTo" => $frequencyOfTo,
            "statusTo" => $statusTo,
            "dataTo" => $dataTo
        );

        $data[] = $toName;
    }
    
    echo json_encode($data);

} else {
    echo json_encode(array("message" => "No records found for the given serialNumberAGV"));
}

$connect->close();
?>
