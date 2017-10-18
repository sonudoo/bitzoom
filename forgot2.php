<?php

session_start();

if (!$_SESSION['fusername'])
    {
    echo "Please select your account before changing your password";
    }
  else
if (!$_SESSION['answered'])
    {
    echo "Please answer the security question before changing your password";
    }
  else
    {
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    /* Now we validate the form */

    // Password and confirm password fields must not be blank

    if ($pwd1 == "" || $pwd2 == "")
        {
        exit("Error : Form contains missing values");
        }

    // Password and confirm password field must be same

    if ($pwd1 != $pwd2)
        {
        exit("Error : Passwords do not match");
        }

    // Password must be of minimum 8 characters.

    if (strlen($pwd1) < '8')
        {
        exit("Error : Password must be at least 8 character long");
        }

    // Password must be of maximum 32 characters.

    if (strlen($pwd1) >= '32')
        {
        exit("Error : Password must be at max 32 character long");
        }

    // Password must contain atleast one small letter. See the use of preg_match()

    if (!preg_match("#[a-z]+#", $pwd1))
        {
        exit("<font size=\"2px\" face=\"arial\"><b>Error : Your Password Must Contain At Least 1 small letter</b></font>");
        }

    $username1 = $_SESSION['fusername'];
    $rollno = $_SESSION['frollno'];
    include ('config.php');
    $pwd1 = md5($pwd1);

    //We run the query now
    
    $sql2 = "UPDATE registered_users SET password='" . $pwd1 . "' WHERE username='" . $username1 . "'";
    if (mysqli_query($conn, $sql2))
        {

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