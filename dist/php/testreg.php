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
if(isset($email)){
    if($email == ''){ 
        unset($email);
    } 
} 
if(isset($password)){
    if($password == ''){ 
        unset($password);
    }
}
if(empty($email) or empty($password)){ //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    echo json_encode(array('answer' => false, 'reason' => "Вы ввели не всю информацию!"));
    die();
}
$email = stripslashes($email);
$email = htmlspecialchars($email);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$email = str_replace(" ", "", $email);
$password = str_replace(" ", "", $password);
include("bd.php");

$result = mysql_query("SELECT * FROM Users WHERE Email='$email'", $db); 
$myrow = mysql_fetch_array($result);
if(password_verify($password,$myrow['Password'])){
    echo json_encode(array('answer' => true, 'name' => $myrow['Name'], 'surname' => $myrow['Surname'], 'email' => $myrow['Email'], 'id' => $myrow['ID'], 'role' => $myrow['Role']));
    die();
}else{
    echo json_encode(array('answer' => false, 'reason' => "Неверный логин или пароль!"));
    die();
}
?>