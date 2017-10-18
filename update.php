<?php
/* This script is executed when the user asks for update of the password */

// First the user must be logged in. We check for the existence of the session variables, if they are not set, the script throws an error

session_start();

if (!$_SESSION['id'] || (!$_SESSION['name']) || (!$_SESSION['rollno']) || (!$_SESSION['sex']) || (!$_SESSION['branch']) || (!$_SESSION['sem']) || (!$_SESSION['dob']))
    {
    echo "Please login first to update your details";
    }
  else
    {
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $curr_pwd = $_POST['currpwd'];

    if ($pwd1 == "" || $pwd2 == "" || $curr_pwd == "")
        {
        exit("Error : Form contains missing values");
        }


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

    if (strlen($pwd1) < 6)
        {
        exit("Error : Password must be at least 6 character long");
        }

    // Password must be at max 32 characters long

    if (strlen($pwd1) > 20)
        {
        exit("Error : Password must be at max 20 character long");
        }


    $pwd1 = md5($pwd1);
    $curr_pwd = md5($curr_pwd);
    $username1 = $_SESSION['username'];
    include ('config.php');


    $sql1 = "SELECT * FROM registered_users WHERE username='$username1' AND password='$curr_pwd'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) === 1)
        {


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

        exit("Error: Please enter the correct current password");
        }

    mysqli_close($conn);
    }

?>