<?php

class Singleton {
	
	private static $instance;
	private $contador;
	
	private function __construct() {
		echo "I've created class " . __CLASS__ . "\n";
		$this->contador = 0;
	}
	
	public static function getInstance () {
		if (!self::$instance instanceof self) {
			self::$instance = new self;
		}
		return Singleton::$instance;
	}
	
	public function increase () {
		return ++$this->contador;
	}
	
	public function decrease () {
		return --$this->contador;
	}
	
	//Para evitar clonados que produzcan valores no deseados
	public function __clone() {
		trigger_error("Invalid operation: You cannot clone an instance of : " . get_class($this). " class", E_USER_ERROR);
	}
	
	//Recurriendo de nuevo a los métodos mágicos, esta vez a __wakeup, que es invocado cuando objeto es desearilizado.
	//Su contraparte es el método mágico __sleep, que se invoca cuando se serializa un objeto.
	public function __wakeup()
	{
		trigger_error("No puedes deserializar una instancia de ". get_class($this) ." class.");
	}
}