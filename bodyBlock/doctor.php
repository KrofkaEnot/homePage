<?php

$pdo = require 'system/connect_db.php';

$create_table_doctor = "CREATE TABLE IF NOT EXISTS doctor(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    time INT(2) NOT NULL,
    name VARCHAR(255) DEFAULT NULL
    )";
$pdo->exec($create_table_doctor);
?>

<?php
// __Создание в базе данных числовых значений времени приёма__//
// $insert_time_in_doctor = "INSERT INTO doctor (time) VALUES(:time)";
// $result = $pdo->prepare($insert_time_in_doctor);
// for ($i = 9; $i <= 20; $i++) {
//     $result->bindParam(':time', $i);
//     $result->execute();
// }
?>

<?php
//Получение часов из БД//
$query_time_in_doctor = "SELECT `id`, `time`, `name` FROM `doctor`"; //Общий запрос
$result_query_time_in_doctor = $pdo->query($query_time_in_doctor);
?>
<form action="" method="POST">
    <select name='time'>
        <?php
        while ($time_query = $result_query_time_in_doctor->fetch(PDO::FETCH_ASSOC)) {
            echo "<option>В " . $time_query['time'] . " - часов </option>";
        }
        ?>
    </select>
    <label for='name'>Фамилия:</label>
    <input type='text' name='name'>
    <input type='submit' name='action' value='Записаться'>
</form>

<?php
//Ввод данных на запись//
if (isset($_POST['action']) && ($_POST['action'] === "Записаться")) {
    $value_num = htmlspecialchars(trim($_POST['time'])); //Взять время
    $value_name = htmlspecialchars(trim($_POST['name'])); //Взять имя
    $value_num = (int)preg_replace("/[^0-9]/", '', $value_num); //Убрать не цифры

    if (empty($value_name)) { //Проверить поле с фамилией на пустоту
        echo "Поле фамилия не может быть пустым! Заполните поле фамилии!";
        return;
    }

    if (($value_num >= 9) && ($value_num <= 18)) { //Допустимые часы приёма
        $query_doc = "SELECT `time`,`name` FROM `doctor` WHERE time=?";
        $query = $pdo->prepare($query_doc);
        $query->execute([$value_num]);
        $value_visit = $query->fetch(PDO::FETCH_ASSOC); // Запросить место в записях
        // var_dump($value_visit);
        if (!($value_visit["name"] === null)) { //Проверить свободное место в записях
            echo "В " . $value_num . " часов занято!";
        } else {
            $insert_name_to_visit  = "UPDATE `doctor` SET `name`= :name  WHERE `time`= :time";
            $insert = $pdo->prepare($insert_name_to_visit);
            $insert->bindParam(':name', $value_name);
            $insert->bindParam(':time', $value_num);
            $insert->execute();
            echo $value_name . " внедрён на " . $value_num . " часов."; //Отобразить результат
            // header('Refresh: 0');
            // header('Location: localhost');
        }
    } else {
        return header('Location: /error.html');
    }
}
?>

<br>

<?php
//Вывод блоков с записями//
$result_query_time_in_doctor = $pdo->query($query_time_in_doctor);
echo "<div class='doctor'>";
while ($print_query = $result_query_time_in_doctor->fetch(PDO::FETCH_ASSOC)) {
    echo <<<_HTML
        <div class='doctorTable'>
            <p>Время записи: $print_query[time]</p>
            <p>Фамилия: $print_query[name]</p>
        </div>
    _HTML;
}
echo "</div>";
?>