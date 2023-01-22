<?php
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str) {
    list($key, $value) = explode(':', $str);
    $array1[$key] = htmlspecialchars($value);
}
include("bd.php"); 
$mode = $array1['Mode'];
$id = $array1['ID'];
$course = $array1['Course'];
$defendarray1 = array("or", "add", "=");
$defendarray2 = array(" ", "'",'"',"-");
$text = $array1['Text'];

$json_Data = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$json_Data = str_replace("var curData = ", "", $json_Data);
$json_Data = json_decode($json_Data, true);

if(gettype($json_Data["$course"]) != "array"){
    echo("Не хакай.");
    die();
}
if($id < 1){
    echo("Не хакай.");
    die();
}
if($id != (int)$id){
    echo("Не хакай.");
    die();
}
if(((int)$mode < 1) or ($mode > 4)){
    echo("Не хакай.");
    die();
}
if($mode != (int)$mode){
    echo("Не хакай.");
    die();
}
$mode = (int)$mode;
$result1 = mysql_query("SELECT Role FROM Users WHERE ID='$id'",$db);
$myrow1 = mysql_fetch_array($result1);
if ($myrow1['Role'] != 3){
    echo json_encode(array('answer' => false, 'reason' => 'Вы не имеете прав на данное действие!'), JSON_UNESCAPED_UNICODE);
    die();
}

if ($mode == 1){
    $email = $text;
    $texttest = mb_strtolower($text, 'UTF-8');
    if(str_replace($defendarray2, "", $texttest) != $texttest){
        echo json_encode(array('answer' => false, 'reason' => 'Использованы запрещенные символы!'),JSON_UNESCAPED_UNICODE);
        die();
    }
    if(stristr($email, '@') === false || stristr($email, '.') === false) {
        echo json_encode(array('answer' => false, 'reason' => 'Неверная почта!'));
        die();
    }
    $result2 = mysql_query("SELECT * FROM Users WHERE Email='$email'",$db);
    $myrow2 = mysql_fetch_array($result2);
    if(gettype($myrow2) == "boolean"){
        echo json_encode(array('answer' => false, 'reason' => 'Пользователя с такой почтой не существует!'),JSON_UNESCAPED_UNICODE);
        die();
    }
    if($myrow2['Role'] == 2){
        if($myrow2['Courses'] == ""){
            $result3 = mysql_query("UPDATE Users SET Courses = '$course' WHERE Email='$email'");
            echo json_encode(array('answer' => true, 'reason' => 'Данный преподаватель был добавлен на курс!'),JSON_UNESCAPED_UNICODE);
            die();
        }else{
            $array = explode(', ', $myrow2['Courses']);
            foreach($array as $arr){
                if ($arr == $course){
                    echo json_encode(array('answer' => false, 'reason' => 'Данный пользователь и так является преподавателем на этом курсе!'),JSON_UNESCAPED_UNICODE);
                    die();
                }
            }
            $newcourse = $myrow2['Courses'].", ".$course;
            $result3 = mysql_query("UPDATE Users SET Courses = '$newcourse' WHERE Email='$email'");
            echo json_encode(array('answer' => true, 'reason' => 'Данный преподаватель был добавлен на курс.'),JSON_UNESCAPED_UNICODE);
            die();
        }
    }else{
        echo json_encode(array('answer' => false, 'reason' => 'Данный пользователь не преподаватель!'),JSON_UNESCAPED_UNICODE);
        die();
    }
}

if ($mode == 2){
    $email = $text;
    $texttest = mb_strtolower($text, 'UTF-8');
    if(str_replace($defendarray1, "", $texttest) != $texttest){
        echo json_encode(array('answer' => false, 'reason' => 'Использованы запрещенные символы!'),JSON_UNESCAPED_UNICODE);
        die();
    }
    if(stristr($email, '@') === false || stristr($email, '.') === false) {
        echo json_encode(array('answer' => false, 'reason' => 'Неверная почта!'));
        die();
    }
    $result2 = mysql_query("SELECT * FROM Users WHERE Email='$email'",$db);
    $myrow2 = mysql_fetch_array($result2);
    if(gettype($myrow2) == "boolean"){
        echo json_encode(array('answer' => false, 'reason' => 'Пользователя с такой почтой не существует!'), JSON_UNESCAPED_UNICODE);
        die();
    }
    if($myrow2['Role'] == 2){
        if($myrow2['Courses'] == $course){
            $result3 = mysql_query("UPDATE Users SET Courses = '' WHERE Email='$email'");
            echo json_encode(array('answer' => true, 'reason' => 'Преподаватель удален с курса!'), JSON_UNESCAPED_UNICODE);
            die();
        }else{
            $array = explode(', ', $myrow2['Courses']);
            $newcourse = "";
            $count = 0;
            foreach($array as $arr){
                if ($arr == $course){
                    $count = $count + 1;
                }else{
                    $newcourse = $newcourse.$arr.", ";
                }
            }
            if($count >= 1){
                $newcourse = substr($newcourse, 0, iconv_strlen($newcourse) - 2);
                $result3 = mysql_query("UPDATE Users SET Courses = '$newcourse' WHERE Email='$email'");
                echo json_encode(array('answer' => true, 'reason' => 'Преподаватель удален с курса.'), JSON_UNESCAPED_UNICODE);
                die();
            }else{
                echo json_encode(array('answer' => false, 'reason' => 'Данный пользователь не является преподавателем этого курса!.'), JSON_UNESCAPED_UNICODE);
                die();
            }
        }
    }else{
        echo json_encode(array('answer' => false, 'reason' => 'Данный пользователь не преподаватель!'), JSON_UNESCAPED_UNICODE);
        die();
    }
}

if ($mode == 3){
    $texttest = mb_strtolower($text, 'UTF-8');
    if(str_replace($defendarray1, "", $texttest) != $texttest){
        echo json_encode(array('answer' => false, 'reason' => 'Замечена попытка взлома!'),JSON_UNESCAPED_UNICODE);
        die();
    }
    $json_Data["$course"]["text"] = str_replace("`",",",$text);
    file_put_contents("/home/vol9_1/byethost11.com/b11_32810043/htdocs/static/coursesData.json","var curData = ".json_encode($json_Data, JSON_UNESCAPED_UNICODE));
    echo json_encode(array('answer' => true, 'reason' => 'Описание курса изменено!'), JSON_UNESCAPED_UNICODE);
    die();
}

if ($mode == 4){
    $texttest = mb_strtolower($text, 'UTF-8');
    if(str_replace($defendarray1, "", $texttest) != $texttest){
        echo json_encode(array('answer' => false, 'reason' => 'Замечена попытка взлома!'),JSON_UNESCAPED_UNICODE);
        die();
    }
    $group = $array1['Group'];
    $json_Data["$course"]["groups"]["$group"] = $text;
    file_put_contents("/home/vol9_1/byethost11.com/b11_32810043/htdocs/static/coursesData.json","var curData = ".json_encode($json_Data, JSON_UNESCAPED_UNICODE));
    echo json_encode(array('answer' => true, 'reason' => 'Максимальное кол-во детей в данной возрастной группе изменено!'), JSON_UNESCAPED_UNICODE);
    die();
}
?>