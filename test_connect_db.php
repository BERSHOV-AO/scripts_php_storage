<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

if ($connect->connect_error) {
    echo "false"; // Если есть ошибка подключения
} else {
    echo "true"; // Если подключение успешно
}

$connect->close();
?>
