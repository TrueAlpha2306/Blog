<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Підключення до бази даних
    $mysqli = new mysqli("localhost", "root", "root", "blog");

    // Перевірка на підключення до бази даних
    if ($mysqli->connect_error) {
        die("Помилка підключення до бази даних: " . $mysqli->connect_error);
    }

    // Отримання даних з форми
    $title = $_POST["title"];
    $content = $_POST["content"];
    $created_at = date("Y-m-d H:i:s");

    // Вставка нової статті в базу даних
    $query = "INSERT INTO articles (title, content, created_at) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sss", $title, $content, $created_at);
    $result = $stmt->execute();

    // Перевірка на успішність вставки
    if ($result) {
        // Перенаправлення на головну сторінку
        header("Location: index.php");
        exit();
    } else {
        echo "Помилка: " . $stmt->error;
    }

    // Закриття підключення до бази даних
    $mysqli->close();
}
?>
