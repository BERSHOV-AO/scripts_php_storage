<?php
header('Content-Type: application/json');

// Укажите путь к директории, которую вы хотите просмотреть
$directoryPath = 'C:/wamp64/www/host/schemes'; // Замените на нужный путь

$directories = [];
$files = [];

// Проверяем, существует ли директория
if (is_dir($directoryPath)) {
    // Открываем директорию
    if ($handle = opendir($directoryPath)) {
        // Читаем содержимое директории
        while (false !== ($entry = readdir($handle))) {
            // Пропускаем текущую и родительскую директории
            if ($entry != "." && $entry != "..") {
                // Проверяем, является ли это директорией или файлом
                if (is_dir($directoryPath . '/' . $entry)) {
                    $directories[] = $entry;
                } else {
                    $files[] = $entry;
                }
            }
        }
        closedir($handle);
    }
}

// Формируем ответ в виде JSON
$response = [
    'directories' => $directories,
    'files' => $files
];

// Возвращаем ответ
echo json_encode($response);
?>
