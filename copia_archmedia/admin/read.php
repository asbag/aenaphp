<?php
require_once '../constants.inc';
require_once '../vendor/autoload.php';
require_once '../classes/class.bd.php';
Twig_Autoloader::register();


$bd = new Bd (BD, BD_USER, BD_PASSWORD);
$statement = 'select * from company';
$array_Result = $bd->exeQuery($statement);




$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('read.html.twig');
echo $template->render(array("comps" => $array_Result));
	
