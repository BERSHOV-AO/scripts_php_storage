<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "agv_to";

// Устанавливаем соединение с базой данных
$connect = new mysqli($server_name, $user_name, $password, $db_name);

// Проверка соединения
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$data = array(); // Инициализируем массив данных

// Получаем serialNumberAGV из запроса
if (isset($_GET['serialNumberAGV'])) {
    $serialNumberAGV = $_GET['serialNumberAGV'];

    // Подготовленный запрос для удаления записей
    $sql = "DELETE FROM $table_name WHERE serialNumberAGV = ?";
    $stmt = $connect->prepare($sql);
    
    // Проверяем, подготовлен ли запрос
    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . $connect->error);
    }

    // Привязываем параметры и выполняем запрос
    $stmt->bind_param("s", $serialNumberAGV); // "s" означает строку
    // if ($stmt->execute()) {
    //     // Проверяем количество затронутых строк
    //     if ($stmt->affected_rows > 0) {
    //         echo json_encode(['message' => 'Объекты успешно удалены']);
    //     } else {
    //         echo json_encode(['message' => 'Объекты не найдены']);
    //     }
    // } else {
    //     echo json_encode(['message' => 'Ошибка при удалении объектов: ' . $stmt->error]);
    // }

    // // Закрываем подготовленный запрос
    // $stmt->close();

        // Выполняем запрос на удаление
        $stmt->execute();

        // Закрываем подготовленный запрос
        $stmt->close();
} 
// else {
//     echo json_encode(['message' => 'Не указан serialNumberAGV']);
// }

echo json_encode($data);

// Закрываем соединение с базой данных
$connect->close();
?>
