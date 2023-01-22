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
$courseid = $array1['courseID'];
$id = $array1['userID'];
$result10 = mysql_query("SELECT Role FROM Users WHERE ID='$id'",$db);
$myrow1 = mysql_fetch_array($result10);
if ($myrow1['Role'] != 3){
    echo json_encode(array('answer' => false, 'reason' => 'Вы не имеете прав на данное действие!'), JSON_UNESCAPED_UNICODE);
    die();
}
$json_Data = file_get_contents("http://dnk.ivanvit.ru/static/coursesData.json");
$json_Data = str_replace("var curData = ", "", $json_Data);
$json_Data = json_decode($json_Data, true);
if(gettype($json_Data["$courseid"]) != "array"){
    echo("Такого курса нет!");
    die();
}
$result1 = mysql_query("DROP TABLE $courseid");
unset($json_Data["$courseid"]);

file_put_contents("/home/vol9_1/byethost11.com/b11_32810043/htdocs/static/coursesData.json","var curData = ".json_encode($json_Data, JSON_UNESCAPED_UNICODE));
echo json_encode(array('answer' => true, 'reason' => 'Курс успешно удалён!'),JSON_UNESCAPED_UNICODE);
die();
?>