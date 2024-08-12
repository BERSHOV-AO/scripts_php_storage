<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "agv_to";

// Устанавливаем соединение с базой данных
$connect = new mysqli($server_name, $user_name, $password, $db_name);

// Проверяем соединение
if ($connect->connect_error) {
    http_response_code(500); // Внутренняя ошибка сервера
    echo json_encode(array("message" => "Connection failed: " . $connect->connect_error));
    exit();
}

// Получаем данные из запроса
$data = json_decode(file_get_contents("php://input"), true);

// Проверяем, что данные были переданы
if (isset($data['id'], $data['nameTo'], $data['serialNumberAGV'], $data['frequencyOfTo'], $data['statusTo'], $data['dataTo'])) {
    // Экранируем входные данные
    $id = intval($data['id']); // Приводим к целому числу
    $nameTo = mysqli_real_escape_string($connect, $data['nameTo']);
    $serialNumberAGV = mysqli_real_escape_string($connect, $data['serialNumberAGV']);
    $frequencyOfTo = mysqli_real_escape_string($connect, $data['frequencyOfTo']);
    $statusTo = mysqli_real_escape_string($connect, $data['statusTo']);
    $dataTo = mysqli_real_escape_string($connect, $data['dataTo']);

    // SQL-запрос для обновления записи
    $sql = "UPDATE $table_name 
            SET nameTo = '$nameTo', 
                frequencyOfTo = '$frequencyOfTo', 
                statusTo = '$statusTo', 
                dataTo = '$dataTo' 
            WHERE id = '$id' AND serialNumberAGV = '$serialNumberAGV'";

    if ($connect->query($sql) === TRUE) {
        http_response_code(200); // Успешный запрос
        echo json_encode(array("message" => "AGV updated successfully!"));
    } else {
        http_response_code(500); // Внутренняя ошибка сервера
        echo json_encode(array("message" => "Error updating AGV: " . $connect->error));
    }
} else {
    http_response_code(400); // Неверный запрос
    echo json_encode(array("message" => "Invalid input data!"));
}

$connect->close();
?>
