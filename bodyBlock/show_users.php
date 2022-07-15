
<?php
$pdo = require 'system/connect_db.php';
$query_usr = "SELECT `id`,`first_name`,`last_name`,`login`,`email` FROM `users`";
$result = $pdo->query($query_usr);
echo "<div class='container'>";
while ($users = $result->fetch(PDO::FETCH_ASSOC)) {
    echo <<<_HTML_
    <div class='usersList'>
    
        <h2>$users[id]</h2>
        <p>Имя: $users[first_name]</p>
        <p>Фамилия: $users[last_name]</p>
        <p>Логин: $users[login]</p>
        <p>Почта: $users[email]</p>
    <form action="" method="POST">
        <input type="hidden" name="id" value="$users[id]">
        <input type="submit" name="action" value="Удалить">
    </form>
    
    </div>
    _HTML_;
}
echo "</div>";

if (isset($_POST['action']) && ($_POST['action'] === 'Удалить')) {
    $query_delete_usr = "DELETE FROM `users` WHERE id=?";
    $del_usr_result = $pdo->prepare($query_delete_usr);
    $del_usr_result->execute([htmlspecialchars(trim($_POST['id']))]);
    // header("Refresh: 0");
} else {
}
