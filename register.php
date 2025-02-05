<?php
session_start();
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT); 

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("Ошибка: Email уже зарегистрирован.");
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password_hash);
    if ($stmt->execute()) {
        $_SESSION["user_id"] = $stmt->insert_id;
        $_SESSION["name"] = $username;
        header("Location: index.php");
        exit;
    } else {
        echo "Ошибка при регистрации.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4">
        <h2 class="text-center">Регистрация</h2>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Зарегистрироваться</button>
        </form>
        <p class="text-center mt-3">Уже есть аккаунт? <a href="login.php">Войти</a></p>
    </div>
</body>
</html>