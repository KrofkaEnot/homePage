<form enctype="multipart/form-data" method="POST" action="">
    <label for="file">Выберите файлы:</label>
    <input type="file" name="file[]" multiple>
    <input type="submit" name="action" value="Загрузить файлы">
</form>

<?php
// $pdo = require 'system/connect_db.php'; //Получим файл с параметрами подключения к БД


if ($_SERVER['REQUEST_METHOD'] == 'POST') { //При нажатии кнопки отправки изображения методом POST
    list($errors, $valid_files) = photo_meta($pdo); //Сработает функция фильтрации метаданных и вернёт информацию

    if ($errors) { //Если массив с ошибками имеет в себе значения (не пустой)
        echo "<hr>";
        echo 'Проблемные загрузки:';
        show_errors($errors); //Покажет имена ($name) имеющие ошибки
        echo "<hr>";
    } else {
        echo 'Ошибок при загрузке не обнаружено.'; //Выдаст информационное сообщение если массив с ошибками оказался пустым
    }

    if ($valid_files) { //Если массив с отфильтрованными значениями не пустой
        echo "<hr>";
        echo "Удачные загрузки:";
        show_valid($valid_files); //Покажет имена ($name) прошедших проверку файлов
        fucking_database_entry($valid_files, $pdo); //Проверит наличие таблицы (данных о загружаемых фалах) в случае отсутствия создаст её
        echo "<hr>";
    } else {
        echo 'Удачных загрузок не обнаружено.'; //Информационное сообщение в случае отсутствия файлов подлежащих добавлению
    }
}

function show_errors($errors)
{
    foreach ($errors as  $value_errors) {
        foreach ($value_errors as  $value_value_errors) {
            echo '<br>';
            echo $value_value_errors;
        }
    }
}
function show_valid($valid_files)
{
    foreach ($valid_files as  $value_valid_files) {
        echo "<br>" . $value_valid_files[0];
    }
}

function fucking_database_entry($valid_files, $pdo)
{
    try { //Проверка наличия таблицы с изображениями и создание в случае отсутствия
        $query_img = "SELECT `path` FROM `loads_images`";
        $pdo->query($query_img); //Попытка запроса в БД
    } catch (PDOException $e) {
        create_table_downloads_images($pdo); //В случае ошибки попытка создания таблицы
    }
    $insert_img = "INSERT INTO `loads_images` (name,full_path,path,size,users_id) VALUES(:name,:full_path,:path,:size,:users_id)"; //Запрос помещения в базу информации о файле
    $result_insert_img = $pdo->prepare($insert_img);
    foreach ($valid_files as $value_valid_files) {
        // $new_name =  $value_valid_files['5'] . "_" . $value_valid_files['0']; //Создаём новое имя файла, переименование путём добавления размера в начало файла
        $exp = explode(".", $value_valid_files['0']); //Вычисляем расширение файла
        $ext = "." . end($exp); //Добавляем точку
        $new_name =  $value_valid_files['5'] . "_" . $value_valid_files['6'] . "_" . $value_valid_files['7'] . $ext; //Создаём новое имя файла, переименование путём добавления размера в начало файла и добавления параметров размера

        // mkdir('images/downloads_images/usr/', 0777);
        // $eml = 'mak@ya.ru';
        // mkdir('images/downloads_images/' . $eml , 0777);

        move_uploaded_file($value_valid_files['3'], 'images/downloads_images/' . $new_name); //Перенесём из временных файлов в папку назначения
        $result_insert_img->bindParam(':name', $new_name); //Подготовим в базу имена
        $full_path = $_SERVER['HTTP_HOST'] . '/images/downloads_images/' . $new_name; //Подготовим переменную с относительным путём
        $result_insert_img->bindParam(':full_path',  $full_path); //Подготовим в базу полный путь 
        $path = '/images/downloads_images/' . $new_name; //Подготовим перменную с относительным путём 
        $result_insert_img->bindParam(':path',  $path); //Подготовим в базу относительный путь 
        $size = $value_valid_files['5']; //Подготовим переменную с размером
        $result_insert_img->bindParam(':size',  $size); //Подготовим в базу размер
        $result_insert_img->bindParam(':users_id',  $_SESSION['id']);
        $result_insert_img->execute(); //Занесём в базу
    }
    // d($valid_paths);
    // return $valid_paths;
}
// list($name, $full_path, $type, $tmp_name, $error, $size) = $first_names;
// echo $name . " " . $full_path . " " . $type . " " . $tmp_name . " " . $error . " " . $size . " ";


function view_img($pdo) //Отображение картинок на странице
{
    try {
        $query_img = "SELECT `name`,`full_path`,`path`,`size`,`users_id` FROM `loads_images`"; //Подготовка запроса
        $result_query_img = $pdo->query($query_img);
        echo "<div class='imgZone'>";
        while ($img = $result_query_img->fetch(PDO::FETCH_ASSOC)) { //Перебор изображений для отображения
            echo <<<_HTML_
        <div class="miniBlockImg">
        <img class="viewImg" src="$img[path]" alt="img">
        </div>
    _HTML_;
        }
        echo "</div>";
    } catch (PDOException $e) {
        create_table_downloads_images($pdo); //В случае ошибки попытка создания таблицы
    }
}

function create_table_downloads_images($pdo)
{
    $create_table_downloads_images = "CREATE TABLE IF NOT EXISTS loads_images(
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        full_path VARCHAR(255) NOT NULL,
        path VARCHAR(255) NOT NULL,
        size INT(255) NOT NULL,
        users_id INT NOT NULL,
    FOREIGN KEY (users_id) REFERENCES users (id)
    )";
    $pdo->exec($create_table_downloads_images);
}

function photo_meta($pdo)
{
    $errors = [];
    $valid_files = [];
    foreach ($_FILES as $arr_name_input) { //Переберём в цикле файлы
        foreach ($arr_name_input as $value_arr) { //Получим параметры каждого файла   
        }
    }
    //_____________________________________________________________//
    function name_fucking_check($name) //Проверим имя
    {
        if (empty($name)) {
            return 'Должен быть загружен хотя бы один файл.';
        }
    }
    //_____________________________________________________________//
    function fucking_type_entry($type, $name) //Проверим тип
    {
        if ($type !== ('image/jpeg') && ('image/png')) {
            return 'Тип файла ' . $name . ' не подходит для загрузки.';
        }
    }
    //_____________________________________________________________//
    function fucking_error_entry($error, $name) //Проверим ошибки загрузки
    {
        if ($error !== 0) {
            return 'У файла ' . $name . ' прочие ошибки.';
        }
    }
    //_____________________________________________________________//
    function fucking_size_entry($size, $name) //Какой размер?
    {
        if ($size > 5631488) {
            return 'Размер ' . $name . ' более 5 мб.';
        }
    }
    //_____________________________________________________________//
    function fucking_file_existence_entry($pdo, $size, $name) //Происходит запрос в БД для проверки на наличие похожего размера
    {
        $query_img_existence = "SELECT `size` FROM `loads_images` WHERE `size` IN ($size)"; //Подготовка запроса размера
        $img_existence = $pdo->query($query_img_existence);
        $img_existence = $img_existence->fetch(PDO::FETCH_ASSOC);
        if ($img_existence) { //Он будет нести в себе что-то если размерчик подойдёт одному из файлов
            return 'Кажется ' . $name . ' уже существует.';
        }
    }
    //_____________________________________________________________//

    //_____________________________________________________________//

    for ($i = 0; $i <= count($value_arr) - 1; $i++) { //По параметрам считаем колличество файлов для правильной итерации

        $arr_str = array_column($arr_name_input, $i); //Переопределяем массив в удобное для дальнейшей обработки состояние

        list($name, $full_path, $type, $tmp_name, $error, $size) = $arr_str; //Раскладываем массив в переменные

        $name = htmlspecialchars(trim($name)); //Перезапись имени файла с экранированием

        //_________________Вызываем поочерёдно каждую функцию проверки__________________//
        //_________________Срабатывание функции пополняет массив error__________________//
        if (name_fucking_check($name)) { //Вызов функции проверки имени
            $errors[$i]['name'] = name_fucking_check($name); //Добавляем в массив ошибок ошибку по файлу
            continue; //Прекращаем работу с файлом в случае срабатывания функции
        } elseif (fucking_type_entry($type, $name)) {
            $errors[$i]['type'] = fucking_type_entry($type, $name); //Добавляем в массив ошибок ошибку по файлу $name - для именования файла
            continue; //Прекращаем работу с файлом в случае срабатывания функции
        } elseif (fucking_error_entry($error, $name)) {
            $errors[$i]['error'] = fucking_error_entry($error, $name); //Добавляем в массив ошибок ошибку по файлу $name - для именования файла
            continue; //Прекращаем работу с файлом в случае срабатывания функции
        } elseif (fucking_size_entry($size, $name)) {
            $errors[$i]['size'] = fucking_size_entry($size, $name); //Добавляем в массив ошибок ошибку по файлу $name - для именования файла
            continue; //Прекращаем работу с файлом в случае срабатывания функции
        } elseif (fucking_file_existence_entry($pdo, $size, $name)) {
            $errors[$i]['existence'] = fucking_file_existence_entry($pdo, $size, $name); //Добавляем в массив ошибок ошибку по файлу $name - для именования файла
            continue; //Прекращаем работу с файлом в случае срабатывания функции
        }
        //_____________________________________________________________//
        list($width, $height, $type_img, $attr) = getimagesize($tmp_name);
        //_____________________________________________________________//
        array_push($valid_files, [$name, $full_path, $type, $tmp_name, $error, $size, $width, $height]); //Собираем параметры прошедших проверку файлов в массив
    }
    $result = [$errors, $valid_files]; //Запаковываем масивы в массив 
    return $result; //И отправляем голубиной почтой
}
echo "<hr>";
view_img($pdo) //Вызываем функцию отображения изображений
?>

<?php
function d($arr) //Функция для тестирования
{
    echo "<pre>";
    print_r($arr);
    echo "</pre><hr>";
}
?>