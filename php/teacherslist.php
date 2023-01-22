<?php
include("bd.php");
$json_Data = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$json_Data = str_replace("var curData = ", "", $json_Data);
$json_Data = json_decode($json_Data, true);

$names = array();
$names1 = "";
$list = array();
$array1 = array();
$array2 = array();
foreach($json_Data as $str){
    $course = $str["courseId"];
    $result = mysql_query("SELECT * FROM Users WHERE Role=2",$db);
    array_push($names, $course.":");
    while($myrow = mysql_fetch_array($result)){
        $courseslist = explode(', ', $myrow['Courses']);
        foreach($courseslist as $arr){
            if($arr == $course){
                array_push($names, $myrow['Surname'].' '.$myrow['Name'].", ");
            }
        }
    }
    array_push($names,"; ");
}
foreach($names as $arr1){
    $names1 = $names1.$arr1;
}
$names1 = str_replace(", ;", ";", $names1);
$namesex = explode(";", $names1);
foreach($namesex as $arr2){
    $pos = mb_strpos($arr2, ":");
    $courseid = mb_substr($arr2, 0, $pos);
    $nameslist =  mb_substr($arr2, $pos + 1, iconv_strlen($arr2) - 1);
    if($nameslist != ""){
        array_push($list, $courseid.":".$nameslist.";");
    }
}
foreach($list as $arr10){
    $list1 = $list1.$arr10;
}
echo json_encode(array('answer' => true, 'teachers' => $list1,),JSON_UNESCAPED_UNICODE);
die();
?>