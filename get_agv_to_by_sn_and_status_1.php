<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "agv_to";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

// Проверка соединения
if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Получаем serialNumberAGV из запроса
$serialNumberAGV = $_GET['serialNumberAGV'];

// Подготовленный запрос для предотвращения SQL-инъекций
$sql = "SELECT * FROM $table_name WHERE serialNumberAGV = ? AND statusTo = ?";
$stmt = $connect->prepare($sql);
$statusTo = '1'; // Указываем статус, который нас интересует
$stmt->bind_param("si", $serialNumberAGV, $statusTo); // "si" означает строка и целое число
$stmt->execute();
$result = $stmt->get_result();

$data = array(); // Инициализируем массив данных

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $nameTo = $row['nameTo'];
        $serialNumberAGV = $row['serialNumberAGV'];
        $frequencyOfTo = $row['frequencyOfTo'];
        $statusTo = $row['statusTo'];
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
}