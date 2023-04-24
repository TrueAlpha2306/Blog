<?php
require_once 'config.php';

// Перевірка, чи передано параметр id в URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Помилка: Невірний параметр id";
    exit;
}

// Отримання id статті з параметрів URL
$id = $_GET['id'];

// Перевірка, чи була надіслана форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання даних з форми
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Оновлення статті в базі даних
    $stmt = $conn->prepare("UPDATE articles SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);

    if ($stmt->execute()) {
        // Перенаправлення на головну сторінку блогу
        header("Location: index.php");
        exit;
    } else {
        echo "Помилка при оновленні статті: " . $stmt->error;
    }
}

// Отримання даних статті з бази даних
$stmt = $conn->prepare("SELECT title, content FROM articles WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Відображення форми для редагування статті
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редагувати статтю</title>
</head>
<body>
    <h1>Редагувати статтю</h1>
    <form method="post" action="">
        <label for="title">Заголовок:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>"><br><br>
        <label for="content">Контент:</label><br>
        <textarea id="content" name="content"><?php echo $row['content']; ?></textarea><br><br>
        <input type="submit" value="Оновити">
        <a href="index.php">Назад</a>
    </form>
</body>
</html>
