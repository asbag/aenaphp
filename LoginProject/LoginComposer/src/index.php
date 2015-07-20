<?php
require_once 'dbconfig.php';
require_once '../vendor/autoload.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('./plantillas');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('index.html.twig');


if($user->is_loggedin()!="") {
 $user->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
 $uname = $_POST['txt_uname_email'];
 $umail = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];
  
 if($user->login($uname,$umail,$upass))
 {
  $user->redirect('home.php');
 }
 else
 {
  $error = "Wrong Details !";
 } 
}
echo $template->render(array());
?>