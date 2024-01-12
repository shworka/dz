<?php

print("<html><head><title>DZ 2</title></head><body>");

$month_days = array (
  "Январь" => 31,
  "Февраль" => 28,
  "Март" => 31,
  "Апрель" => 30,
  "Май" => 31,
  "Июнь" => 30,
  "Июль" => 31,
  "Август" => 31,
  "Сентябрь" => 30,
  "Октябрь" => 31,
  "Ноябрь" => 30,
  "Декабрь" => 31
);

$monthes = array (
  "Январь" => 1,
  "Февраль" => 2,
  "Март" => 3,
  "Апрель" => 4,
  "Май" => 5,
  "Июнь" => 6,
  "Июль" => 7,
  "Август" => 8,
  "Сентябрь" => 9,
  "Октябрь" => 10,
  "Ноябрь" => 11,
  "Декабрь" => 12
);

$days = array (
  0 => "Воскресенье",
  1 => "Понедельник",
  2 => "Вторник",
  3 => "Среда",
  4 => "Четверг",
  5 => "Пятница",
  6 => "Суббота",
);

// Запрос 'check' приходит, когда нажимаем кнопку
if (isset($_GET['check'])) {
    print("Информаия о месяце ".$_POST['month'].", год ".$_POST['year']."<br/>");
    // сначала проверим - високосный ли год
    $leap = 0;
    $year = $_POST['year'];
    if ($year % 400 == 0)
        $leap = 1;
    else if ($year % 100 == 0)
        $leap = 0;
    else if ($my_year % 4 == 0)
        $leap = 1;

    $day_last = $month_days[$_POST['month']];
    if ($leap and $_POST['month'] == "Февраль") {
        print("Число дней: 29");
        $day_last = 29;
    }
    else {
        print("Число дней:".$month_days[$_POST['month']]);
    }

    if ($leap) {
        print("<br/>Год високосный");
    }
    else {
        print("<br/>Год невисокосный");
    }


    $first = date('w', strtotime($year."-".$monthes[$_POST['month']]."-01"));
    $last = date('w', strtotime($year."-".$monthes[$_POST['month']]."-".$day_last));
    print("<br/>Первый день месяца: ".$days[$first]);
    print("<br/>Последний день месяца: ".$days[$last]);

    // Число сред в месяце
    $num_weds = 0;
    for ($i=1; $i<=$day_last; $i++) {
        $d = date('w', strtotime($year."-".$monthes[$_POST['month']]."-".$i));
        if ($days[$d] == "Среда") {
            $num_weds++;
        }
    }
    print("<br/>Число дней 'среда': ".$num_weds);
}


print("<form action='dz2.php?check' method='POST'><table>");
print("<select name='year'>");
for ($i=1999; $i<=2029; $i++) {
    print("<option>$i</option>");
}
print("</select>");
print("<select name='month'><option>Январь</option><option>Февраль</option><option>Март</option><option>Апрель</option><option>Май</option><option>Июнь</option><option>Июль</option><option>Август</option><option>Сентябрь</option><option>Октябрь</option><option>Ноябрь</option><option>Декабрь</option></select>");
print("<input type='submit' value='Вычислить'></form>");


?>
</body>
</html>