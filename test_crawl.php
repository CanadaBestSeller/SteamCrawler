<?php

// Display errors
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include 'db_utils.php';

$url_encoded = 
'http://steamcommunity.com/market/listings/730/%E2%98%85%20Karambit%20|%20Stained%20%28Factory%20New%29';

$dbh = db_connect();
log_transaction_from_encoded_url($url_encoded, $dbh);

?>
