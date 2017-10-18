<?php
/* This script is executed when the user wishes to logout */
/* We first destroy all the session variables */
session_start();
session_destroy();
/* Then we check if a "Keep looged in" cookie is checked, if it is then we delete the corresponding record from the loggedin_users table and unset the cookies as well and redirect the user to home page where he/she will asked to login again */

if (isset($_COOKIE['rl1']))
	{
	/* This is an important include for connecting to the database*/
	include ('config.php');

	$sql1 = "DELETE FROM loggedin_users WHERE cookie='" . $_COOKIE[rl1] . "' AND cookie2='" . $_COOKIE[rl2] . "'";
	$result1 = mysqli_query($conn, $sql1);
	if ($result1)
		{
		setCookie("rl1", "", time() - 86400 * 365, "/");
		setCookie("rl2", "", time() - 86400 * 365, "/");
		}
	}

header('location:index.php');
?>