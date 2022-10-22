<?php
//Получение данных
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str) {
    list($key, $value) = explode(':', $str);
    $array1[$key] = $value;
}
$password = $array1['password']; //Пароль
$email = $array1['login']; //Почта
$name = $array1['name']; //Имя
$surname = $array1['lastname']; //Фамилия


$fd = fopen("text.txt", 'w') or die("не удалось создать файл");
fwrite($fd, $name);
fclose($fd);


if(isset($email)){
    if(stristr($email, '@') === FALSE || stristr($email, '.') === FALSE) {
        unset($email);
    } 
}
if(isset($password)){
    if($password == ''){ 
        unset($password);
    } 
}
if(isset($name)){ 
    if($name == ''){ 
        unset($name);
    } 
}
if(isset($surname)){ 
    if($surname == ''){ 
        unset($surname);
    } 
}
if(empty($email) or empty($password) or empty($name) or empty($surname)){
    echo json_encode(array('answer' => 'false', 'reason' => 'Вы заполнитли не все поля!')); //Ответ
    exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
}
$email = stripslashes($email);
$email = htmlspecialchars($email);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$name = stripslashes($name);
$name = htmlspecialchars($name);
$surname = stripslashes($surname);
$surname = htmlspecialchars($surname);
$email = trim($email);
$password = trim($password);
$name = trim($name);
$surname = trim($surname);
include("bd.php");
$result = mysql_query("SELECT ID FROM Users WHERE Email='$email'", $db);
$myrow = mysql_fetch_array($result);
if(!empty($myrow['ID'])){
    echo json_encode(array('answer' => 'false', 'reason' => 'Такой аккаунт уже существует!')); //Ответ
    exit("Извините, введённая вами почта уже зарегистрирована.");
}
$result2 = mysql_query("INSERT INTO Users (Email,Password,Name,Surname) VALUES('$email','$password','$name','$surname')");
if($result2=='TRUE'){
    echo json_encode(array('answer' => 'true', 'reason' => 'Вы успешно зарегистрированы!')); //Ответ
    //echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='http://dnk.ivanvit.ru/'>Главная страница</a>";
}else{
    echo json_encode(array('answer' => 'false', 'reason' => 'Ошибка! Вы не зарегистрированы.')); //Ответ
    //echo "Ошибка! Вы не зарегистрированы.";
}
?>