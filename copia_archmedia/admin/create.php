<?php
require_once '../constants.inc';
require_once '../vendor/autoload.php';
require_once '../classes/class.bd.php';


Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader);


if (!isset($_POST['create'])) {
	


$template = $twig->loadTemplate('create.html.twig');
echo $template->render(array());

} else {
	try {
		$statement = "insert into company (name, phone_number) values (:name, :phone_number)";
		$bd = new Bd(BD, BD_USER, BD_PASSWORD);
		$bd->prepareQuery($statement);
		$bd->ejecutarSentencia(array(":name" => $_POST['name'], ":phone_number" => $_POST['phone_number']));
		$template = $twig->loadTemplate('success.html.twig');
		echo $template->render(array());
	} catch (Exception $e) {
		echo "<pre>";
		print_r($e);
		echo "</pre>";
	}
}
