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
	$instance = Singleton::getInstance();
	
	echo "Class instance remained at " . $instance->increase() . "\n";
	$myClon = clone($instance);
	echo "Clon: " . $myClon->increase() . "\n";
	echo "Clon: " . $myClon->increase() . "\n";
	echo "Clon: " . $myClon->increase() . "\n";
	echo "Intance (increase - 1) remained at:" . ($instance->increase() - 1) . "\n";
} catch (Exception $e) {
	echo $e->getMessage();
}
?>