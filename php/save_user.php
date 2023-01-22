<?php
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str) {
    list($key, $value) = explode(':', $str);
    $array1[$key] = $value;
}
$password = $array1['password'];
$email = $array1['login'];
$name = $array1['name'];
$surname = $array1['surname'];
$phone = $array1['phone'];

$phoneTest = ltrim($phone, '+');

if(isset($email)){
    if(stristr($email, '@') === false || stristr($email, '.') === false) {
        echo json_encode(array('answer' => false, 'reason' => 'Неверная почта!'));
        die();
    }
}
if(isset($password)){
    if($password == ''){ 
        echo json_encode(array('answer' => false, 'reason' => 'Неверный пароль!'));
        die();
    } 
}
if(iconv_strlen($name)<2){ 
    echo json_encode(array('answer' => false, 'reason' => 'Неверное имя!'));
    die();
}
if(iconv_strlen($surname)<2){  
    echo json_encode(array('answer' => false, 'reason' => 'Неверная фамилия!'));
    die();
}
if(iconv_strlen($phone)<11 or iconv_strlen(str_replace(" ", "", $phone))<11 or iconv_strlen($phone)>12 or !preg_match("/^([0-9])+$/", $phoneTest)){  
    echo json_encode(array('answer' => false, 'reason' => 'Неверный номер телефона!'));
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
$email = str_replace(" ", "", $email);
$password = str_replace(" ", "", $password);
$name = str_replace(" ", "", $name);
$surname = str_replace(" ", "", $surname);
$phone = str_replace(" ", "", $phone);
include("bd.php");
$result = mysql_query("SELECT ID FROM Users WHERE Email='$email'", $db);
$myrow = mysql_fetch_array($result);
if(($myrow['ID'] ?? -1) >= 0){
    echo json_encode(array('answer' => false, 'reason' => 'Такой аккаунт уже существует!'));
    die();
}
$options = [
    'cost' => 14,
];
$password = password_hash($password, PASSWORD_BCRYPT, $options);
$result2 = mysql_query("INSERT INTO Users (Email,Password,Name,Surname,Phone) VALUES('$email','$password','$name','$surname','$phone')");
if($result2=='TRUE'){
    $resultId = mysql_query("SELECT ID FROM Users WHERE Email='$email'", $db);
    $myrowId = mysql_fetch_array($resultId);
    echo json_encode(array('answer' => true, 'reason' => 'Вы успешно зарегистрированы!', 'id' => $myrowId['ID']));
    die();
}else{
    echo json_encode(array('answer' => false, 'reason' => 'Ошибка! Вы не зарегистрированы.'));
    die();
}
?>