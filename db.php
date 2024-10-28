<?php
$host = 'localhost'; // Обычно это 'localhost'
$db = 'shop_bd'; // Имя вашей базы данных
$user = 'root'; // Имя пользователя базы данных (обычно 'root')
$pass = ''; // Пароль к базе данных (в XAMPP/MAMP обычно пустой)

$conn = new mysqli($host, $user, $pass, $db);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
