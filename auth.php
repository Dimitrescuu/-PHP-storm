<?php


session_start();
require('db_connect.php');
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Подготовленный запрос
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $login]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Успешная аутентификация
            $_SESSION['username'] = $user['email'];  // Используйте email
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin'];
            $_SESSION['message'] = 'Вы успешно вошли в систему';
            header("Location: index1.php");
            exit();
        } else {
            $_SESSION['message'] = 'Неправильный пароль!';
        }
    } else {
        $_SESSION['message'] = 'Неправильный логин!';
    }

    header("Location: index1.php?page=login");
    exit();
}
