<?php
//Получение данных
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str){
    list($key, $value) = explode(':', $str);
    $array1[$key] = $value;
}
$names = array();
$emails = array();
$courseid = $array1['courseID'];
$id = (int)$array1['userID'];
include("bd.php");
$result1 = mysql_query("SELECT Role FROM Users WHERE ID='$id'",$db);
echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
$myrow1 = mysql_fetch_array($result1);
if($myrow1['Role'] == 3){
    $result = mysql_query("SELECT * FROM Users WHERE Role=2", $db);
    echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
    while($myrow = mysql_fetch_array($result)){
        if(!strripos($myrow['Courses'], $courseid) && gettype(strripos($myrow['Courses'], $courseid)) == "integer"){
            array_push($names, $myrow['Surname'].' '.$myrow['Name']);
            array_push($emails, $myrow['Email']);
        }
    }
}
echo json_encode(array('answer' => true, 'names' => $names, 'emails' => $emails));
die();
?>