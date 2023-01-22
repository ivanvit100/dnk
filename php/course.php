<?php
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str) {
    list($key, $value) = explode(':', $str);
    $array1[$key] = htmlspecialchars($value, ENT_QUOTES);
}

$course = $array1['courseID'];
$json_Data = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$json_Data = str_replace("var curData = ", "", $json_Data);
$json_Data = json_decode($json_Data, true);

if(gettype($json_Data["$course"]) != "array"){
    echo("Не хакай.");
    die();
}
$pid = $array1['parentID'];
if($pid < 1){
    echo("Не хакай.");
    die();
}
if($pid != (int)$pid){
    echo("Не хакай.");
    die();
}
$namep1 = $array1['nameOne'];
if((int)$namep1 != ""){
    echo("Не хакай.");
    die();
}
$surnamep1 = $array1['surnameOne'];
if((int)$surnamep1 != ""){
    echo("Не хакай.");
    die();
}

include("bd.php");
$name = $array1['name'];
if((int)$name != ""){
    echo("Не хакай.");
    die();
}
$surname = $array1['surname'];
if((int)$surname != ""){
    echo("Не хакай.");
    die();
}
$patronymic = $array1['patronymic'];
if((int)$patronymic != ""){
    echo("Не хакай.");
    die();
}
$birthday = $array1['date'];
$birthplace = $array1['placeOne'];
$regplace = $array1['placeTwo'];
$patronymicp1 = $array1['patronymicOne'];
if((int)$patronymicp1 != ""){
    echo("Не хакай.");
    die();
}
$namep2 = $array1['nameTwo'];
if((int)$namep2 != ""){
    echo("Не хакай.");
    die();
}
$surnamep2 = $array1['surnameTwo'];
if((int)$surnamep2 != ""){
    echo("Не хакай.");
    die();
}
$patronymicp2 = $array1['patronymicTwo'];
if((int)$patronymicp2 != ""){
    echo("Не хакай.");
    die();
}
$group = $array1['group'];


$ourData = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$ourData = str_replace("var curData = ", "", $ourData);
$ourData = json_encode($ourData);
$ourData = json_decode($ourData, false);
$find = strrpos($ourData, $course);
$find = strpos($ourData, '"'.$group.'":', $find);
$count = trim(substr($ourData, $find + strlen('"'.$group.'":') + 1, 3));
$count = (int)str_replace(",", "", $count);

if(iconv_strlen($birthday)<2){
    echo json_encode(array('answer' => false, 'reason' => 'Неверная дата рождения!'));
    die();
}

$result = mysql_query("SELECT ID FROM $course WHERE ParentID='$pid' AND ChildName='$name'", $db);
echo mysql_error($db);
if($result != false){
    $myrow = mysql_fetch_array($result);
}else{
    $myrow = array('ID' => 0);
}
if(($myrow['ID'] ?? -1) >= 0){
    echo json_encode(array('answer' => false, 'reason' => 'Ребёнок уже записан на этот курс!'));
    die();
}

$result1 = mysql_query("SELECT COUNT(1) FROM $course WHERE GroupName='$group'");
$myrow1;
if($result1 != false){
    $myrow1 = mysql_fetch_array($result1);
}else{
    $myrow1 = [0];
}
if($myrow1[0] >= $count){
    echo json_encode(array('answer' => false, 'reason' => 'Курс переполнен!'));
    die();
}

$result2 = mysql_query("INSERT INTO $course (ParentID,ChildName,ChildSurname,ChildPatronymic,Birthday,BirthPlace,Registration,ParentName,ParentSurname,ParentPatronymic,SecondPName,SecondPSurname,SeconPPatronymic,GroupName) VALUES('$pid','$name','$surname','$patronymic','$birthday','$birthplace','$regplace','$namep1','$surnamep1','$patronymicp1','$namep2','$surnamep2','$patronymicp2','$group')");
$result3 = mysql_query("SELECT Courses FROM Users WHERE ID='$pid'", $db);
$myrow3 = mysql_fetch_array($result3);
if($result2=='TRUE' or $result2 == true){
    echo json_encode(array('answer' => true, 'reason' => 'Вы успешно зарегистрированы!'));
    if($myrow3['Courses'] == ''){
        $result4 = mysql_query("UPDATE Users SET Courses = '$course' WHERE ID = '$pid'");
    }else{
        if(strpos($myrow3['Courses'], $course) === false){
        $result5 = $myrow3['Courses'].", ".$course;
        $result4 = mysql_query("UPDATE Users SET Courses = '$result5' WHERE ID = '$pid'");
        }
    }
    die();
}else{
    echo json_encode(array('answer' => false, 'reason' => 'Ошибка! Вы не зарегистрированы.'));
    die();
}
?>