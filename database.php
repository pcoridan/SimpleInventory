<?php
  
  //Remove before flight
ini_set('display_errors', 'On');

// Connect to local host simpledb
try {
  $db = new PDO('mysql:host=localhost:3306;dbname=simpledb', 'methodic', 'xt4422');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(Exception $e){
  echo $e->getMessage();
  die();

}

?>