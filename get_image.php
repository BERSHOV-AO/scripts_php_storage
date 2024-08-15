<?php
$imageName = $_GET['name']; // Получаем имя изображения из параметра запроса
$imagePath = __DIR__."\images\\".$imageName;

if (file_exists($imagePath)) {
    header('Content-Type: image/png'); // Укажите правильный тип содержимого
    readfile($imagePath); // Отправляем изображение клиенту
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Image not found!"));
}
?>
