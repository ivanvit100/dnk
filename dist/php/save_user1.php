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
$surname = $array1['surname']; //Фамилия
$phone = $array1['phone']; //Номер телефона

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
if(isset($phone)){ 
    if($phone == ''){ 
        unset($phone);
    } 
}
if(empty($email) or empty($password) or empty($name) or empty($surname) or empty($phone)){
    echo json_encode(array('answer' => false, 'reason' => 'Вы заполнили не все поля!')); //Ответ
    die();
}
$email = stripslashes($email);
$email = htmlspecialchars($email);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$name = stripslashes($name);
$name = htmlspecialchars($name);
$surname = stripslashes($surname);
$surname = htmlspecialchars($surname);
$phone = stripslashes($phone);
$phone = htmlspecialchars($phone);
$email = trim($email);
$password = trim($password);
$name = trim($name);
$surname = trim($surname);
$phone = trim($phone);
$phoneTest = ltrim($phone, '+');
if(strlen($phone) < 11 or strlen($phone) > 12 or !preg_match("/^([0-9])+$/", $phoneTest)){
    echo json_encode(array('answer' => false, 'reason' => 'Неверный номер телефона!')); //Ответ
    die();
}
include("bd.php");
$result = mysql_query("SELECT ID FROM Users WHERE Email='$email'", $db);
$myrow = mysql_fetch_array($result);
if(($myrow['ID'] ?? -1) >= 0){
    echo json_encode(array('answer' => false, 'reason' => 'Такой аккаунт уже существует!')); //Ответ
    die();
}
$result2 = mysql_query("INSERT INTO Users (Email,Password,Name,Surname,Phone) VALUES('$email','$password','$name','$surname','$phone')");
if($result2=='TRUE'){
    $resultId = mysql_query("SELECT ID FROM Users WHERE Email='$email'", $db);
    $myrowId = mysql_fetch_array($resultId);
    echo json_encode(array('answer' => true, 'reason' => 'Вы успешно зарегистрированы!', 'id' => $myrowId['ID'])); //Ответ
    die();
}else{
    echo json_encode(array('answer' => false, 'reason' => 'Ошибка! Вы не зарегистрированы.')); //Ответ
    die();
}
?>