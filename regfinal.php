<?php
/* This is the final script for user registration process. We first make sure that the user has filled out the first form where he/she is asked for roll no and date of birth. To do this we simply check the session variables */
session_start();

if (!$_SESSION['id'] || !$_SESSION['name'] || !$_SESSION['rollno'] || !$_SESSION['roomno'] || !$_SESSION['sex'] || !$_SESSION['branch'] || !$_SESSION['sem'] || !$_SESSION['dob'])
    {
    echo "Please enter your Rollno and Date of Birth first to register";
    }
  else
    {
    /* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
    $username1 = $_POST['username'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $secques = $_POST['secques'];
    $secans = $_POST['secans'];
    /* Now we validate the form data one by one */

    // The username, password and confirm password field must not be empty */

    if ($pwd1 == "" || $username1 == "" || $pwd2 == "")
        {
        exit("Error : Form contains missing values");
        }

    // Username must not be less than 4 characters or greater than 17 characters or same as password entered

    if (strlen($username1) < '4')
        {
        exit("Error : Username must be at least 4 character long");
        }

    if (strlen($username1) >= '18')
        {
        exit("Error : Username must be at max 15 character long");
        }

    if ($pwd1 == $username1)
        {
        exit("Error : Password cannot be same as username");
        }

    // Password and confirm password field must be same.

    if ($pwd1 != $pwd2)
        {
        exit("Error : Passwords do not match");
        }

    // Password must be of minimum 8 characters and maximum 32 characters and must contain at least one small letter

    if (strlen($pwd1) < '8')
        {
        exit("Error : Password must be at least 8 character long");
        }

    if (strlen($pwd1) >= '32')
        {
        exit("Error : Password must be at max 32 character long");
        }

    if (!preg_match("#[a-z]+#", $pwd1))
        {
        exit("Error : Your Password Must Contain At Least 1 small letter");

        // We then make sure that user has entered correct security question

        }

    if (!($secques == 1 || $secques == 2 || $secques == 3 || $secques == 4))
        {
        exit("Error : Please choose the correct question");
        }

    // And lastly the security answer field must not be empty

    if ($secans == "")
        {
        exit("Error : Please enter the answer");
        }

    /* Before storing the password in the database, the password must be hashed to maintain the integrity of the user. We use MD5 which is a strong password encryption technique */
    $pwd1 = md5($pwd1);
    /* This is an important include for connecting to the database*/
    include ('config.php');

    /* The first query makes sure that the username is unique. If its not we throw a error*/
    $sql1 = "SELECT * FROM registered_users WHERE username='$username1'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0)
        {
        exit("Error : Username already exists. Please enter a different username");
        }
      else
        {
        /* User data has been successfully filtered and now we take userdata and session variables obtained from the last script and insert a new login record in registered_users */

        // We also capture the IP of registration

        $id = $_SESSION[id];
        $roomno = $_SESSION[roomno];
        $branch = $_SESSION[branch];
        $sex = $_SESSION[sex];
        $dob = $_SESSION[dob];
        $sem = $_SESSION[sem];
        $rollno = $_SESSION[rollno];
        $name = $_SESSION[name];
        $sql2 = "INSERT INTO registered_users (id, rollno, dob, roomno, name, sex, branch, sem, username, password, secques,secans,ip) VALUES ('" . $id . "','" . $rollno . "','" . $dob . "','" . $roomno . "','" . $name . "','" . $sex . "','" . $branch . "'," . $sem . ",'" . $username1 . "','" . $pwd1 . "'," . $secques . ",'" . $secans . "','" . $_SERVER[REMOTE_ADDR] . "')";
        if (mysqli_query($conn, $sql2))
            {

            // If the insert operation was successful then we simply echo 0, which directs the browser to refresh the page. See script.js

            session_destroy();
            setCookie("cin", "cin", time() - 3600, "/");
            echo "0";
            }
          else
            {

            // If some error occurs during registration

            echo "Unknown error occured";
            }
        }

    mysqli_close($conn);
    }
