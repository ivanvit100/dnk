<?php
include("bd.php");
$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"'], '', $data);
$array1 = array();
$array2 = explode(',', $data);
foreach($array2 as $str) {
    list($key, $value) = explode(':', $str);
    $array1[$key] = htmlspecialchars($value, ENT_QUOTES);
}

$id = $array1['ID'];
if($id != (int)$id){
    echo("Не хакай.");
    die();
}
if((int)$id < 0){
    echo("Не хакай.");
    die();
}
$id = (int)$id;
$result = mysql_query("SELECT * FROM Users WHERE ID='$id'", $db);
$myrow = mysql_fetch_array($result);

if($myrow['Role'] == 1){
	echo json_encode(array('answer' => true, 'Email' => $myrow['Email'], 'Phone' => $myrow['Phone'], 'Group' => $myrow['Role'], 'PassOne' => $myrow['PassOne'], 'PassTwo' => $myrow['PassTwo'], 'PassThree' => $myrow['PassThree'], 'Courses' => $myrow['Courses']));
	die();
}else if($myrow['Role'] == 2){
	echo json_encode(array('answer' => true, 'Email' => $myrow['Email'], 'Phone' => $myrow['Phone'], 'Group' => $myrow['Role'], 'Courses' => $myrow['Courses']));
	die();
}else if($myrow['Role'] == 3){
	echo json_encode(array('answer' => true, 'Email' => $myrow['Email'], 'Phone' => $myrow['Phone'], 'Group' => $myrow['Role']));
	die();
}else{
	echo json_encode(array('answer' => false));
}
?>