<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление записи</title>
</head>
<body>
<h2>Добавление записи</h2>
<form action="add_record.php" method="post" enctype="multipart/form-data">
    <label for="file">Выберите файл:</label>
    <input type="file" name="file" id="file" required><br><br>
    <button type="submit" name="submit">Добавить запись</button>
</form>
</body>
</html>