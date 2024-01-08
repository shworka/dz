<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор квадратного уравнения</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Калькулятор квадратного уравнения</h1>
    <form method="post">
        <label for="paramA">Параметр A:</label>
        <input type="text" name="paramA" id="paramA" required><br>

        <label for="paramB">Параметр B:</label>
        <input type="text" name="paramB" id="paramB" required><br>

        <label for="paramC">Параметр C:</label>
        <input type="text" name="paramC" id="paramC" required><br>

        <button type="submit" name="calculate">Вычислить</button>
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $paramA = floatval($_POST['paramA']);
        $paramB = floatval($_POST['paramB']);
        $paramC = floatval($_POST['paramC']);

        echo '<h2>Результаты:</h2>';
        echo '<table>';
        echo '<tr><th>X</th><th>Y</th></tr>';
        for ($x = 1; $x <= 20; $x++) {
            $y = $paramA * $x * $x + $paramB * $x + $paramC;
            echo "<tr><td>{$x}</td><td>{$y}</td></tr>";
        }
        echo '</table>';
    }
    ?>
</body>
</html>
