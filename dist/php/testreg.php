<?php
    session_start();
if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} } 
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
   
if (empty($email) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
$password = stripslashes($password);
    $password = htmlspecialchars($password);
    $email = trim($email);
    $password = trim($password);
    include ("bd.php");
 
$result = mysql_query("SELECT * FROM Users WHERE Email='$email'",$db); 
    $myrow = mysql_fetch_array($result);
    if (empty($myrow['Password']))
    {
    exit ("Извините, введённая вами почта или пароль введены неверно.");
    }
    else {
    if ($myrow['Password']==$password) {
    $_SESSION['email']=$myrow['Email']; 
    $_SESSION['id']=$myrow['ID'];
    $_SESSION['name']=$myrow['Name'];
    $_SESSION['surname']=$myrow['Surname'];
    echo "Вы успешно вошли на сайт! <a href='http://dnk.ivanvit.ru'>Главная страница</a>";
    }
 else {

    exit ("Извините, введённая вами почта или пароль введены неверно.");
    }
    }
    ?>