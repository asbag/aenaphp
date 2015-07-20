<?php
//Ejecutamos funciones con un nombre de función

function mifuncion ($mivar){
	echo "Hola Mundo $mivar qué tal ???\n";
}

$funcion = 'mifuncion';

$mivariable = 'David';
call_user_func($funcion,$mivariable);

$mivariable2 = 'Pepe';
call_user_func_array($funcion,array($mivariable2));
