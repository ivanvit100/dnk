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
$course = $array1['courseID']; //Курс/таблица
$pid = $array1['parentID']; //Айди родителя
$childName = $array1['childName']; //Айди ребенка
$id = $array1['ID']; // Айди пользователя(Админ)
$cid = $array1['cID']; // Айди ребенка(В этой строчке вообще не уверен,ибо не знаю как фронтэнд работает)
include ("bd.php");

$resultadm = mysql_query("SELECT * FROM Users WHERE ID='$id'", $db);
$myrowadm = mysql_fetch_array($resultadm);
if($myrowadm['Role'] != 3){
    echo json_encode(array('answer' => false, 'reason' => 'Вы не имеете доступа к админ панели!')); //Ответ
    die();
}

$result0 = mysql_query("SELECT Courses FROM Users WHERE ID='$pid'");
$myrow = mysql_fetch_array($result0);
$pcourse = $myrow['Courses'];// Строка с Users с курсами
$result = mysql_query("DELETE FROM $course WHERE ParentID='$pid' AND ChildName='$childName'", $db);
if($result === false){
    echo json_encode(array('answer' => false));
    die();
}
$result9 = mysql_query("SELECT * FROM $course WHERE ParentID='$pid'");
if($result9 === false){
    echo json_encode(array('answer' => true));
    die();
}
if($pcourse = $course){
    $void = "";
    $result1 = mysql_query("UDPATE Users SET Courses = '$void' WHERE ID = '$pid'");
    echo json_encode(array('answer' => true));
    die();
}else{
    $newcourse = str_replace($course.", ", "", $course);
    $result1 = mysql_query("UPDATE Users SET Courses = '$newcourse' WHERE ID = '$pid'");
    echo json_encode(array('answer' => true));
    die();
}
?>