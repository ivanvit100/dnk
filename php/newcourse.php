<?php
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str) {
    list($key, $value) = explode(':', $str);
    $array1[$key] = htmlspecialchars($value, ENT_QUOTES);
}
include("bd.php");

$defendarray1 = array("or", "add", "=");
$defendarray2 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", ",");

$id = $array1['userID'];
$result1 = mysql_query("SELECT Role FROM Users WHERE ID='$id'",$db);
$myrow1 = mysql_fetch_array($result1);
if ($myrow1['Role'] != 3){
    echo json_encode(array('answer' => false, 'reason' => 'Вы не имеете прав на данное действие!'), JSON_UNESCAPED_UNICODE);
    die();
}

$courseid = $array1['courseID'];
$title = $array1['title'];
$shorttitle = $array1['short'];
$text = $array1['description'];
$groups = $array1['age'];
$places = $array1['count'];

$json_Data = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$json_Data = str_replace("var curData = ", "", $json_Data);
$json_Data = json_decode($json_Data, true);

if(gettype($json_Data["$courseid"]) == "array"){
    echo(array('answer' => false, 'reason' => 'Такой курс уже существует!'));
    die();
}

$titletest = mb_strtolower($title, 'UTF-8');
$texttest = mb_strtolower($text, 'UTF-8');


if(str_replace($defendarray1, "", $titletest) != $titletest){
    echo json_encode(array('answer' => false, 'reason' => 'Замечена попытка взлома!'),JSON_UNESCAPED_UNICODE);
    die();
}
if(str_replace(" ", "", $shorttitle) != $shorttitle){
    echo json_encode(array('answer' => false, 'reason' => 'Пробелы в кратком имени курса запрещены!'),JSON_UNESCAPED_UNICODE);
    die();
}
if(str_replace(" ", "", $courseid) != $courseid){
    echo json_encode(array('answer' => false, 'reason' => 'Пробелы в идентификаторе курса запрещены!'),JSON_UNESCAPED_UNICODE);
    die();
}
if(str_replace($defendarray1, "", $texttest) != $texttest){
    echo json_encode(array('answer' => false, 'reason' => 'Замечена попытка взлома!'),JSON_UNESCAPED_UNICODE);
    die();
}

$groups = str_replace(" ", "", $groups);
$places = str_replace(" ", "", $places);
$groupsex = explode("`", $groups);
$placesex = explode("`", $places);
foreach($placesex as $pex){
    if ($pex != (int)$pex){
        echo json_encode(array('answer' => false, 'reason' => 'Количество мест введено неверно'),JSON_UNESCAPED_UNICODE);
        die();
    }
}
$json_Data["$courseid"]["title"] = $title;
$json_Data["$courseid"]["shortTitle"] = $shorttitle;
$json_Data["$courseid"]["text"] = str_replace("`",",",$text);
$json_Data["$courseid"]["courseId"] = $courseid;
$count = 0;
$element1 = 999;
$element2 = 0;
foreach($groupsex as $arr1){
    $json_Data["$courseid"]["groups"]["$arr1"] = $placesex["$count"];
    $count = $count + 1;
    if(strpos($arr1,"-") == false){
        if($element1 > $arr1){
            $element1 = $arr1;
        }
        if($element2 < $arr1){
            $element2 = $arr1;
        }
    }else{
        $pos = mb_strpos($arr1, "-");
        $first = mb_substr($arr1, 0, $pos);
        $second =  mb_substr($arr1, $pos + 1, iconv_strlen($arr1) - 1);
        if($element1 > $first){
            $element1 = $first;
        }
        if($element2 < $second){
            $element2 = $second;
        }
    }
}
$age = $element1."-".$element2;
$json_Data["$courseid"]["age"] = $age;

file_put_contents("/home/vol9_1/byethost11.com/b11_32810043/htdocs/static/coursesData.json","var curData = ".json_encode($json_Data, JSON_UNESCAPED_UNICODE));
$result10 = mysql_query("CREATE TABLE $courseid (ID int(11) NOT NULL primary key AUTO_INCREMENT,ParentID int(11) NOT NULL,ChildName text NOT NULL,ChildSurname text NOT NULL,ChildPatronymic text NOT NULL,Birthday date NOT NULL,BirthPlace text NOT NULL,Registration text NOT NULL,ParentName text NOT NULL,ParentSurname text NOT NULL,ParentPatronymic text NOT NULL,SecondPName text NOT NULL,SecondPSurname text NOT NULL,SeconPPatronymic text NOT NULL,GroupName text NOT NULL)");
echo json_encode(array('answer' => true, 'reason' => 'Курс успешно создан!'),JSON_UNESCAPED_UNICODE);
die();
?>