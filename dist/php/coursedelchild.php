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
$pid = $array1['parentID']; //Айди родителя/админа
$childName = $array1['childName']; //Имя ребенка
$pos = strpos($childName, " ");
$name = substr($childName, 0, $pos); //Имя ребенка
$surname =  substr($childName, $pos + 1, iconv_strlen($childName) - 2); //Фамилия ребенка

include ("bd.php");
$result999 = mysql_query("SELECT Role FROM Users WHERE ID = '$pid'");
$myrow999 = mysql_fetch_array($result999);
if ($myrow999['Role'] == 2){
    echo json_encode(array('answer' => false));
    die();
}
if ($myrow999['Role'] == 1){
    $result0 = mysql_query("SELECT Courses FROM Users WHERE ID='$pid'");
    $myrow = mysql_fetch_array($result0);
    $pcourse = $myrow['Courses'];// Строка с Users с курсами
    $result = mysql_query("DELETE FROM $course WHERE ParentID='$pid' AND ChildName='$name'", $db);
    if($result === false){
        echo json_encode(array('answer' => false));
        die();
    }
    $result9 = mysql_query("SELECT * FROM $course WHERE ParentID='$pid'");
    $myrow9 = mysql_fetch_array($result9);
    echo(gettype($myrow9));
    if(gettype($myrow9) != "boolean"){
        echo json_encode(array('answer' => true));
        die();
    }
    if($pcourse === $course){
        $void = "";
        $result1 = mysql_query("UPDATE Users SET Courses = '$void' WHERE ID = '$pid'");
        echo json_encode(array('answer' => true));
        die();
    }else{
        $newcourse = str_replace($course, "", $pcourse);
        $array = explode(', ', $newcourse);
        $array0 = "";
        foreach($array as $arr){
            if($arr !== ""){
            $array0 = $array0.$arr.", ";
            }
        }
        $newcourse = substr($array0, 0, iconv_strlen($array0) - 2);
        $result1 = mysql_query("UPDATE Users SET Courses = '$newcourse' WHERE ID = '$pid'");
        echo json_encode(array('answer' => true));
        die();
    }
}
if ($myrow999['Role'] == 3){
    $result2 = mysql_query("SELECT ParentID FROM $course WHERE ChildName = '$name' and ChildSurname ='$surname'",$db);
    $myrow2 = mysql_fetch_array($result2);
    $parentID = $myrow2['ParentID'];
    $result3 = mysql_query("DELETE FROM $course WHERE ChildName = '$name' and ParentID = '$parentID'",$db);
    if($result3 === false){
        echo json_encode(array('answer' => false));
        die();
    }
    $result9 = mysql_query("SELECT * FROM $course WHERE ParentID='$parentID'");
    if($result9 !== false){
        echo json_encode(array('answer' => true));
        die();
    }
    $result0 = mysql_query("SELECT Courses FROM Users WHERE ID='$parentID'");
    $myrow = mysql_fetch_array($result0);
    $pcourse = $myrow['Courses'];// Строка с Users с курсами
    if($pcourse === $course){
        $void = "";
        $result1 = mysql_query("UDPATE Users SET Courses = '$void' WHERE ID = '$parentID'");
        echo json_encode(array('answer' => true));
        die();
    }else{
        $newcourse = str_replace($course, "", $pcourse);
        $array = explode(', ', $newcourse);
        $array0 = "";
        foreach($array as $arr){
            if($arr !== ""){
            $array0 = $array0.$arr.", ";
            }
        }
        $newcourse = substr($array0, 0, iconv_strlen($array0) - 2);
        $result1 = mysql_query("UPDATE Users SET Courses = '$newcourse' WHERE ID = '$parentID'");
        echo json_encode(array('answer' => true));
        die();
    }
}
?>