<?php
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str){
    list($key, $value) = explode(':', $str);
    $array1[$key] = htmlspecialchars($value, ENT_QUOTES);
}
$names = array();
$courseid = $array1['courseID'];
$json_Data = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$json_Data = str_replace("var curData = ", "", $json_Data);
$json_Data = json_decode($json_Data, true);

if(gettype($json_Data["$courseid"]) != "array"){
    echo("Не хакай.");
    die();
}

$id = $array1['parentID'];
if($id < 1){
    echo("Не хакай.");
    die();
}
if($id != (int)$id){
    echo("Не хакай.");
    die();
}
$id = (int)$id;
include("bd.php");
$result1 = mysql_query("SELECT Role FROM Users WHERE ID='$id'",$db);
$myrow1 = mysql_fetch_array($result1);
if($myrow1['Role'] == 1){
    $result = mysql_query("SELECT * FROM $courseid WHERE ParentID=$id", $db);
    while($myrow = mysql_fetch_array($result)){
	    array_push($names, $myrow['ChildName'].' '.$myrow['ChildSurname']);
    }
}
if($myrow1['Role'] == 2){
    $groupname = $array1['GroupName'];
    $result2 = mysql_query("SELECT * FROM Users WHERE ID='$id'",$db);
    $myrow2 = mysql_fetch_array($result2);
    $array = explode(', ', $myrow2['Courses']);
    foreach($array as $arr){
        if($courseid = $arr){
            $result3 = mysql_query("SELECT * FROM $courseid WHERE GroupName = '$groupname'",$db);
            while($myrow = mysql_fetch_array($result3)){
                array_push($names, $myrow['ChildName'].' '.$myrow['ChildSurname']);
            }
        }
    }
}
if($myrow1['Role'] == 3){
    $groupname = $array1['GroupName'];
    $result = mysql_query("SELECT * FROM $courseid WHERE GroupName = '$groupname'", $db);
    while($myrow = mysql_fetch_array($result)){
	    array_push($names, $myrow['ChildName'].' '.$myrow['ChildSurname']);
    }
}
echo json_encode(array('answer' => true, 'names' => $names));
die();
?>