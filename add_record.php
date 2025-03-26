<?php
session_start();
require('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['file']['name'])) {
        $user_id = $_SESSION['user_id']; // ID текущего пользователя
        $file_name = $_FILES['file']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file_name);

        // Перемещаем загруженный файл в папку "uploads"
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            // Запись данных в таблицу "files"
            $stmt = $pdo->prepare("INSERT INTO files (user_id, file_name, created_at) VALUES (?, ?, NOW())");
            $stmt->execute([$user_id, $file_name]);

            echo "Файл успешно загружен и запись добавлена!";
        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        echo "Пожалуйста, выберите файл.";
    }
}
?>
