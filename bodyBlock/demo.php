<?php
try {
    $pdo = require 'system/connect_db.php';
} catch (Error  $e) {
    header('Location: /errorDB.html');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {




    
    // if (
    //     !empty($_POST['first_name'])
    //     && !empty($_POST['last_name'])
    //     && !empty($_POST['login'])
    //     && !empty($_POST['email'])
    //     && !empty($_POST['password'])
    // ) {
    //     // d($_POST);

    //     $insert_user = "INSERT INTO users (first_name,last_name,login,email,password ) VALUES(:first_name,:last_name,:login,:email,:password)";
    //     $result = $pdo->prepare($insert_user);



        // $result->bindParam(':first_name', $_POST['first_name']);
        // $result->bindParam(':last_name', $_POST['last_name']);
        // $result->bindParam(':login', $_POST['login']);
        // $result->bindParam(':email', $_POST['email']);
        // $result->bindParam(':password', $_POST['password']);
        // $result->execute();
        // $x = [];
        // $y = [];
        // foreach ($_POST as $k => $v) {
        //     // $result->bindParam(':' . $k, $v);
        //     echo $k  . '  ' . $v  . '<br>';
        //     array_push($x, $k);
        // }
        // foreach ($x as $k) {
        //     $result->bindParam(':' . $k, $_POST[$k]);
        // }
        // $result->execute();
        // $result->bindParam(':' . $x, $y);
        // $result->bindParam(':' . $x, $y);
        // $result->bindParam(':' . $x, $y);
        // $result->bindParam(':' . $x, $y);
        // $result->bindParam(':' . $x, $y);
        // $result->execute();

        // header('Location: reg.php');
    // } else {
    //     echo "<hr>Поля не заполнены<hr>";
    // }
    //если отправлена форма цдаления пользователя
    // if (isset($_POST['action']) && $_POST['action'] === 'Удалить') {
    // }
}

// Array
// (
//     [first_name] => 
//     [last_name] => 
//     [login] => 
//     [email] => 
//     [password] => 
// )



?>

<!-- <!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Форма регистрации</title>
</head>

<body>
    <h1>Добавление нового пользователя</h1>
    <form action="" method="POST">

        <label for="first_name">Имя</label>
        <input type="text" name="first_name"><br>

        <label for="last_name">Фамилия</label>
        <input type="text" name="last_name"><br>

        <label for="login">Логин</label>
        <input type="text" name="login"><br>

        <label for="email">Емейл</label>
        <input type="email" name="email"><br>

        <label for="password"> Пароль</label>
        <input type="password" name="password"><br>

        <input type="submit" value="Отправить">
    </form>
</body>

</html> -->







<?php

// echo '<h2>Таблица с авторами</h2>';

// текст запроса к БД
// $query_str = "SELECT book_id, book_name, title,auth_id FROM books";

// отправляем запрос в БД
// сохраняем данные, полученные из БД в переменную $result
// $result = $pdo->query($query_str);

// выводим на страницу
// while ($books = $result->fetch(PDO::FETCH_ASSOC)) {
//     echo '<div>';
//     echo $books['book_name'];
//     echo $books['title'];
//     echo "<hr>";
//     echo '</div>';
// };
//_________Запрос пользователей________//
// $query = 'SELECT `id`,`first_name`,`last_name`,`login`,`email`,`password` FROM `users`';
// $result = $pdo->query($query);

// $result->execute();
// echo "<hr>";
// while ($users = $result->fetch(PDO::FETCH_ASSOC)) {
//     echo '<div>';
//     echo $users['first_name'];
//     echo '</div>';
// };
// echo "<hr>";





function d($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre><hr>";
}
