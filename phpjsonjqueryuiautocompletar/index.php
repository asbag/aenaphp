<?php
include_once('autocompletar.php');
//defino un array con varios elementos objetos de la clase anterior
$ArrayElementos = array(
   new   ElementoAutocompletar("Elemento 1", "valor 1"),
   new   ElementoAutocompletar("Elemento 2", "valor 2"),
   new   ElementoAutocompletar("La vida dura", "Es la vida"),
   new   ElementoAutocompletar("Elemento Lo que sea", "otro valor cualquiera")
);

//imprimo en la página la conversión a JSON del array anterior
print_r(json_encode($ArrayElementos)); 
//Json Encode deja así
/*
	[] significa clase
	{} significa array
	[
		{"value":"valor 1","label":"Elemento 1"},
		{"value":"valor 2","label":"Elemento 2"},
		{"value":"Es la vida","label":"La vida dura"},
		{"value":"otro valor cualquiera","label":"Elemento Lo que sea"}
	]
*/
?>
