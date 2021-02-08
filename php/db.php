<?php


// $errors = array();
// $_SESSION['success'] = "";

 $dbHost = 'n2o93bb1bwmn0zle.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
 $dbUser = 'ltm3jaxtwkjct9ud';
 $dbPass = 'cmpgfchw7qwj4c4u';
 $dbName = "k7bxqnh6d0edh90w";

//  $conn = new mysqli($dbHost, $dbUser, $dbPass);
//  if($conn->connect_error) {
//  echo("Po&#322;&#261;czenie nie udane: " . $conn->connect_error . '<br
// />');
// $conn->close();
//  }

  $connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>