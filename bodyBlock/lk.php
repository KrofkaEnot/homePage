<?php

if (isset($_SESSION['id'])) {

    echo <<<_HTML_
        Идентификатор: $_SESSION[id]<hr>
        Почта: $_SESSION[email]<hr>
        Имя: $_SESSION[first_name]<hr>
        Фамилия: $_SESSION[last_name]<hr>
        Логин: $_SESSION[login]<hr>         
        Путь к аватару: $_SESSION[images]<hr>
        Последнее обновление учётной записи: $_SESSION[time_update]<hr>
        Регистрация учётной записи: $_SESSION[time_reg]<hr>
     
        
        
        
        
        
        
        
        
        
       
     
        _HTML_;
}


echo "<a class='nav-link active'  href='index.php?menu=exit' style='--clr:#1e9bff'><p class='exit'>Выход</p></a>";
?>


