<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tattoo_salon";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Соединение не установлено: " . $conn->connect_error);
}

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if ($conn->query($sqlCreateDB) === TRUE) {
    echo "База данных '$dbname' создана или уже существует.<br>";
} else {
    die("Ошибка при создании базы данных: " . $conn->error);
}

$conn->select_db($dbname);

$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows == 0) {
    $sql = file_get_contents("db_dump.sql");

    if ($conn->multi_query($sql)) {
        do {
        } while ($conn->next_result());
        echo "Таблицы успешно созданы.<br>";
    } else {
        die("Ошибка при создании таблиц: " . $conn->error);
    }
}

if (php_sapi_name() !== "cli") {
    ob_start();
}