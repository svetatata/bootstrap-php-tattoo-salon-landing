<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Ошибка: Для записи необходимо войти в систему.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $service_id = intval($_POST['service_id']);

    $stmt = $conn->prepare("SELECT id FROM services WHERE id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        die("Ошибка: Услуга не найдена.");
    }

    $stmt = $conn->prepare("INSERT INTO appointments (user_id, service_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $service_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Запись на услугу успешно выполнена!';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['message'] = 'Ошибка при записи на услугу. Пожалуйста, попробуйте еще раз.';
        $_SESSION['message_type'] = 'error';
    }
}
$conn->close();
?>
