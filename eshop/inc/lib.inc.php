<?php
// функция сохраняющая новый товар в таблицу catalog и принимающую в виде аргументов название, автора, год издания и цену товара
function addItemToCatalog($title, $author, $pubyear, $price){
	global $link;
	// подготовленный запрос
	$sql = "INSERT INTO catalog (title, author, pubyear, price)
				VALUES (?, ?, ?, ?)";
		
	// исполнить запрос с переданными параметрами
	if (!$stmt = mysqli_prepare($link, $sql)) {
		return false;
	} else {
	mysqli_stmt_bind_param($stmt, "ssii", $title, $author, $pubyear, $price);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	return true;
	}
}

// функция, которая возвращает все содержимое каталога товаров в виде ассоциативного массива
function selectAllItems(){
	global $link;
	// SQL-запрос на выборку данных из таблицы catalog
	$sql = 'SELECT id, title, author, pubyear, price 
			FROM catalog';
	if (!$result = mysqli_query($link, $sql)) {
		return false;
	} else {
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		mysqli_free_result($result);
		return $items;
	}
}

// функция, которая сохраняет корзину с товарами в куки
function saveBasket(){
	global $basket;
	$basket = base64_encode(serialize($basket));
	setcookie('basket', $basket, 0x7FFFFFFF);
}

// функция, которая создает либо загружает в переменную $basket корзину с товарами, либо создает новую корзину с идентификатором заказа
function basketInit(){
	global $basket, $count;
	if (!isset($_COOKIE['basket'])) {
		$basket = ['orderid' => uniqid()]; // [key => value]
		saveBasket();
	} else {
		$basket = unserialize(base64_decode($_COOKIE['basket']));
		$count = count($basket)-1;
	}
}

// функция, которая добавляет товар в корзину пользователя и принимает в качестве аргумента идентификатор товара
function add2Basket($id){
	global $basket;
	$basket[$id] = 1;
	saveBasket();
}