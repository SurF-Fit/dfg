<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/index.css">
    <title>CallHub  </title>
</head>
<body>
<header>
    <nav>
        <div>
            <a href="<?= app()->route->getUrl('/hello') ?>">CallHub</a>
            <div>
                <a href="tel:+79738895257">89738895257</a>
                <a href="tel:+79739894257">89739894257</a>
                <?php
                if (!app()->auth::check()):
                    ?>
                    <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                    <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
                <?php
                else:
                    ?>
                    <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
                <?php
                endif;
                ?>
            </div>
        </div>
        <hr>
        <div>
            <?php
            if(isset(app()->auth::user()->role)):
                if (app()->auth::user()->role == 1):
                    ?>
                    <a href="<?= app()->route->getUrl('/addsis') ?>">добавить сиса</a>
                <?php
                endif;
                ?>
                <?php
                if (app()->auth::user()->role == 2):
                    ?>
                    <div class="desktop-menu">
                        <div class="add-button">
                            Добавить ▼
                            <div class="dropdown-menu">
                                <a href="<?= app()->route->getUrl('/createSubscribers') ?>">Добавить абонента</a>
                                <a href="<?= app()->route->getUrl('/createRoom') ?>">Добавить помещение</a>
                                <a href="<?= app()->route->getUrl('/createSubdivision') ?>">Добавить подразделение</a>
                                <a href="<?= app()->route->getUrl('/createPhone') ?>">Добавить телефон</a>
                                <a href="<?= app()->route->getUrl('/attachPhone') ?>">Прикрепить абонента к номеру</a>
                            </div>
                        </div>
                    </div>
                    <a href="<?= app()->route->getUrl('/phonesBySubdivision') ?>">выбрать номера абонента по подразделениям</a>
                    <a href="<?= app()->route->getUrl('/selectPhone') ?>">выбрать все номера абонента</a>
                    <a href="<?= app()->route->getUrl('/selectsubscriber') ?>">подсчитать количество абонентов</a>
                <?php
                endif;
            else:
            ?>
                <p>Сначала пройди регистрацию\авторизацию и дождитесь одобрения администратора</p>
            <?php
            endif;
            ?>
        </div>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>
