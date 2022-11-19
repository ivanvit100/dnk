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
$namep1 = $array1['nameOne']; //Имя первого родителя
$surnamep1 = $array1['surnameOne']; //Фамилия первого родителя

include("bd.php");
$name = $array1['name']; //Имя ребенка
$surname = $array1['surname']; //Фамилия ребенка
$patronymic = $array1['patronymic']; //Отчество ребенка
$birthday = $array1['date']; //Дата рождения
$birthplace = $array1['placeOne']; //Место рождения
$regplace = $array1['placeTwo']; //Место прописки
$patronymicp1 = $array1['patronymicOne']; //Отчество первого родителя
$namep2 = $array1['nameTwo']; //Имя второго родителя
$surnamep2 = $array1['surnameTwo']; //Фамилия второго родителя
$patronymicp2 = $array1['patronymicTwo']; //Отчество второго родителя
$group = $array1['group']; //Возрастная группа

//Блок получения количества мест на курсе из JSON (почти)
//Целочисленное значение хранится в переменной $count
$ourData = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$ourData = str_replace("var curData = ", "", $ourData);
$ourData = json_encode($ourData);
$ourData = json_decode($ourData, false);
$find = strrpos($ourData, $course);
$find = strpos($ourData, '"'.$group.'":', $find);
$count = trim(substr($ourData, $find + strlen('"'.$group.'":') + 1, 3));
$count = (int)str_replace(",", "", $count);

$result = mysql_query("SELECT ID FROM $course WHERE ParentID='$pid' AND ChildName='$name'", $db);
echo mysql_error($db); //Проверяй ошибки SQL этой строкой. Просто воткни её после ошибочного запроса
if($result != false){
    $myrow = mysql_fetch_array($result);
}else{
    $myrow = array('ID' => 0);
}
if(($myrow['ID'] ?? -1) >= 0){
    echo json_encode(array('answer' => false, 'reason' => 'Ребёнок уже записан на этот курс!')); //Ответ
    die();
}

//Проверка заполненности курса
//В правильности не уверен
$result1 = mysql_query("SELECT COUNT(1) FROM $course WHERE GroupName='$group'");
$myrow1;
if($result1 != false){
    $myrow1 = mysql_fetch_array($result1);
}else{
    $myrow1 = [0];
}
if($myrow1[0] >= $count){
    echo json_encode(array('answer' => false, 'reason' => 'Курс переполнен!')); //Ответ
    die();
}

$result2 = mysql_query("INSERT INTO $course (ParentID,ChildName,ChildSurname,ChildPatronymic,Birthday,BirthPlace,Registration,ParentName,ParentSurname,ParentPatronymic,SecondPName,SecondPSurname,SeconPPatronymic,GroupName) VALUES('$pid','$name','$surname','$patronymic','$birthday','$birthplace','$regplace','$namep1','$surnamep1','$patronymicp1','$namep2','$surnamep2','$patronymicp2','$group')");
$result3 = mysql_query("SELECT Courses FROM Users WHERE ID='$pid'", $db);
$myrow3 = mysql_fetch_array($result3);
if($result2=='TRUE' or $result2 == true){
    echo json_encode(array('answer' => true, 'reason' => 'Вы успешно зарегистрированы!')); //Ответ
    if($myrow3['Courses'] == ''){
        $result4 = mysql_query("UPDATE Users SET Courses = '$course' WHERE ID = '$pid'");
    }else{
        $result5 = $myrow3['Courses'].", ".$course;
        $result4 = mysql_query("UPDATE Users SET Courses = '$result5' WHERE ID = '$pid'");
    }
    die();
}else{
    echo json_encode(array('answer' => false, 'reason' => 'Ошибка! Вы не зарегистрированы.')); //Ответ
    die();
}
?>