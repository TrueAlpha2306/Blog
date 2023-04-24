<!DOCTYPE html>
<html>
<head>
    <title>Блог</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Мій Блог</h1>
        <hr>
        <h2>Додати нову статтю</h2>
        <form method="post" action="add_article.php">
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Контент</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Додати статтю</button>
        </form>

        <hr>

        <h2>Список статей</h2>
        <?php
        // Підключення до бази даних
        $mysqli = new mysqli("localhost", "root", "root", "blog");

        // Перевірка на підключення до бази даних
        if ($mysqli->connect_error) {
            die("Помилка підключення до бази даних: " . $mysqli->connect_error);
        }

        // Запит на отримання всіх статей відсортованих за датою
        $query = "SELECT * FROM articles ORDER BY created_at DESC";
        $result = $mysqli->query($query);

        // Виведення статей
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">' . $row["title"] . ' <small>' . $row["created_at"] . '</small></div>';
                echo '<div class="panel-body">' . $row["content"] . '</div>';
                echo '<div class="panel-footer">';
                echo '<a href="edit_article.php?id=' . $row["id"] . '" class="btn btn-warning">Редагувати</a> ';
                echo '<a href="delete_article.php?id=' . $row["id"] . '" class="btn btn-danger">Видалити</a>';
                echo '</div>';
                echo '</div>';
                }
                } else {
                echo '<p>Немає статей</p>';
                }
                    // Закриття підключення до бази даних
    $mysqli->close();
    ?>
</div>

