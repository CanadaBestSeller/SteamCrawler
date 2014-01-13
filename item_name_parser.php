<?php

// Display errors
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include 'utils.php';

// show parsed item name object, given the URL
$url_encoded = $_POST['item_name_url'];
$item_name = urldecode(substr(strrchr(rtrim($url_encoded, '/'), '/'), 1));

$parsed_item = parse_item_name($item_name);
var_dump($parsed_item);

?>
