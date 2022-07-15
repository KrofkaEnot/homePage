<!DOCTYPE html>
<html lang="ru">

<?php
session_start();
$pdo = require 'system/connect_db.php';
?>

<head>
    <?php
    include('headBlock/head.php');
    ?>
</head>

<body>
    <div class="globalSite">
        <div class="localSite">
            <div class="headerBlock">
                <?php
                include('nav/menu.php');
                ?>
                <div class="theme">
                    <?php
                    include('nav/theme.php');
                    ?>
                </div>
            </div>
            <div class="bodyBlock">
                <div class="text">
                    <?php
                    if (isset($_GET['menu']) && $_GET['menu'] === 'show_news') {
                        $param = 'bodyBlock/show_news.php';
                    } elseif (isset($_GET['menu']) && $_GET['menu'] === 'show_users') {
                        $param = 'bodyBlock/show_users.php';
                    } elseif (isset($_GET['menu']) && $_GET['menu'] === 'reg') {
                        $param = 'bodyBlock/reg.php';
                    } elseif (isset($_GET['menu']) && $_GET['menu'] === 'lk') {
                        $param = 'bodyBlock/lk.php';
                    } elseif (isset($_GET['menu']) && $_GET['menu'] === 'demo') {
                        $param = 'bodyBlock/demo.php';
                    } elseif (isset($_GET['menu']) && $_GET['menu'] === 'doctor') {
                        $param = 'bodyBlock/doctor.php';
                    } elseif (isset($_GET['menu']) && $_GET['menu'] === 'file') {
                        $param = 'bodyBlock/file.php';
                    } elseif (isset($_GET['menu']) && $_GET['menu'] === 'auth') {
                        $param = 'bodyBlock/auth.php';
                    } elseif (isset($_GET['menu']) && $_GET['menu'] === 'exit') {
                        $param = 'bodyBlock/exit.php';
                    } else {

                        $param = 'bodyBlock/body.php';
                    }

                    include($param);

                    ?>

                </div>
            </div>
            <div class="footerBlock">
                <div class="text">
                    <?php
                    include('footerBlock/footer.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('footerBlock/script.php');
    ?>
   

</body>
<script src="js/theme.js"></script>

</html>