<?php

$data = json_decode(file_get_contents("php://input"), true);

$base64Image = $data['image'];
$imageName = $data['name'];

// получаем байты картинки из string
$imegeData = base64_decode($base64Image);

$imagePath = __DIR__."\images\\".$imageName;

// file_put_contents() - для записи на сервер
$result = file_put_contents($imagePath, $imegeData);

if($result !== false) {
    echo json_encode(array("message" => "Image Ulod done!", "url" => $imagePath));
} else {
    echo json_encode(array("message" => "Image not uploaded !", "url" => "error"));
}
?>