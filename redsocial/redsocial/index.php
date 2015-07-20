<?php
require_once 'conf/globals.inc';

//Define the paths to the directories holding class files
$paths = array(
		'database/dao',
		'model',
		'database'
);


define('PROJECT_PATH','.');
//Add the paths to the class directories to the include path.
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $paths));
//Add the file extensions to the SPL.
spl_autoload_extensions(".class.php,.php,.inc");

spl_autoload_register(function($class_name) {
	$class_name = str_replace('\\', '/', $class_name);
	$resolved = THISBASEPATH . DIRECTORY_SEPARATOR . $class_name . '.php';
	if(file_exists($resolved)) {
		require_once "$resolved";
	} else {
		return new \Exception('Fail to load class ' . $resolved);
	}
});


$statement = "select * from users where id = :id";

try {
	$db = new database\dao\DataBaseDao();
	$options_array = array(":id" => "1");

	$db->prepareStatement($statement);
	$array_result = $db->execQuery($options_array);
} catch (Exception $e) {
	echo $e->getMessage();
}

$user = new User();

