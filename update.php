<?php
/* This script is executed when the user asks for update of the password */

// First the user must be logged in. We check for the existence of the session variables, if they are not set, the script throws an error

session_start();

if (!$_SESSION['id'] || (!$_SESSION['name']) || (!$_SESSION['rollno']) || (!$_SESSION['roomno']) || (!$_SESSION['sex']) || (!$_SESSION['branch']) || (!$_SESSION['sem']) || (!$_SESSION['dob']))
    {
    echo "Please login first to update your details";
    }
  else
    {
    /* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $curr_pwd = $_POST['currpwd'];
    /* Now we validate the form */

    // None of the fields must contain a missing value

    if ($pwd1 == "" || $pwd2 == "" || $curr_pwd == "")
        {
        exit("Error : Form contains missing values");
        }

    // The password and confirm password field must have the same value.

    if ($pwd1 != $pwd2)
        {
        exit("Error : Passwords do not match");
        }

    // Password must not be same as username

    if ($pwd1 == $_SESSION['username'])
        {
        exit("Error : Passwords cannot be same as username");
        }

    // Password must not be same as current password

    if ($pwd1 === $curr_pwd)
        {
        exit("Error : Current password and new password cannot be same");
        }

    // Password must be atleast 8 characters long

    if (strlen($pwd1) < '8')
        {
        exit("Error : Password must be at least 8 character long");
        }

    // Password must be at max 32 characters long

    if (strlen($pwd1) >= '32')
        {
        exit("Error : Password must be at max 32 character long");
        }

    // Password must contain atleast one small letter

    if (!preg_match("#[a-z]+#", $pwd1))
        {
        exit("Error : Your Password Must Contain At Least 1 small letter");
        }

    /*Form validation completes */

    // Now we hash the passwords and update the password

    $pwd1 = md5($pwd1);
    $curr_pwd = md5($curr_pwd);
    $username1 = $_SESSION['username'];
    /* This is an important include for connecting to the database*/
    include ('config.php');

    // First we check if the user has entered correct current password by running the following query

    $sql1 = "SELECT * FROM registered_users WHERE username='$username1' AND password='$curr_pwd'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) === 1)
        {

        // If yes we update the password

        $sql2 = "UPDATE registered_users SET password='" . $pwd1 . "' WHERE username='" . $username1 . "'";
        if (mysqli_query($conn, $sql2))
            {
            echo "0";
            }
          else
            {
            die("Connection failed: " . mysqli_query_error());
            }
        }
      else
        {

        // If no we throw an error

        exit("Error: Please enter the correct current password");
        }

    mysqli_close($conn);
    }

?>