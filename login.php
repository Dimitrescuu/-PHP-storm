<?php

session_start();

require('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $login]);
    $user = $stmt->fetch();



    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        header("Location: index1.php");
        exit();
    } else {
        $error = "Неправильный логин или пароль";
    }
}
?>
<form method="post" action="">
    <div>
        <label for="login">Логин</label>
        <input type="text" id="login" name="login" placeholder="Введите логин" required>
    </div>
    <div>
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" placeholder="Введите пароль" required>
    </div>
    <button type="submit">Войти</button>
</form>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>
