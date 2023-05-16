<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Файлы</title>
</head>
<body>
<h1>Доска объявлений</h1>
<?php
require_once './Data/get.php';
?>
<form action="Data/save.php" method="POST">
    <input type="email" name="email" placeholder="E-mail" required><br>
    <select name="category" required>
        <option value="toys">Игрушки</option>
        <option value="hobby">Хобби</option>
        <option value="entertainment">Развлечения</option>
    </select><br>
    <textarea name="description" placeholder="Описание" required></textarea>
    <button type="submit">Отправить</button>
</form>

<table>
    <thead>
    <th>Category</th>
    <th>Email</th>
    <th>Title</th>
    <th>Description</th>
    </thead>
    <tbody>
    <?php
    get();
    ?>
    </tbody>
</table>
</body>
</html>
