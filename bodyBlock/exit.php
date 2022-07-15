<?php
// session_start();
if ($_SESSION['authorized'] === 1) {
    unset($_SESSION['authorized']);
    unset($_SESSION['id']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['login']);
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    unset($_SESSION['images']);
    unset($_SESSION['time_update']);
    unset($_SESSION['time_reg']);
    header('Location: /');
} else {
    header('Location: /');
}
