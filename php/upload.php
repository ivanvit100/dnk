<?php
$file = $_FILES['file'];
if($file['name'] == ''){
	return 'Вы не выбрали файл.';
	die();
}
if($file['size'] == 0){
	return 'Файл слишком большой.';
	die();
}
copy($file['tmp_name'], '/home/vol9_1/byethost11.com/b11_32810043/htdocs/php/img/'.$file['name']);
?>
