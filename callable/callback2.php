<?php
namespace hola;

class Miclase {
	static function metodo1 ($variable) {
		echo "hola mundo soy $variable\n";
	}

}

$mivar = 'David';
call_user_func(__NAMESPACE__.'\Miclase::metodo1',$mivar);
