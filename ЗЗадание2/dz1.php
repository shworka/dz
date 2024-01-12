<?php

// Запрос 'add' приходит, когда нажимаем кнопку добавления города -
// в этом случае дописываем город в файл и редиректим на основной скрипт
if (isset($_GET['add'])) {
   if (!$fp = fopen('cities.txt', 'a')) {
       echo "Cannot open file";
   }
   fwrite($fp, $_POST['name'].";".$_POST['year'].";".$_POST['distance'].";".$_POST['direction']."\n");
   fclose($fp);
   header("Location: dz1.php");
   exit();
}

// Основная страничца с таблице городов
print("<html><head><title>DZ 1</title></head><body>");
print("<table>");
print("<tr><th>№</th><th>Название</th><th>Год основания</th><th>Удаленность от столицы</th><th>Направление</th></tr>\n");

$lines = file('cities.txt');
$count = 0;
foreach($lines as $line) {
    $count += 1;
    $pieces = explode(";", str_replace(PHP_EOL, '', $line));
    if (count($pieces) >=3) { 
       print("<tr><td>$count</td><td>$pieces[0]</td><td>$pieces[1]</td><td>$pieces[2]</td><td>$pieces[3]</td></tr>\n");
    }
}

print("</table>");

// Форма для ввода нового города
print("<h3>Добавить город</h3>");

print("<form action='dz1.php?add' method='POST'><table>");
print("<tr><th>Название</th><th>Год основания</th><th>Удаленность от столицы</th><th>Направление</th></tr>\n");
print("<tr><td>");
print('<input type="text" id="name" name="name" required size="20" />');
print("</td><td>");
print('<input type="number" id="year" name="year" />');
print("</td><td>");
print('<input type="number" id="distance" name="distance" />');
print("</td><td>");
print("<select name='direction'><option>Южное</option><option>Юго-Западное</option><option>Юго-Восточное</option><option>Восточное</option><option>Западное</option><option>Северное</option><option>Северо-Западное</option><option>Северо-Восточное</option></select>");
print("</td></tr>\n");
print("</table><input type='submit' value='Добавить'></form>");


?>
</body>
</html>