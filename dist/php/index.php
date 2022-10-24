<?php
    session_start();
    ?>
    <html>
    <head>
    <title>Главная страница</title>
    </head>
    <body>
    <h2>Главная страница</h2>
    <form action="testreg.php" method="post">
    <p>
    <label>Ваш логин:<br></label>
    <input name="email" type="text" size="35" maxlength="35">
    </p>
    
    <p>
    <label>Ваш пароль:<br></label>
    <input name="password" type="password" size="35" maxlength="35">
    </p>

    <p>
    <input type="submit" name="submit" value="Войти">

<br>
<a href="http://dnk.ivanvit.ru/php/reg.php">Зарегистрироваться</a> 
    </p></form>
    <br>
    <?php
    if (empty($_SESSION['email']) or empty($_SESSION['id']))
    {
    echo "Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка  доступна только зарегистрированным пользователям</a>";
    }
    else
    {
    echo "Вы вошли на сайт, как ".$_SESSION['name']." ".$_SESSION['surname'];
    }
    ?>
    </body>
    </html>