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

$email = $array1['Email']; // Почта пользователя
$id = $array1['ID']; //Айди пользователя(Админ)
$mode = $array1['Mode'];
$void = '';
include("bd.php");

$result1 = mysql_query("SELECT * FROM Users WHERE ID='$id'", $db);
$myrow1 = mysql_fetch_array($result1);
if($myrow1['Role'] != 3){
    echo json_encode(array('answer' => false, 'reason' => 'Вы не имеете доступа к админ панели!')); //Ответ
    die();
}

$result2 = mysql_query("SELECT * FROM Users WHERE Email = '$email'",$db);
//echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
$myrow2 = mysql_fetch_array($result2);
if(gettype($myrow2) == "boolean"){
    echo json_encode(array('answer' => false, 'reason' => 'Пользователь с такой почтой отсутствует!')); //Ответ
    die();
}

//echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
$id2 = $myrow2['ID'];
if($mode == "true"){
	echo json_encode(array('answer' => true, 'Surname' => $myrow2['Surname'], 'Name' => $myrow2['Name'], 'Phone' => $myrow2['Phone'], 'Group' => $myrow2['Role']));
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
        echo json_encode(array('answer' => true,'reason' => 'Роль пользователя обновлена'));
    }else{
        echo json_encode(array('answer' => true,'reason' => 'Пользователь и так обладает ролью преподавателя/админа.'));
    }
}
die()
?>