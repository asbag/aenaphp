<?php
spl_autoload_extensions('.php');
spl_autoload_register('Load_Functions');

function Load_Functions ($class) {
	if (is_readable($_SERVER['DOCUMENT_ROOT'] . '/' . $class . '.php')) {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $class . '.php';
	} else {
		trigger_error('Class not found or not readable!!', E_USER_ERROR);
	}
}

$product1 = new Product_Chair('0001','INGOLF Chair');
$product2 = new Product_Table('0002','STOCKHOLN Table'); 