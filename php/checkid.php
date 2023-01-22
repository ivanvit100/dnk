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

$id = $array1['ID'];
if($id != (int)$id){
    echo("Не хакай.");
    die();
}
if((int)$id < 0){
    echo("Не хакай.");
    die();
}

$result = mysql_query("SELECT Role FROM Users WHERE ID = '$id'");
$myrow = mysql_fetch_array($result);
if (gettype($myrow) == "boolean"){
    echo json_encode(array('answer' => false, 'reason' => 'Тебя не существует!'), JSON_UNESCAPED_UNICODE);
    die();
}else{
    $role = $myrow['Role'];
    echo json_encode(array('answer' => true, 'Role' => $role));
    die();
}
?>