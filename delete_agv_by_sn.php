<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "agv";

// Создание подключения к базе данных
$connect = new mysqli($server_name, $user_name, $password, $db_name);

// Проверка подключения
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Возвращаем пустой объект AGVItem в любом случае
$data = array(); // Инициализируем массив данных

// Проверка наличия параметра serialNumber
if (isset($_GET['serialNumber'])) {
    $serialNumber = $_GET['serialNumber'];

    // Подготовленный запрос для удаления записи по серийному номеру
    $stmt = $connect->prepare("DELETE FROM $table_name WHERE serialNumber = ?");
    
    if ($stmt === false) {
        die("Prepare failed: " . $connect->error);
    }

    $stmt->bind_param("s", $serialNumber); // Предполагается, что serialNumber - строка

    // Выполняем запрос на удаление
    $stmt->execute();

    // Закрываем подготовленный запрос
    $stmt->close();
}


echo json_encode($data);

$connect->close();
?>
