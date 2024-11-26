<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";

// Создаем соединение с базой данных
$connect = new mysqli($server_name, $user_name, $password, $db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Получаем имя таблицы из запроса
$table_name = $_GET['table'];

$sql = "SELECT * FROM $table_name";
$result = $connect->query($sql);

if($result->num_rows > 0) {

    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }
    echo json_encode($data);

}else {
    $messageArray = array();
    $messageArray[] = array("nameTo" => "0", "frequencyTo" => "0");
    echo json_encode($messageArray);
}
$connect->close();
?>
