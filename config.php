<?php
// Змінні для підключення до бази даних
$dbHost = 'localhost'; // Хост бази даних
$dbName = 'blog'; // Назва бази даних
$dbUser = 'root'; // Користувач бази даних
$dbPass = 'root'; // Пароль користувача бази даних

// Створення з'єднання з базою даних
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Перевірка з'єднання на наявність помилок
if (!$conn) {
    die("Помилка з'єднання з базою даних: " . mysqli_connect_error());
}
