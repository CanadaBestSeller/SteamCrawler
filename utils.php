<?php

  // Display errors
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);

  // db info filepath
  $db_info_file = './db_info.txt';

  function get_credentials() {
    global $db_info_file;

    $lines = file_get_contents($db_info_file);
    $credentials = explode("\r\n", $lines);

    return $credentials;
  }

  // Converts Steam Marketplace date strings into SQL server accepted date strings
  // eg) 'Wed, 08 Jan 2014 19:00:00 +0000' -> '20120618 19:34:09'
  function steam_date_string_to_datetime($steam_date_string) {
    $arr = explode(' ', $steam_date_string);
    return ($arr[3] . month_name_to_number($arr[2]) . $arr[1] . ' ' . $arr[4]);
  }

  function month_name_to_number($month_name) {
    if($month_name == 'Jan') {return '01';}
    if($month_name == 'Feb') {return '02';}
    if($month_name == 'Mar') {return '03';}
    if($month_name == 'Apr') {return '04';}
    if($month_name == 'May') {return '05';}
    if($month_name == 'Jun') {return '06';}
    if($month_name == 'Jul') {return '07';}
    if($month_name == 'Aug') {return '08';}
    if($month_name == 'Sep') {return '09';}
    if($month_name == 'Oct') {return '10';}
    if($month_name == 'Nov') {return '11';}
    if($month_name == 'Dec') {return '12';}
    return $month_name;
  }

  // Converts Steam Marketplace item names into array w/ SQL columns, eg)
  // result['name'] = '(star) Karambit | Stained (Factory New)'
  // result['weapon'] = '(star) Karambit'
  // result['skin'] = 'Stained'
  // result['exterior'] = 'Factory New'
  // result['stattrak'] = 0
  // \(([\w\s]*?)\)$ matches '(Factory New)'
  // ^(.*)\s\| matches weapon
  // \|\s(.*)\s\( matches skin
  // 
  function item_name_to_array($item_name) { 
    
    
?>
