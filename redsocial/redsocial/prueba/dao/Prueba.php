<?php
if(!defined('THISBASEPATH')){ define('THISBASEPATH', '/var/www/html/redsocial/redsocial/'); }
require_once THISBASEPATH.'prueba/iPrueba.php';
class Prueba implements iPrueba {
	
	/* (non-PHPdoc)..
	 * @see iPrueba::uno()
	 */
	public function uno() {
		echo __FUNCTION__;

	}

	/* (non-PHPdoc)
	 * @see iPrueba::dos()
	 */
	public function dos() {
		echo __FUNCTION__;

	}

}