<?php
require 'db.php'; // Подключаем файл для соединения с базой данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // SQL-запрос для получения данных пользователя
    $sql = "SELECT id, password FROM users WHERE phone = ?";

    // Подготовка запроса
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $phone);

        // Выполнение запроса
        if ($stmt->execute()) {
            $stmt->store_result();

            // Проверка наличия пользователя с введенным номером телефона
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();

                // Проверка пароля
                if (password_verify($password, $hashed_password)) {
                    echo "Успешный вход! Добро пожаловать, пользователь с ID: " . $id;

                    // Кнопка для перехода на страницу магазина
                    echo '<br><br><a href="index1.html"><button>Перейти в магазин</button></a>';

                    // Здесь можно добавить сессию для отслеживания авторизации
                } else {
                    echo "Неверный пароль!";
                }
            } else {
                echo "Пользователь с таким номером телефона не найден.";
            }
        } else {
            echo "Ошибка выполнения запроса.";
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
