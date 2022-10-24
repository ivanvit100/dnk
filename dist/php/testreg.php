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

session_start();
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
    //exit("Вы ввели не всю информацию, вернитесь назад и заполните все поля!")
}
$email = stripslashes($email);
$email = htmlspecialchars($email);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$email = trim($email);
$password = trim($password);
include("bd.php");
 
$result = mysql_query("SELECT * FROM Users WHERE Email='$email'", $db); 
$myrow = mysql_fetch_array($result);
if(empty($myrow['Password'])){
    echo json_encode(array('answer' => false, 'reason' => "Введённая вами почта или пароль введены неверно!"));
    //exit("Извините, введённая вами почта или пароль введены неверно.")
}else{
    if($myrow['Password'] == $password){
        $_SESSION['email'] = $myrow['Email']; 
        $_SESSION['id'] = $myrow['ID'];
        $_SESSION['name'] = $myrow['Name'];
        $_SESSION['surname'] = $myrow['Surname'];
        echo json_encode(array('answer' => true));
    }else{
        echo json_encode(array('answer' => false, 'reason' => "Введённая вами почта или пароль введены неверно!"));
        //exit("Извините, введённая вами почта или пароль введены неверно.")
    }
}
?>