<?php

/*If the user enters correct data then we connect to SQL database and insert the records */
$server = "localhost"; //Mostly localhost
$dbusername = "root"; //Username required to login to database
$dbpassword = "your_password_here"; //Password required to login
$db = "bitzoom"; //Database name
$conn = mysqli_connect($server, $dbusername, $dbpassword, $db); //Using PHP's mysqli library

if (!$conn) {

  /* If connection to database failed then the user must get an exception. However the user must not know the reason for the error. */

  	exit("An unknown error occured.");
  }

?>
