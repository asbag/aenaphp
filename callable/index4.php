<?php
//Usar un método de clase con call_user_func()
class miclase {
    static function saludar()
    {
        echo "¡Hola!\n";
    }
}

$nombreclase = "miclase";

call_user_func(array($nombreclase, 'saludar'));
call_user_func($nombreclase .'::saludar'); // A partir de 5.2.3

$miobjeto = new miclase();

call_user_func(array($miobjeto, 'saludar'));

?>

