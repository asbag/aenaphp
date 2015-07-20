<?php
// include and register Twig auto-loader
include 'vendor/autoload.php';
Twig_Autoloader::register();

try {
  // specify where to look for templates
  $loader = new Twig_Loader_Filesystem('templates');
  
  // initialize Twig environment
  $twig = new Twig_Environment($loader);
  
  // load template
  $template = $twig->loadTemplate('numbers.tmpl');
	
	$num = rand(0,30);
	$div = ($num % 2);
	
	echo $template->render(array("div" => $div, "num" => $num));
} catch (Exception $e) {
	echo $e->getMessage();
}
?>