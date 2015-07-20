<?php
include_once('autocompletar.php');

//recibo el dato que deseo buscar sugerencias
$datoBuscar = $_GET["term"];

//conecto con una base de datos
$conexion = mysql_connect("localhost", "root", "java_innova4b");
mysql_select_db("autocompletar");

//busco un valor aproximado al dato escrito
$ssql = "select id_entrada, nombre_entrada from entrada where nombre_entrada like '%" . $datoBuscar . "%'";
$rs = mysql_query($ssql);

//creo el array de los elementos sugeridos
$arrayElementos = array();

//bucle para meter todas las sugerencias de autocompletar en el array
while ($fila = mysql_fetch_array($rs)){
   array_push($arrayElementos, new ElementoAutocompletar(utf8_encode($fila["nombre_entrada"]), $fila["id_entrada"]));
}

print_r(json_encode($arrayElementos));
?>
