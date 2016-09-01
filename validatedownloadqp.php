<?php
//This file is same as validatedownload.php. Only that this file is to validate the download of Question papers
/* So before someone can download content we need to verify he/she is logged in. This script serves the same purpose */
/* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
$fltodl = $_POST['fltodl']; //File that needs to be downloaded
$course = $_POST['course']; //The course to which the file belongs to
/* Check if the session is started. If so give out the download link directly. Make sure that the download link must be a http link and not a https link. This is because some browsers do not support over https link */
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['dob']) && isset($_SESSION['branch']))
  {
  echo "<div class=\"row\">
  <div class=\"\"></div>
  <div class=\"col-sm-12\">

  <div style=\"background-color:lightgreen;border-radius:5px;border-color:green;border:solid darkgreen;\"><img src=\"pc5eyaGMi.png\" height=15 width=15> <font size=2px color=black face=arial><b><a href=\"downloadqp.php?course=" . $course . "&file=" . $fltodl . "\">Click here</a> to download <br />" . $fltodl . ".<br /><br />Wasn't that easy? <a href=http://www.facebook.com/bitmesrazoom target=new>Like us</a> on facebook and spread the word.</b></font></div>

  </div>
  <div class=\"\"></div>
</div>";
  }
  else
  {

  // If the user is not logged in ask him to login before he can download

  echo "
<div class=\"row\">
  <div class=\"\"></div>
  <div class=\"col-sm-12\">

  <div style=\"background-color:magneta;border-radius:5px;border-color:red;border:solid red;\"><font size=2px color=red face=arial><b>Only logged in users can download the files. <br />Please login <a href=qp.php>here</a></b></font></div>

  </div>
  <div class=\"\"></div>
</div>

";
  }

?>