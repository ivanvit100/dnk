<?php
//Получение данных
include("bd.php");
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str) {
    list($key, $value) = explode(':', $str);
    $array1[$key] = $value;
}
$courseID = $array1['courseID'];
$parentID = (int)$array1['parentID'];
$result = mysql_query("SELECT ChildName FROM $courseID WHERE ParentID=$parentID", $db);
$names = array();
while($myrow = mysql_fetch_array($result)){
	array_push($names, $myrow['ChildName']);
}
echo json_encode(array('answer' => true, 'names' => $names));
die();
?>