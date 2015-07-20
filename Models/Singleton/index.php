<?php
spl_autoload_extensions(".php");

spl_autoload_register(function ($class) {
	//$class = str_replace('\\','/', $class);
	$class = "./" . $class . ".php";

	if (file_exists($class)) {
		require_once "$class";
	} else {
		throw new Exception('Error en la carga de $class');
	}

});

try {
	
	//Veremos que la propiedad contador se mantiene global para todos de forma que así no se chocan unas 
	//llamadas con otras a la clase y el valor que uno modifica lo ve el otro.
	$instancia = Singleton::getInstance();
	echo "instancia (incrementar): " . $instancia->increase() . "\n";
	echo "instancia (incrementar): " .$instancia->increase() . "\n";
	echo "instancia (incrementar): " .$instancia->increase() . "\n";
	$otraInstancia = Singleton::getInstance();
	echo "otraInstancia (disminuir): " .$otraInstancia->decrease() . "\n";
	echo "otraInstancia (incrementar): " .$otraInstancia->increase() . "\n";
} catch (Exception $e) {
	echo $e->getMessage();
}


