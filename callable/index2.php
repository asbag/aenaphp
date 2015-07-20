<?php
//Ejemplo de call_user_func()
function barbero($tipo)
{
    echo "Usted quiere un corte de pelo al estilo $tipo, sin problemas\n";
}
call_user_func('barbero', "seta");
call_user_func('barbero', "rapado");
?>

