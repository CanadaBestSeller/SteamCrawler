<?php

// Display errors
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include 'utils.php';

function db_connect() {
  $credentials = get_credentials();

  // Connect to DB
  $dbname = $credentials[0];
  $username = $credentials[1];
  $password = $credentials[2];

  try {

    $database_handle = new PDO($dbname, $username, $password);
    $database_handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $database_handle;

  } catch ( PDOException $e ) {
    print( "Error connecting to SQL Server." );
    die(print_r($e));
  }
}

// WILL ONLY TAKE A PERCENTAGE-ENCODED URL
function log_transaction_from_encoded_url($url_encoded, $database_handle) {
  // Parse the price, given url
  $name = urldecode(substr(strrchr(rtrim($url_encoded, '/'), '/'), 1));
  $html = (string)file_get_contents($url_encoded);
  $pattern = "/^.*\bvar line1\b.*$/m";
  $matches = array();

  preg_match($pattern, $html, $matches);

  try {

    // Isolate js array
    $js_string = strstr($matches[0], '[');
    $js_string = strtok($js_string, ';');
    $arr = json_decode($js_string);

    $insert_stmt = $database_handle->prepare("INSERT INTO Transactions VALUES (:name, :time, :average_price, :copies_sold)");
    $time = '';
    $average_price = 0;
    $copies_sold = 0;
    $insert_stmt->bindParam(':name', $name);
    $insert_stmt->bindParam(':time', $time);
    $insert_stmt->bindParam(':average_price', $average_price);
    $insert_stmt->bindParam(':copies_sold', $copies_sold);

    foreach($arr as &$transaction) {
      $time = steam_date_string_to_datetime($transaction[0]);
      $average_price = $transaction[1];
      $copies_sold = intval(strtok($transaction[2], ' '));

      $insert_stmt->execute();
    }

  } catch (Exception $e) {
    print($e);
  }
}

?>
