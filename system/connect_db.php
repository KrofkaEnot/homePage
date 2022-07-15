<?php


try {
    $host = 'localhost'; // имя сервера БД
    $db_name = 'project'; // название базы данных
    $login = 'project'; // имя пользователя БД
    $password = 'project'; // пароль пользователя бд
    return new PDO("mysql:host=$host; dbname=$db_name", $login, $password);
} catch (PDOException $e) {
    header('Location: /errorDB.html');
}
