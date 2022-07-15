<?php
//___________________DB______________________________//
// $pdo = require 'connect_db.php';

$create_table_users = "CREATE TABLE IF NOT EXISTS users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    login VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    images VARCHAR(255),
    time_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    time_reg  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
    )";
$create_table_authors = "CREATE TABLE
IF NOT EXISTS authors (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    country VARCHAR(255) NOT NULL,
    avatar VARCHAR(255) NOT NULL
)";
$create_table_news = "CREATE TABLE IF NOT EXISTS news(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    short_text VARCHAR(255) NOT NULL,
    full_text TEXT NOT NULL,
    news_image VARCHAR(255) NOT NULL,
    add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    author_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors (id)
    )";
$create_table_downloads_images = "CREATE TABLE IF NOT EXISTS loads_images(
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        full_path VARCHAR(255) NOT NULL,
        path VARCHAR(255) NOT NULL,
        size INT(255) NOT NULL,
        users_id INT NOT NULL,
    FOREIGN KEY (users_id) REFERENCES users (id)
    )";
    $create_table_doctor = "CREATE TABLE IF NOT EXISTS doctor(
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        time INT(2) NOT NULL,
        name VARCHAR(255) DEFAULT NULL
        )";

$pdo->exec($create_table_users);
$pdo->exec($create_table_authors);
$pdo->exec($create_table_news);
$pdo->exec($create_table_downloads_images);
$pdo->exec($create_table_doctor);

// __Создание в базе данных числовых значений времени приёма__//
// $insert_time_in_doctor = "INSERT INTO doctor (time) VALUES(:time)";
// $result = $pdo->prepare($insert_time_in_doctor);
// for ($i = 9; $i <= 20; $i++) {
//     $result->bindParam(':time', $i);
//     $result->execute();
// }
