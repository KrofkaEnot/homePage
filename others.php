<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="style.css">
</head>


<body>


    <br>
    <a href="in work.html">Новости</a>
    <br>

    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="6"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="7"></button>

        </div>
    </div>

    <h4>Регистрация</h4>
    <form action="" method="POST">

        <label for="first_name">Имя</label>
        <input type="text" name="first_name"><br>

        <label for="last_name">Фамилия</label>
        <input type="text" name="last_name"><br>

        <label for="login">Логин</label>
        <input type="text" name="login"><br>

        <label for="email">Емейл</label>
        <input type="email" name="email"><br>

        <label for="password">Пароль</label>
        <input type="password" name="password"><br>

        <input type="submit" value="Отправить">
    </form>


    <br>

    <hr>



    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images\pets\April.jpg" alt="April" class="d-block" style="width: 20%">
        </div>
        <div class="carousel-item">
            <img src="images\pets\Sheldon.jpg" alt="Sheldon" class="d-block" style="width:20%">
        </div>
        <div class="carousel-item">
            <img src="images\pets\Dic.jpg" alt="Dic.jpg" class="d-block" style="width:20%">
        </div>
        <div class="carousel-item">
            <img src="images\pets\Kroshic.jpg" alt="Kroshic.jpg" class="d-block" style="width:20%">
        </div>
        <div class="carousel-item">
            <img src="images\pets\Timofej.jpg" alt="Timofej.jpg" class="d-block" style="width:30%">
        </div>
        <div class="carousel-item">
            <img src="images\pets\Roksi.jpg" alt="Roksi.jpg" class="d-block" style="width:30%">
        </div>
        <div class="carousel-item">
            <img src="images\pets\Snitch.jpg" alt="Snitch.jpg" class="d-block" style="width:20%">
        </div>
        <div class="carousel-item">
            <img src="images\pets\Tsin.jpg" alt="Tsin.jpg" class="d-block" style="width:30%">
        </div>
    </div>
    <br>
    <div>
        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container-fluid mt-3">
        <h3> Можешь приезжать сколько угодно раз раз! <br>
            Гулять много раз, общаться, прежде, чем сделать выбор.</h3> <br><br>

        <!-- <p> </p> -->
    </div>




</body>

</html>
<?php
$pdo = require 'connect_db.php'; //подключаю файл с бд
//строка запроса на создание т-цы
$create_table_users = "CREATE TABLE IF NOT EXISTS users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    login VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";


//выполняем запрос к базе данных - создаем т-цу
$pdo->exec($create_table_users);

// обработка формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    // если отправлена форма 


    if (
        !empty($_POST['first_name']) && !empty($_POST['last_name'])
        && !empty($_POST['login']) && !empty($_POST['email'])
        && !empty($_POST['password'])
    ) {  //если поля не пустые 
        // d($_POST); 
        // обрабатываем данные 

        $first_name = htmlspecialchars(trim($_POST['first_name']));
        $last_name = htmlspecialchars(trim($_POST['last_name']));
        $login = htmlspecialchars(trim($_POST['login']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        //записываем в бд
        $insert_user = "INSERT INTO users VALUES(?,?,?,?,?,?)"; // пишу текст запроса 
        $result1 = $pdo->prepare($insert_user); // подготавливаю запрос
        $result1->execute([null, $first_name, $last_name, $login, $email, $password]); //вставка данных в таблицу
        header('Location: index.php');
    } else { // если какие-то поля не заполнены 
        echo 'заполните все поля';
    }
}



// текст запроса к БД
$query_str = "SELECT f_name, l_name, title, pet_name, img
FROM pets, volunteers
WHERE vol_id = volunt_id";

// отправляем запрос в БД
// сохраняем данные, полученные из БД в переменную $result
$pet = $pdo->query($query_str);
// $result_query_time_in_doctor = $pdo->query($query_time_in_doctor);
// выводим на страницу
echo '<div class="container">';
while ($pet = $result->fetch()) { // построчно перебираем результат в цикле
    echo '<div class="box">';

    echo "<p><span>Имя питомца:</span> $pet[pet_name]</p>";
    echo "<p><span>Имя волонтера:</span> $pet[f_name]</p>";
    echo "<p><span>Фамилия волонтера:</span> $pet[l_name]</p>";
    echo "<p><span>История питомца:</span> $pet[title]</p>";

    echo '</div>';
}


echo '</div>';












?>