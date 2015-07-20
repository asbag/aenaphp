<?php

require_once('../vendor/autoload.php');

$app = new Silex\Application;

$app
    ->match('/', function () {return 'Running';})
    ->method('GET');
var_dump($app);
return $app;