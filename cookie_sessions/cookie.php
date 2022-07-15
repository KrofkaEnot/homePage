<?php
if (isset($_COOKIE['theme'])) {
    echo 'Theme is true';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $theme = $_POST['theme'];
        setcookie('theme', $theme, time() + 3600000);
    }
}
