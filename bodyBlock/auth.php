<?php
$pdo = require 'system/connect_db.php';
$indices = ['email', 'password'];

if (isset($_POST['action']) && ($_POST['action'] === 'Войти')) {
    unset($_POST['action']);
    // d($_POST);
    list($errors, $input) = validate_form($pdo); //Запуск функции валидации формы

    if ($errors) { // если есть ошибки
        show_form($indices, $errors, $input); // показываем форму снова с ошибками и данными
    } else { // если ошибок нет
        // insert_user($input); // запись в базу данных
        // process_form($input); // отображаем информацию об успешной регистрации // перенаправить в личный кабинет
    }
} else {
    show_form($indices);
}









// //Если не у всех полей пустой ключ// 
// if ($errors) {
//     for ($i = 0; $i <= count($indices) - 1; $i++) {
//         if (!array_key_exists($indices[$i], $errors)) {
//             $errors[$indices[$i]] = $GLOBALS['ok_input'];
//         }
//     }
// }

//Если пришла пустая форма нейтрилизует ошибку пустого индекса в поле ошибки//
// $input = [];
// $errors = [];
// if (!$input) {
//     foreach ($_POST as $key => $value) {
//         $input[$key] = '';
//     }
// }

// if (!$errors) {
//     foreach ($_POST as $key => $value) {
//         $errors[$key] = '';
//     }
// }
// $input['email'] = '';
// $input['password'] = '';
// $errors['email'] = '';
// $errors['password'] = '';
// print_r($input);
// print_r($errors);






function validate_form($pdo)
{
    // массивы для данных и ошибок
    $errors = []; // массив с ошибками
    $input = []; // данные пользователя

    foreach ($_POST as $key => $value) {
        $input[$key] = htmlspecialchars(trim($value));
    }
    $query_mail = "SELECT email FROM users WHERE email=:email";
    $result_email = $pdo->prepare($query_mail);
    $result_email->bindParam(':email', $input['email']);

    $result_email->execute();
    $rowCount = $result_email->rowCount();

    if (!$rowCount > 0) {
        $errors['email'] = "<i>Пользователь отсутсвует.</i>";
    } else {

        $query_password = "SELECT password FROM users WHERE email=:email";
        $result_password = $pdo->prepare($query_password);
        $result_password->bindParam(':email', $input['email']);
        $result_password->execute();
        $password_db = $result_password->fetch(PDO::FETCH_ASSOC);
        $hash = password_verify($input['password'], $password_db['password']);

        if (!$hash) {
            $errors['password'] = "<i>Данные ведены некорректно.</i>";
        } else {
            $query_all_user = "SELECT `id`,`first_name`,`last_name`,`login`,`email`,`images`,`time_update`,`time_reg` FROM `users` WHERE email=:email";
            $query_all = $pdo->prepare($query_all_user);
            $query_all->bindParam(':email', $input['email']);
            $query_all->execute();
            while ($users = $query_all->fetch(PDO::FETCH_ASSOC)) {
                session_start();
                $_SESSION['authorized'] = 1;
                $_SESSION['id'] = $users['id'];
                $_SESSION['first_name'] = $users['first_name'];
                $_SESSION['last_name'] = $users['last_name'];
                $_SESSION['login'] = $users['login'];
                $_SESSION['email'] = $users['email'];
                $_SESSION['images'] = $users['images'];
                $_SESSION['time_update'] = $users['time_update'];
                $_SESSION['time_reg'] = $users['time_reg'];
            }
            // session_start();
            // d($users);

            // d($users);
            // $_SESSION['authorized'] = true;
            // $_SESSION['id']          =     $users['id'];
            // $_SESSION['first_name']          =   $users['first_name'];
            // $_SESSION['last_name']          =   $users['last_name'];
            // $_SESSION['login']          =       $users['login'];
            // $_SESSION['email']          =        $users['email'];
            // $_SESSION['password']          =    $users['password'];
            // $_SESSION['images']          =      $users['images'];
            // $_SESSION['time_update']          =  $users['time_update'];
            // $_SESSION['time_reg']          =     $users['time_reg'];







            header('Location: index.php?menu=lk');
        }
    }

    $result = [$errors, $input];
    return $result;
}

function show_form($indices, $errors = [], $input = [])
{



    //Если не у всех полей пустой ключ// 
    if ($errors) {
        for ($i = 0; $i <= count($indices) - 1; $i++) {
            if (!array_key_exists($indices[$i], $errors)) {
                $errors[$indices[$i]] = "<i style='color:green;'>OK</i>";
            }
        }
    }

    //Если пришла пустая форма нейтрилизует ошибку пустого индекса в поле ошибки//
    if (!$errors) {
        for ($i = 0; $i <= count($indices) - 1; $i++) {
            $errors[$indices[$i]] = '';
        }
    }
    //Если пришла пустая форма нейтрилизует ошибку пустого индекса//
    if (!$input) {
        for ($i = 0; $i <= count($indices) - 1; $i++) {
            $input[$indices[$i]] = '';
        }
    }



    echo <<<_HTML_


<form action="" method="POST" enctype="multipart/form-data">
<h2>Авторизация</h2>


<div class="email">
    <label for="email">Электронная почта:</label>
    <input type="email" id="email" name="email" value="$input[email]" placeholder="Введите почту">
    <span id="email-e">$errors[email]</span>
</div>

<div class="password">
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" value="$input[password]" placeholder="Введите пароль">
    <span id="password-e">$errors[password]</span>
</div>

<input type="submit" name="action" value="Войти">

</form>

_HTML_;
}


function d($arr) //Функция для тестирования
{
    echo "<pre>";
    print_r($arr);
    echo "</pre><hr>";
}
