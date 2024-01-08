<?php
// Подключение к базе данных MySQL
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Создание таблицы, если она не существует
$sql = "CREATE TABLE IF NOT EXISTS work_days (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    work_type VARCHAR(40) NOT NULL,
    work_day DATE NOT NULL
)";
$conn->query($sql);

// Обработка отправки формы
if (isset($_POST['submit'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $workType = $_POST['work_type'];

    // Создание массива с диапазоном дат
    $dateRange = [];
    $currentDate = strtotime($startDate);
    $endDate = strtotime($endDate);
    while ($currentDate <= $endDate) {
        $dateRange[] = date('Y-m-d', $currentDate);
        $currentDate = strtotime('+1 day', $currentDate);
    }

    // Запись дат в базу данных
    $values = [];
    foreach ($dateRange as $date) {
        $values[] = "('$workType', '$date')";
    }
    if (!empty($values)) {
        $sql = "INSERT INTO work_days (work_type, work_day) VALUES " . implode(",", $values);
        if ($conn->query($sql) === true) {
            echo "Дата успешно добавлена в базу данных.";
        } else {
            echo "Ошибка при добавлении даты: " . $conn->error;
        }
    }
}

// Вывод содержимого таблицы БД в обратном порядке
$sql = "SELECT * FROM work_days ORDER BY work_day DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Тип работы</th><th>Дата</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $row['id'] . '</td><td>' . $row['work_type'] . '</td><td>' . $row['work_day'] . '</td></tr>';
    }
    echo '</table>';
} else {
    echo "Таблица пуста.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Выделение дней из диапазона дат</title>
</head>
<body>
    <h1>Выделение дней из диапазона дат</h1>
    <form method="post">
        <label for="start_date">Дата начала работ:</label>
        <input type="date" name="start_date" id="start_date" required><br>

        <label for="end_date">Дата завершения работ:</label>
        <input type="date" name="end_date" id="end_date" required><br>

        <label for="work_type">Наименование работ:</label>
        <input type="text" name="work_type" id="work_type" required><br>

        <button type="submit" name="submit">Сохранить</button>
    </form>
</body>
</html>
