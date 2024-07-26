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

$sql = "TRUNCATE TABLE $table_name"; // SQL запрос на очистку таблицы

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "Table $table_name has been cleared successfully!"));
} else {
    echo json_encode(array("message" => "Error clearing table $table_name: " . $connect->error));
}

$connect->close();
?>
