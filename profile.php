<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT appointments.id, services.name, services.price, appointments.appointment_date, appointments.status
                        FROM appointments
                        JOIN services ON appointments.service_id = services.id
                        WHERE appointments.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои записи</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Мои записи</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Услуга</th>
                    <th>Цена</th>
                    <th>Дата записи</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= number_format($row['price'], 0, ',', ' ') ?> ₽</td>
                        <td><?= $row['appointment_date'] ?></td>
                        <td><?= ucfirst($row['status']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-dark">На главную</a>
    </div>
</body>
</html>
