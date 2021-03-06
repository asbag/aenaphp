<?php
/**
 * Con la función serialize podemos almacenar una representación 
 * apta de una variable (una instancia, es una variable a fin de cuentas), 
 * sin perder su tipo ni estructura. Y, con unserialize (deserializacion) 
 * podemos obtener esa "representación apta" de la variable, accediendo a 
 * ella como se si tratara de un clon.
 */
 
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
		$instance = Singleton::getInstance();
		echo "Instancia quedo en: " . $instance->increase() . "\n";
		$serializado = serialize($instance);
		$nuevaInstancia = unserialize($serializado);
		echo "Deserializado: " . $nuevaInstancia->increase() . "\n";
		echo "Deserializado: " . $nuevaInstancia->increase() . "\n";
		echo "Deserializado: " . $nuevaInstancia->increase() . "\n";
		echo "Instancia sigue en: " . ($instance->increase()-1) . "\n";
} catch (Exception $e) {
		echo $e->getMessage();
}
?>