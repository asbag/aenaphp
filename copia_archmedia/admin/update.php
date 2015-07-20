<?php
require_once '../constants.inc';
require_once '../vendor/autoload.php';
require_once '../classes/class.bd.php';


Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader);

$bd = new Bd(BD, BD_USER, BD_PASSWORD);
	try {
if (!isset($_POST['update']) && isset($_GET['id'])) {

	$statement = "select * from company where id = " . $_GET['id'];
	$array_Company = $bd->exeQuery($statement);
	$template = $twig->loadTemplate('update.html.twig');
	echo $template->render(array("comp" => $array_Company[0]));

} elseif (isset($_POST['update'])) {
	$statement = "update company set name = :name, phone_number = :phone_number where id = " . $_GET['id'];
	$bd->prepareQuery($statement);
	$bd->ejecutarSentencia(array(":name" => $_POST['name'], ":phone_number" => $_POST['phone_number']));
			
	$template = $twig->loadTemplate('success.html.twig');
	echo $template->render(array());
}
	} catch (Exception $e) {
		echo "<pre>";
		print_r($e);
		echo "</pre>";
	}
