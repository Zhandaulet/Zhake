<?php
require 'db.php'; // Подключаем файл для соединения с базой данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fio = $_POST['fio'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Проверка совпадения паролей
    if ($password !== $confirm_password) {
        echo "Пароли не совпадают!";
        exit();
    }

    // Хеширование пароля перед сохранением в базу данных
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL-запрос для вставки данных пользователя в базу данных
    $sql = "INSERT INTO users (fio, phone, password) VALUES (?, ?, ?)";

    // Подготовка запроса
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $fio, $phone, $hashed_password);

        // Выполнение запроса
        if ($stmt->execute()) {
            echo "Регистрация прошла успешно! Вы можете <a href='login.html'>войти</a>.";
        } else {
            echo "Ошибка: Невозможно зарегистрировать пользователя. Пожалуйста, попробуйте позже.";
        }

        // Закрытие подготовленного запроса
        $stmt->close();
    } else {
        echo "Ошибка базы данных: Невозможно подготовить запрос.";
    }

    // Закрытие соединения с базой данных
    $conn->close();
}
?>
