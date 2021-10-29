<?php
/* Основные настройки */

const DB_HOST = 'localhost';
const DB_LOGIN = 'root';
const DB_PASSWORD = "";
const DB_NAME = "eshop";
const ORSERS_LOG = "orders.log"; // файл с личными данными пользователей

$basket = []; // массив для хранения корзины пользователя
$count = 0; // кол-во товаров в корзиен пользователя

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die(mysqli_connect_error());

basketInit();

/* / Основные настройки */