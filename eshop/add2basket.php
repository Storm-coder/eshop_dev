<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";

// получить идентификатор товара, добавляемого в корзину
$id = ($_GET['id']);

// назначить количество добавляемого товара равным 1
if ($id) {
	add2Basket($id);
	header("Location: catalog.php");
	exit;
}

