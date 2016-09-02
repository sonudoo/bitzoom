<?php

/*If the user enters correct data then we connect to SQL database and insert the records */
$servername = "localhost"; //Mostly localhost
$username = "root"; //Username required to login to database
$password = "Bit$%*Zoom2016"; //Password required to login
$dbname = "bitzoom"; //Database name in which the contact table is available
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn)
  {

  /* If connection to database failed then the user must get an exception. However the user must not know the reason for the error. */

  die("An unknown error occured.");
  }

?>
