<?php
/**
 * @author David Mezquíriz
 * @copyright 2015
 */
 
spl_autoload_register('ClassLoad');

function ClassLoad ($className) {
	if (isset($className)) {
		if (file_exists($className)) {
			require_once "$className";
		}
	}
}