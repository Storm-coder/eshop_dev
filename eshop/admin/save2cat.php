<?php
	// подключение библиотек
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";

// отфильтровать данные
function clearStr($data) {
	global $link; // т.к. $link за пределами видимости clearStr
	$data = trim(strip_tags($data));
	return mysqli_real_escape_string($link, $data);
}

// получить данные из формы (и отфильтровать)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$title = clearStr($_POST['title']);
	$author = clearStr($_POST['author']); 
	$pubyear =  clearStr($_POST['pubyear']);
	$price =  clearStr($_POST['price']);

	if (!addItemToCatalog($title, $author, $pubyear, $price)) {
		echo 'Произошла ошибка при добавлении товара в каталог';
	} else {
		header("Location: add2cat.php"); // избавится от буфера метода "POST" (перезагрузить страницу, чтобы форма не отправлялась повторно)
		exit;
	}
} 