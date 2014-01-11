<?php

// Display errors
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

// PARSE THE PRICE, GIVEN URL
$url_encoded = $_POST['textbox_url'];

$item_name = urldecode(substr(strrchr(rtrim($url_encoded, '/'), '/'), 1));
$html = (string)file_get_contents($url_encoded);
$pattern = "/^.*\bvar line1\b.*$/m";
$matches = array();

preg_match($pattern, $html, $matches);

try {

 $js_string = strstr($matches[0], '[');
 $js_string = strtok($js_string, ';');
 $arr = json_decode($js_string);

 foreach($arr as &$transaction) {
   $date = $transaction[0];
   $average_price = $transaction[1];
   $copies_sold = intval(strtok($transaction[2], ' '));
 
   print("On {$date}, {$copies_sold} copies were sold for ${average_price}.");
   print("<br />");
 }
} catch (Exception $e) {
 print($e);
}

print("<br><br>- Made by SourceDave");

?>
