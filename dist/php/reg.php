<html>
    <head>
    <title>Регистрация</title>
    </head>
    <body>
    <h2>Регистрация</h2>
    <form action="save_user.php" method="post">
<p>
    <label>Имя:<br></label>
    <input name="name" type="text" size="35" maxlength="35">
    </p>
    <p>
    <label>Фамилия:<br></label>
    <input name="surname" type="text" size="35" maxlength="35">
    </p>
    <p>
    <label>Почта:<br></label>
    <input name="email" type="text" size="35" maxlength="35">
    </p>
<p>
    <label>Пароль:<br></label>
    <input name="password" type="password" size="35" maxlength="35">
    </p>
<p>
    <input type="submit" name="submit" value="Зарегистрироваться">
</p></form>
    </body>
    </html>