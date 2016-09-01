<?php
/* This is the final script for forgot your password option. This script requires forgot session to be started, which is started when the user successfully selects a valid roll no and username. If a session is not already created, the script dies throwing an exception. Also this file requires the 'answered' session to be initiated to make sure that the user has answered the security question before resetting the password */
session_start();

if (!$_SESSION['fusername'])
    {
    echo "<font size=\"2px\" face=\"arial\"><b>Please select your account before changing your password</b><font>";
    }
  else
if (!$_SESSION['answered'])
    {
    echo "<font size=\"2px\" face=\"arial\"><b>Please answer the security question before changing your password</b></font>";
    }
  else
    {
    /* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    /* Now we validate the form */

    // Password and confirm password fields must not be blank

    if ($pwd1 == "" || $pwd2 == "")
        {
        exit("<font size=\"2px\" face=\"arial\"><b>Error : Form contains missing values<b></font>");
        }

    // Password and confirm password field must be same

    if ($pwd1 != $pwd2)
        {
        exit("<font size=\"2px\" face=\"arial\"><b>Error : Passwords do not match</b></font>");
        }

    // Password must be of minimum 8 characters.

    if (strlen($pwd1) < '8')
        {
        exit("<font size=\"2px\" face=\"arial\"><b>Error : Password must be at least 8 character long</b></font>");
        }

    // Password must be of maximum 32 characters.

    if (strlen($pwd1) >= '32')
        {
        exit("<font size=\"2px\" face=\"arial\"><b>Error : Password must be at max 32 character long</b></font>");
        }

    // Password must contain atleast one small letter. See the use of preg_match()

    if (!preg_match("#[a-z]+#", $pwd1))
        {
        exit("<font size=\"2px\" face=\"arial\"><b>Error : Your Password Must Contain At Least 1 small letter</b></font>");
        }

    /* We take the session variables from the session */
    $username1 = $_SESSION['fusername'];
    $rollno = $_SESSION['frollno'];
    /* This is an important include for connecting to the database*/
    include ('config.php');

    /* The password has been validated and we hash it using md5. The hashing ensures that our database doesn't stores the password. MD5 is a strong hashing and cannot be decrypted easily */
    $pwd1 = md5($pwd1);

    //We run the query now
    
    $sql2 = "UPDATE registered_users SET password='" . $pwd1 . "' WHERE username='" . $username1 . "'";
    if (mysqli_query($conn, $sql2))
        {

        // If update operation is successful then the script returns 0

        echo "0";
        }
      else
        {

        // If update was not successful the script returns a error

        echo "Error : Unknown error";
        }

    mysqli_close($conn);
    }

?>