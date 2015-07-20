 <?php
 /*
    We will grab the keys entered by the user in the search field with JavaScript/JQuery.
    We will then send a query (with AJAX/JQuery) to our PHP server at the page autocomplete.php with the actual text in the search field.
    The PHP code will grab the text that we wish to make a search for.
    The PHP code will do a search in the MySQL database
    The PHP code will grab the result and send it back formatted with JSON to our AJAX query
    The JavaScript/JQuery code will get the JSON result and display it in a list
*/
require('constant.php');
require('database.php');

if (!isset($_GET['keyword'])) {
	die();
}

$keyword = $_GET['keyword'];
$data = searchForKeyword($keyword);
echo json_encode($data);
?>
