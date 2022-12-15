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
$courseid = $array1['courseID'];
$id = (int)$array1['parentID'];
include("bd.php");
$result1 = mysql_query("SELECT Role FROM Users WHERE ID='$id'",$db);
echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
$myrow1 = mysql_fetch_array($result1);
if($myrow1['Role'] == 1){
    $result = mysql_query("SELECT * FROM $courseid WHERE ParentID=$id", $db);
    echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
    while($myrow = mysql_fetch_array($result)){
	    array_push($names, $myrow['ChildName'].' '.$myrow['ChildSurname']);
    }
}
if($myrow1['Role'] == 2){
    $result2 = mysql_query("SELECT * FROM Users WHERE ID='$id'",$db);
    echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
    $myrow2 = mysql_fetch_array($result2);
    $array = explode(', ', $myrow2['Courses']);
    foreach($array as $arr){
        if($courseid = $arr){
            $result3 = mysql_query("SELECT * FROM $courseid",$db);
            while($myrow = mysql_fetch_array($result3)){
                array_push($names, $myrow['ChildName'].' '.$myrow['ChildSurname']);
            }
        }
    }
}
if($myrow1['Role'] == 3){
    $result = mysql_query("SELECT * FROM $courseid", $db);
    echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
    while($myrow = mysql_fetch_array($result)){
	    array_push($names, $myrow['ChildName'].' '.$myrow['ChildSurname']);
    }
}
echo json_encode(array('answer' => true, 'names' => $names));
die();
?>