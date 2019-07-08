<?php
  // connecting to the data base
  $dbusername = "root"; 
  $dbpassword = "";
  
  try {
    $conn = new PDO("mysql:host=localhost;dbname=newbooksdb", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } 
  catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }
?>
