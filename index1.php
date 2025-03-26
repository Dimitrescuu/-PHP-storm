<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>
<?php if (isset($_SESSION['username'])): ?>
    <p>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <a href="logout.php">Выйти</a>
<?php else: ?>
    <a href="login.php">Войти</a>
<?php endif; ?>
</body>
</html>
