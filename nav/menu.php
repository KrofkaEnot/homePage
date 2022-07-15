<nav class="navbar bg-transparent navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <span id="marker"></span>


                



                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/" style="--clr:#1e9bff">Главная</a>
                </li>


                <?php if (!isset($_SESSION['id'])) : ?>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?menu=auth" style="--clr:#1e9bff">Авторизация</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?menu=reg" style="--clr:#1e9bff">Регистрация</a>
                    </li>

                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?menu=show_news" style="--clr:#1e9bff">Новости</a>
                </li>

                <?php if (isset($_SESSION['id'])) : ?>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?menu=lk" style="--clr:#1e9bff">Кабинет</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?menu=file" style="--clr:#1e9bff">Файлы</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?menu=show_users" style="--clr:#1e9bff">Пользователи</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?menu=doctor" style="--clr:#1e9bff">Доктор</a>
                    </li>
                <?php endif; ?>








            </ul>
        </div>
    </div>
</nav>