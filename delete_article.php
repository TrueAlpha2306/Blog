<?php
require_once 'config.php';

// Перевірка, чи передано параметр id в URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Помилка: Невірний параметр id";
    exit;
}

// Отримання id статті з параметрів URL
$id = $_GET['id'];

// Видалення статті з бази даних
$stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Перенаправлення на головну сторінку блогу
    header("Location: index.php");
    exit;
    } else {
    echo "Помилка при видаленні статті: " . $stmt->error;
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Видалити статтю</title>
    </head>
    <body>
        <h1>Видалити статтю</h1>
        <p>Ви впевнені, що хочете видалити цю статтю?</p>
        <form method="post" action="">
            <input type="submit" value="Так">
            <a href="index.php">Ні</a>
        </form>
    </body>
    </html>
    if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}
