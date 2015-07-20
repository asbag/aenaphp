<?php
require_once '../constants.inc';
require_once '../vendor/autoload.php';
require_once '../classes/class.bd.php';


Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader);


	try {
		$statement = "delete from company where id = :id";
		$bd = new Bd(BD, BD_USER, BD_PASSWORD);
		$bd->prepareQuery($statement);
		$bd->ejecutarSentencia(array(":id" => $_GET['id']));
		$template = $twig->loadTemplate('success.html.twig');
		echo $template->render(array());
	} catch (Exception $e) {
		echo "<pre>";
		print_r($e);
		echo "</pre>";
	}
