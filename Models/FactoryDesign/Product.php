<?php

abstract class Product {
	private $sku;
	private $name;
	protected $type = null;
	
	public function __construct($sku, $name) {
		$this->sku = $sku;
		$this->name = $name;
	}
	public function getSku() {
		return $this->sku;
	}
	public function setSku($sku) {
		$this->sku = $sku;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	
	
	
}