<?php
//defino una clase para los elementos del campo autocompletar
class ElementoAutocompletar {
   //propiedades de los elementos
   var $value;
   var $label;
   
   //constructor que recibe los datos para inicializar los elementos
   function __construct($label, $value){
      $this->label = $label;
      $this->value = $value;
   }
}
?>
