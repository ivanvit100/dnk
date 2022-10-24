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
$password = $array1['password']; //Переменная с паролем
$login = $array1['login']; //Переменная с логином
/*$fd = fopen("text.txt", 'w') or die("не удалось создать файл");
fwrite($fd, $array1['password']);
fclose($fd);*/
echo json_encode(array('a' => $login, 'b' => $password)); //Ответ
?>