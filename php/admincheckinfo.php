<?php
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str){
    list($key, $value) = explode(':', $str);
    $array1[$key] = htmlspecialchars($value, ENT_QUOTES);
}

$email = $array1['Email'];
$id = $array1['ID'];
if($id != (int)$id){
    echo("Не хакай.");
    die();
}
if((int)$id < 0){
    echo("Не хакай.");
    die();
}
$mode = $array1['Mode'];
if((int)$mode < 1){
    echo("Не хакай.");
    die();
}
if((int)$mode > 4){
    echo("Не хакай.");
    die();
}
if($mode != (int)$mode){
    echo("Не хакай.");
    die();
}
$void = '';
include("bd.php");

$result1 = mysql_query("SELECT * FROM Users WHERE ID='$id'", $db);
$myrow1 = mysql_fetch_array($result1);
if($myrow1['Role'] != 3){
    echo json_encode(array('answer' => false, 'reason' => 'Вы не имеете доступа к админ панели!'), JSON_UNESCAPED_UNICODE);
    die();
}

$result2 = mysql_query("SELECT * FROM Users WHERE Email = '$email'",$db);
$myrow2 = mysql_fetch_array($result2);
if(gettype($myrow2) == "boolean"){
    echo json_encode(array('answer' => false, 'reason' => 'Пользователь с такой почтой отсутствует!'), JSON_UNESCAPED_UNICODE);
    die();
}

$id2 = $myrow2['ID'];
if($mode == "true"){
	echo json_encode(array('answer' => true, 'Surname' => $myrow2['Surname'], 'Name' => $myrow2['Name'], 'Phone' => $myrow2['Phone'], 'Group' => $myrow2['Role']), JSON_UNESCAPED_UNICODE);
}
if($mode != "true"){
    if($myrow2['Role'] == 1){
        $result3 = mysql_query("UPDATE Users SET Role = 2 WHERE Email = '$email'");
        if($myrow2['Courses']!=''){
            $array = explode(", ", $myrow2['Courses']);
            foreach($array as $arr1){
                $result5 = mysql_query("DELETE FROM $arr1 WHERE ParentID='$id2' ");
            }
            $result4 = mysql_query("UPDATE Users SET Courses = '$void' WHERE Email = '$email'");
        }
        echo json_encode(array('answer' => true,'reason' => 'Роль пользователя обновлена'), JSON_UNESCAPED_UNICODE);
    }else{
        echo json_encode(array('answer' => true,'reason' => 'Пользователь и так обладает ролью преподавателя/админа.'), JSON_UNESCAPED_UNICODE);
    }
}
die()
?>