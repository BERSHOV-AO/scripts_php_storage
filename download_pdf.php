<?php
$file = 'AGV-0002.00.01.00.001.pdf'; // Укажите путь к вашему PDF-файлу

if (file_exists($file)) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    http_response_code(404);
    echo "File not found.";
}
?>