<?php
include("bd.php");
$pid = "94";
$result3 = mysql_query("SELECT Courses FROM Users WHERE ID='$pid'", $db);
$myrow = mysql_fetch_array($result3);
echo($result3);
echo($myrow['Courses']);
$course = 'robo' ;
if($myrow['Courses'] == ''){
    echo("Абаб");
    $sql = mysql_query("UPDATE Users SET Courses='$course' WHERE ID='$pid'");
}else{
    echo("Окок");
    $result4 = $myrow['Courses'] + "robo";
    $sql = mysql_query("UPDATE Users SET Courses='$result4' WHERE ID='$pid'");
}
die()
//if($myrow['Courses'] == ''){
//    echo('ахах');
//}else{
//    echo('АХАХ');
//}
?>