<?php
//Ejemplo de call_user_func() y referencias
//Observe que los parámetros para call_user_func() no son pasados por referencia. 
error_reporting(E_ALL);
function incrementar(&$var)
{
    $var++;
}

$a = 0;
call_user_func('incrementar', $a);
echo $a."\n";

// En su lugar se puede usar esto
call_user_func_array('incrementar', array(&$a));
echo $a."\n";
?>
