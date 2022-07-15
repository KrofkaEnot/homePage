<?php
// error_reporting(E_ERROR );
//
// Выведение return header('Location: index.php?menu=show_users'); в отдельную константу
//
//
//___________________DB______________________________//
// $pdo = require 'system/connect_db.php';

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
$pdo->exec($create_table_users);
$pdo->exec($create_table_authors);
$pdo->exec($create_table_news);
//_____________________all___________________________//
$backgroundColor = 'rgb(246, 221, 221)';
$no_ru_exp = '/[а-яё]+/gi';
$no_special_exp = '~[\\\/:*?"\'<>|]~';
$indices = ['first_name', 'last_name', 'login', 'email', 'password']; // индексы для перебора полей формы
$indices_err = ['first_name', 'last_name', 'login', 'email', 'password', 'image']; // индексы для перебора полей формы
$ok_input = '<div style="color:green;">ОК</div>'; // поле успешной проверки ввода
//______________first_name _______last_name_________//
$minimum_letters = 2; // минимум символа(ов)
$maximum_letters = 18; // максимум символа(ов)
// $err_maximum_letters = 'максимум ' . $GLOBALS['maximum_letters'] . ' символа(ов) ';
// $err_minimum_letters = 'минимум ' . $GLOBALS['minimum_letters'] . ' символа(ов) ';
$err_maximum_letters = 'максимум ' . $maximum_letters . ' символа(ов) ';
$err_minimum_letters = 'минимум ' . $minimum_letters . ' символа(ов) ';
// $reg_exp = "/^[a-z]{2,}$/i"; // с ограничением на количество символов в строке 
$reg_exp = "/[a-zа-яё]+/iu";
$err_reg_exp = 'недопустимые символы';
// $placeholder_f_l_name = 'от ' . $GLOBALS['minimum_letters'] . ' до ' . $GLOBALS['maximum_letters'] . ' символа(ов) ';
$placeholder_f_l_name = 'от ' . $minimum_letters . ' до ' . $maximum_letters . ' символа(ов) ';
$zero_str = 'поле не должно быть пустым';
//_______________________login______________________//
$minimum_login = 4; // минимум символа(ов)
$maximum_login = 32; // максимум символа(ов)
// $err_maximum_login = 'максимум ' . $GLOBALS['maximum_login'] . ' символа(ов) ';
// $err_minimum_login = 'минимум ' . $GLOBALS['minimum_login'] . ' символа(ов) ';
$err_maximum_login = 'максимум ' . $maximum_login . ' символа(ов) ';
$err_minimum_login = 'минимум ' . $minimum_login . ' символа(ов) ';
$reg_exp_login = "/^[a-z][a-z0-9]+$/i";
$err_reg_exp_login = 'только латинские символы, должен начинаться с буквы';
// $placeholder_login = 'от ' . $GLOBALS['minimum_login'] . ' до ' . $GLOBALS['maximum_login'] . ' символа(ов) ';
$placeholder_login = 'от ' . $minimum_login . ' до ' . $maximum_login . ' символа(ов) ';
$zero_str_login = 'введите логин';
//_______________________email______________________//
$minimum_email = 4; // минимум символа(ов)
$maximum_email = 30; // максимум символа(ов)
// $err_maximum_email = 'максимум ' . $GLOBALS['maximum_email'] . ' символа(ов) ';
// $err_minimum_email = 'минимум ' . $GLOBALS['minimum_email'] . ' символа(ов) ';
$err_maximum_email = 'максимум ' . $maximum_email . ' символа(ов) ';
$err_minimum_email = 'минимум ' . $minimum_email . ' символа(ов) ';
// $reg_exp_email = "/.+@.+\..+/i";
$reg_exp_email = '/[a-z0-9]+@[a-z0-9]+\.[a-z0-9]+/i';

$err_reg_exp_email = 'адрес электронной почты введен в неверном формате';
// $placeholder_email = 'от ' . $GLOBALS['minimum_email'] . ' до ' . $GLOBALS['maximum_email'] . ' символа(ов) ';
$placeholder_email = 'от ' . $minimum_email . ' до ' . $maximum_email . ' символа(ов) ';
$zero_str_email = 'введите адрес электронной почты';
//_______________________password______________________//
$minimum_password = 8; // минимум символа(ов)
$maximum_password = 32; // максимум символа(ов)
// $err_maximum_password = 'максимум ' . $GLOBALS['maximum_password'] . ' символа(ов) ';
// $err_minimum_password = 'минимум ' . $GLOBALS['minimum_password'] . ' символа(ов) ';
$err_maximum_password = 'максимум ' . $maximum_password . ' символа(ов) ';
$err_minimum_password = 'минимум ' . $minimum_password . ' символа(ов) ';
// $reg_exp_password = "/^[a-z0-9]+$/i";
// $err_reg_exp_password = 'Только латинские буквы или цифры';
// $placeholder_password = 'От ' . $GLOBALS['minimum_password'] . ' до ' . $GLOBALS['maximum_password'] . ' символа(ов) ';
$placeholder_password = 'От ' . $minimum_password . ' до ' . $maximum_password . ' символа(ов) ';
$zero_str_password = 'введите пароль';
//_______________________images______________________//
// $size_img_ava = 1631488;
// $err_type_img = "Тип изображения недопустим";
// $err_size_img = "Размер не может превышать" . convert_bytes($size_img_ava);


// function convert_bytes($size)
// {
//     $i = 0;
//     while (floor($size / 1024) > 0) {
//         ++$i;
//         $size /= 1024;
//     }

//     $size = str_replace('.', ',', round($size, 1));
//     switch ($i) {
//         case 0:
//             return $size .= ' байт';
//         case 1:
//             return $size .= ' КБ';
//         case 2:
//             return $size .= ' МБ';
//     }
// }
//___________________________________________________//

// глобальная обасть видимости
// if ($_SERVER['REQUEST_METHOD'] === 'POST') { // если форма отправлена методом POST
if (isset($_POST['action']) && ($_POST['action'] === 'Зарегистрироваться')) { // проверяем данные пользователя и кладем результат в переменные

    list($errors, $input) = validate_form($indices);

    if ($errors) { // если есть ошибки
        show_form($indices, $errors, $input); // показываем форму снова с ошибками и данными
    } else { // если ошибок нет
        list($errors, $input) = insert_user($input); // запись в базу данных если нет подобных
        // process_form($input); // отображаем информацию об успешной регистрации // перенаправить в личный кабинет
        if ($errors) { // если есть ошибки
            show_form($indices, $errors, $input); // показываем форму снова с ошибками и данными
        }
    }
} else { // если страница загружена впервые

    show_form($indices); // отображаем форму
}


function insert_user($input = [])
{
    $errors = [];
    //________Проверка на подобную учётку______________________//
    $query_akk = "SELECT email,login FROM users WHERE email=:email OR login=:login";
    $result_akk = $GLOBALS['pdo']->prepare($query_akk);

    for ($i = 0; $i <= count($GLOBALS['indices']) - 1; $i++) {
        if (($GLOBALS['indices'][$i] === 'email') or ($GLOBALS['indices'][$i] === 'login')) {
            $result_akk->bindParam(':' . $GLOBALS['indices'][$i], $input[$GLOBALS['indices'][$i]]);
            $errors[$GLOBALS['indices'][$i]] = "<i>Логин или пароль уже используется!</i>";
        }
        
    }
    $result_akk->execute();
    $rowCount = $result_akk->rowCount();
    if (!$rowCount > 0) {
        $insert_user = "INSERT INTO users (first_name,last_name,login,email,password ) VALUES(:first_name,:last_name,:login,:email,:password)";
        $result = $GLOBALS['pdo']->prepare($insert_user);

        for ($i = 0; $i <= count($GLOBALS['indices']) - 1; $i++) {
            if ($GLOBALS['indices'][$i] === 'password') {
                $pass = password_hash($input[$GLOBALS['indices'][$i]], PASSWORD_DEFAULT);
                $result->bindParam(':' . $GLOBALS['indices'][$i], $pass);
            } else {
                $result->bindParam(':' . $GLOBALS['indices'][$i], $input[$GLOBALS['indices'][$i]]);
            }
        }
        $result->execute();
        return header('Location: index.php?menu=auth');
    }
    

    $result = [$errors, $input]; // формируем результирующий массив
    return $result; // возвращаем ошибки и данные пользователя
}

/**
 * функция для проверки формы регистрации
 */
function validate_form($indices)
{
    // обасть видимости функции validate_form($indices)

    // $_POST [
    // 'first_name' => 'Вася',
    // 'last_name' => 'Иванов',
    // 'login'=> 'vasya123',
    // 'email' => 'vasya@fdf',
    // 'password' => '123456'
    //]

    // массивы для данных и ошибок
    $errors = []; // массив с ошибками
    $input = []; // данные пользователя

    // убираем пробельные символы и экранируем

    foreach ($indices as $index) {
        $input[$index] = htmlspecialchars(trim($_POST[$index]));
    }

    /**
     * функция для проверки имени
     */
    function validate_first_name($first_name)
    {
        // обасть видимости функции validate_first_name()
        // $reg_exp = "/^[а-яё]{2,}$/iu"; // u - обработает кириллицу

        if (strlen($first_name) === 0) { //  если строка пустая
            return $GLOBALS['zero_str'];
        } elseif (mb_strlen($first_name) < $GLOBALS['minimum_letters']) { // если менее minimum_letters букв
            return  $GLOBALS['err_minimum_letters'];
        } elseif (mb_strlen($first_name) > $GLOBALS['maximum_letters']) { // не более символа(ов)
            return  $GLOBALS['err_maximum_letters'];
        } elseif (!preg_match($GLOBALS['reg_exp'], $first_name)) { // 3. введены недопустимые символы /sg45*/
            return $GLOBALS['err_reg_exp'];
        }
    }
    // вызываем функцию проверки имени
    if (validate_first_name($input['first_name'])) { // если функция вернула какую-либо строку
        $errors['first_name'] = validate_first_name($input['first_name']); // кладем информацию об ошибке в соответствующий элемент массива с ошибками
    }

    /**
     * функция для проверки фамилии
     */
    function validate_last_name($last_name)
    {
        // обасть видимости функции validate_last_name()
        // $reg_exp = "/^[а-яё]{2,}$/ui"; u - обработает кириллицу i - без учёта регистра

        if (strlen($last_name) === 0) { // 1. если строка пустая
            return $GLOBALS['zero_str'];
        } elseif (mb_strlen($last_name) < $GLOBALS['minimum_letters']) { // 2. если менее букв
            return  $GLOBALS['err_minimum_letters'];
        } elseif (mb_strlen($last_name) > $GLOBALS['maximum_letters']) { // не более символа(ов)
            return  $GLOBALS['err_maximum_letters'];
        } elseif (!preg_match($GLOBALS['reg_exp'], $last_name)) { // 3. введены недопустимые символы /sg45*/
            return $GLOBALS['err_reg_exp'];
        }
    }
    // вызываем функцию проверки фамилии
    if (validate_last_name($input['last_name'])) { // если функция вернула какую-либо строку
        $errors['last_name'] = validate_last_name($input['last_name']); // кладем информацию об ошибке в соответствующий элемент массива с ошибками
    }


    /**
     * функция для проверки логина
     */
    function validate_login($login)
    {
        // $reg_exp = "/^[a-z][a-z0-9]+$/i";

        if (empty($login)) { // 1. логин не должен быть пустым
            return $GLOBALS['zero_str_login'];
        } elseif (strlen($login) <  $GLOBALS['minimum_login']) { // 2. логин не должен быть короче 6 символа(ов)
            return $GLOBALS['err_minimum_login'];
        } elseif (mb_strlen($login) > $GLOBALS['maximum_login']) { // не более символа(ов)
            return  $GLOBALS['err_maximum_login'];
        } elseif (!preg_match($GLOBALS['reg_exp_login'], $login)) { // 3. должен начинаться с буквы и должен содержать только латинские буквы и цифры
            return $GLOBALS['err_reg_exp_login'];
        }
    }
    // вызываем функцию проверки логина
    if (validate_login($input['login'])) {
        $errors['login'] = validate_login($input['login']);
    }

    /**
     * функция для проверки email
     */


    function validate_email($email)
    {
        // $reg_exp = "/.+@.+\..+/i";

        if (strlen($email) === 0) { // 1. проверка на пустоту
            return $GLOBALS['zero_str_email'];
        } elseif (!preg_match($GLOBALS['reg_exp_email'], $email)) { // 2. проверка на рег выражение
            return $GLOBALS['err_reg_exp_email'];
        }
    }
    // вызываем функцию для проверки емейла
    if (validate_email($input['email'])) {
        $errors['email'] = validate_email($input['email']);
    }

    /**
     * функция проверки пароля
     */
    function validate_password($password)
    {

        // $reg_exp = "/^[a-z0-9]+$/i";

        if (empty($password)) {
            return $GLOBALS['zero_str_password'];
        } elseif (mb_strlen($password) < $GLOBALS['minimum_password']) {
            return $GLOBALS['err_minimum_password'];
        } elseif (mb_strlen($password) > $GLOBALS['maximum_password']) {
            return $GLOBALS['err_maximum_password'];
        }
        // elseif (!preg_match($GLOBALS['reg_exp_password'], $password)) {
        //     return $GLOBALS['err_reg_exp_password'];
        // }

    }
    // вызываем функцию для проверки пароля
    if (validate_password($input['password'])) {
        $errors['password'] = validate_password($input['password']);
    }

    // if ($input['password']) {
    //     $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT); //Шифруем пароль в случае прохождения проверки
    // }



    // $input['image'] = $_FILES['image'];

    // function validate_image($image)
    // {

    //     // print_r($image);
    //     // list($name, $full_path, $type, $tmp_name, $error, $size) = $image;
    //     // echo $image['name'];
    //     // echo $name_img, $full_path_img, $type_img, $tmp_name_img, $error_img, $size_img;
    //     if ($image['type'] !== ('image/jpeg') && ('image/png') && ('image/gif')) {
    //         return $GLOBALS['err_type_img'];
    //     } elseif ($image['size'] > $GLOBALS['size_img_ava']) {
    //         return $GLOBALS['err_size_img'];
    //     }
    // }
    // if (validate_image($input['image'])) {
    //     $errors['image'] = validate_image($input['image']);
    // }





    // $token = random_bytes(15);
    // echo bin2hex($token);

    // mkdir('images/downloads_images/' . $input['email'], 0777); //Создаём директорию пользователя

    // $input['image'] = $_FILES['image'];
    // print_r($input['image']);
    // d($_FILES);
    // echo "<hr>";
    // d($_POST);

    // Array ( [name] => Без названия (1).jfif [full_path] => Без названия (1).jfif [type] => image/jpeg [tmp_name] => C:\xampp\tmp\php5864.tmp [error] => 0 [size] => 9929 )

    $result = [$errors, $input]; // формируем результирующий массив
    return $result; // возвращаем ошибки и данные пользователя

} // конец функции проверки формы

// function d($arr) //Функция для тестирования
// {
//     echo "<pre>";
//     print_r($arr);
//     echo "</pre><hr>";
// }

/**
 *
 * функция для отображения данных при успешной регистрации
 *
 */
function process_form($input = [])
{

    echo <<<_HTML_
        <h2>$input[first_name] $input[last_name] успешная регистрация!</h2>
        <p>Имя: $input[first_name]</p>
        <p>Фамилия: $input[last_name]</p>
        <p>Логин: $input[login]</p>
        <p>Почта: $input[email]</p>
_HTML_;
}


/**
 *
 * функция для отображения формы
 *
 */
function show_form($indices, $errors = [], $input = [])
{
    //Если не у всех полей пустой ключ// 
    if ($errors) {
        for ($i = 0; $i <= count($indices) - 1; $i++) {
            if (!array_key_exists($indices[$i], $errors)) {
                $errors[$indices[$i]] = $GLOBALS['ok_input'];
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
        
    <!doctype html>
    <html>

        <body>
            <form action="" method="POST" enctype="multipart/form-data">
                <h2>Регистрация</h2>
        
                <div class="first_name">
                    <label for="first_name">Имя:</label>
                    <input type="text" id="fname" name="first_name" value="$input[first_name]" placeholder="$GLOBALS[placeholder_f_l_name]">
                    <span id="fname-e">$errors[first_name]</span>
                </div>
            
            <div class="last_name">
                    <label for="last_name">Фамилия:</label>
                    <input type="text" id="lname" name="last_name" value="$input[last_name]" placeholder="$GLOBALS[placeholder_f_l_name]">
                    <span id="lname-e">$errors[last_name]</span>
            </div>
            
            <div class="login">
                    <label for="login">Логин:</label>
                    <input type="text" id="lgn" name="login" value="$input[login]" placeholder="$GLOBALS[placeholder_login]">
                    <span id="login-e">$errors[login]</span>
            </div>
            
            <div class="email">
                    <label for="email">Электронная почта:</label>
                    <input type="email" id="email" name="email" value="$input[email]" placeholder="$GLOBALS[placeholder_email]">
                    <span id="email-e">$errors[email]</span>
            </div>
            
            <div class="password">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" value="$input[password]" placeholder="$GLOBALS[placeholder_password]">
                    <span id="password-e">$errors[password]</span>
            </div>
            
            <input type="submit" name="action" value="Зарегистрироваться">  
        
            </form>
    <script>
                                                                        
    const backgroundColor = '$GLOBALS[backgroundColor]';
    let noRuExp = '$GLOBALS[no_ru_exp]';
    const minNum = '$GLOBALS[minimum_letters]';
    const maxNum = '$GLOBALS[maximum_letters]';
    const errName = '$GLOBALS[err_maximum_letters] $GLOBALS[err_minimum_letters]';
    let regExpName = '$GLOBALS[reg_exp]';
    const errRegExpName = '$GLOBALS[err_reg_exp]';

    const minLogin = '$GLOBALS[minimum_login]';
    const maxLogin = '$GLOBALS[maximum_login]';
    const errLogin = '$GLOBALS[err_maximum_login] $GLOBALS[err_minimum_login]'; 
    let regExpLogin =  '$GLOBALS[reg_exp_login]';                                      
    const errRegExpLogin ='$GLOBALS[err_reg_exp_login]';

    const minEmail = '$GLOBALS[minimum_email]';
    const maxEmail ='$GLOBALS[maximum_email]';
    const errEmail ='$GLOBALS[err_maximum_email] $GLOBALS[err_minimum_email]'; 
    let regExpEmail = '$GLOBALS[reg_exp_email]';
    const errRegExpEmail ='$GLOBALS[err_reg_exp_email]';

    const minPassword = '$GLOBALS[minimum_password]';
    const maxPassword = '$GLOBALS[maximum_password]';
    const errPassword = '$GLOBALS[err_maximum_password] $GLOBALS[err_minimum_password]';                                        


    </script>
        
        </body>

    </html>

    _HTML_;
}
?>
<script src="reg.js"></script>
<?php
function d($arr) //Функция для тестирования
{
    echo "<pre>";
    print_r($arr);
    echo "</pre><hr>";
}
?>