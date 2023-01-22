<?php
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str) {
    list($key, $value) = explode(':', $str);
    $array1[$key] = htmlspecialchars($value);
}
$id = $array1['teachID'];
if($id != (int)$id){
    echo("Не хакай.");
    die();
}
if((int)$id < 0){
    echo("Не хакай.");
    die();
}
$childName = $array1['childName'];
if((int)$childName != ""){
    echo("Не хакай.");
    die();
}
$course = $array1['courseID'];
$json_Data = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$json_Data = str_replace("var curData = ", "", $json_Data);
$json_Data = json_decode($json_Data, true);
if(gettype($json_Data["$course"]) != "array"){
    echo("Не хакай.");
    die();
}
$pos = mb_strpos($childName, " ");
$name = mb_substr($childName, 0, $pos);
$surname =  mb_substr($childName, $pos + 1, iconv_strlen($childName) - 1);
date_default_timezone_set('Europe/Moscow');
$date = date("d.m");
$title = $json_Data["$course"]["title"];

include("bd.php");

$result1 = mysql_query("SELECT Role FROM Users WHERE ID = '$id'",$db);
$myrow1 = mysql_fetch_array($result1);
if ($myrow1['Role'] == 2){
    $result2 = mysql_query("SELECT ParentID FROM $course WHERE ChildName = '$name' and ChildSurname ='$surname'",$db);
    $myrow2 = mysql_fetch_array($result2);
    $ParentID = $myrow2['ParentID'];
    $result3 = mysql_query("SELECT * FROM Users WHERE ID ='$ParentID'");
    $myrow3 = mysql_fetch_array($result3);
    $PassThree = $myrow3['PassTwo'];
    $PassTwo = $myrow3['PassOne'];
    $PassOne = $title."-".$name."-".$date;
    $result4 = mysql_query("UPDATE Users SET PassThree = '$PassThree' WHERE ID ='$ParentID'");
    $result5 = mysql_query("UPDATE Users SET PassTwo = '$PassTwo' WHERE ID ='$ParentID'");
    $result6 = mysql_query("UPDATE Users SET PassOne = '$PassOne' WHERE ID ='$ParentID'");
    echo json_encode(array('answer' => true, 'reason' => 'Пропуск успешно отмечен!'),JSON_UNESCAPED_UNICODE);
    die();
}else{
    echo json_encode(array('answer' => false, 'text' => 'Вы не имеете права на данное действие'));
    die();
}
?>