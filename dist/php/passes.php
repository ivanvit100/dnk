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
$id = $array1['ID'];// Айди препода
$childName = $array1['Name'];//Имя ребенка
$course = $array1['Course'];//Курс
$pos = strpos($childName, " ");
$name = substr($childName, 0, $pos); //Имя ребенка
$surname =  substr($childName, $pos + 1, iconv_strlen($childName) - 2); //Фамилия ребенка
date_default_timezone_set('Europe/Moscow');
$date = date("d.m");

include("bd.php");

$result1 = mysql_query("SELECT Role FROM Users WHERE ID = '$id'",$db);
$myrow1 = mysql_fetch_array($result1);
if ($myrow1['Role'] == 2){
    $result2 = mysql_query("SELECT ParentID FROM $course WHERE ChildName = '$name' and ChildSurname ='$surname'",$db);
    $myrow2 = mysql_fetch_array($result2);
    $ParentID = $myrow2['ParentID'];
    $result3 = mysql_query("SELECT * FROM Users WHERE ID ='$ParentID'");
    $myrow3 = mysql_fetch_array($result3);
    $PassThree = $myrow3['PassThree'];
    $PassTwo = $myrow3['PassTwo'];
    $PassOne = $name.
    $result4 = mysql_query("UPDATE Users SET PassThree = '$'");
    die();
}else{
    echo json_encode(array('answer' => false, 'text' => 'Вы не имеете права на данное действие'));
    die();
}
?>