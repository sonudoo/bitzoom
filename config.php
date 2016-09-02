<?php

/*If the user enters correct data then we connect to SQL database and insert the records */
$server = "localhost"; //Mostly localhost
$dbusername = "root"; //Username required to login to database
$dbpassword = "Bit$%*Zoom2016"; //Password required to login
$db = "bitzoom"; //Database name
$connect = mysqli_connect($server, $dbusername, $dbpassword, $db); //Using PHP's mysqli library

if (!$connect)
  {

  /* If connection to database failed then the user must get an exception. However the user must not know the reason for the error. */

  exit("An unknown error occured.");
  }

?>
