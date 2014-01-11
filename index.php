<!DOCTYPE html>
<html>
<body>

<h1>My bitchin' Steam Marketplace Transaction Lister 'n shit</h1>

Enter Steam Marketplace URL:<br />
e.g.) <br />
http://steamcommunity.com/market/listings/730/FAMAS%20%7C%20Doomkitty%20%28Minimal%20Wear%29<br />
<FORM NAME ="form1" METHOD ="POST" ACTION = "transaction_lister.php">
  <INPUT TYPE = "Text" NAME = "textbox_url">
  <INPUT TYPE = "Submit" NAME = "submit" VALUE = "submit">
</FORM>

<?php

// Display errors
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

include 'test_crawl.php';

?>
</body>
</html>
