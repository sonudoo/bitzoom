<?php
/* This is the script which runs to login a user */
/* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
$username1 = $_POST['username']; //The username entered by the user
$password1 = $_POST['password']; //The password entered by user
$rme = $_POST['rme']; // If the user has checked "Keep logged in" option or not
/* We first validate that the username or password entered by the user is not empty */

if ($password1 == "" || $username1 == "")
    {
    exit("<font size=\"2px\" face=\"arial\"><b>Error : Form contains missing values</b></font>");
    }

/* This is an important include for connecting to the database*/
include ('config.php');

/* We hash the password as the database stores hashed password only */
$password1 = md5($password1);
/* Now we run the SQL query. The result of the query must return only a single row. This is because we have already kept the username field unique */
$sql1 = "SELECT * FROM registered_users WHERE username='$username1'";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) === 1)
    {
    while ($row1 = mysqli_fetch_assoc($result1))
        {
        /* If a username is found then we take out the password hash from the table row and compare it with the one entered by the user. To validate it must match equivalently. Checking the password later also reduces the chances of SQL injections */
        if ($password1 === $row1['password'])
            {

            // If password matches user logs in and session is started

            session_start();
            $_SESSION['id'] = $row1['id'];
            $_SESSION['rollno'] = $row1['rollno'];
            $_SESSION['name'] = $row1['name'];
            $_SESSION['sex'] = $row1['sex'];
            $_SESSION['roomno'] = $row1['roomno'];
            $_SESSION['branch'] = $row1['branch'];
            $_SESSION['dob'] = $row1['dob'];
            $_SESSION['sem'] = $row1['sem'];
            $_SESSION['username'] = $username1;
            $_SESSION['msg'] = $row1['notify'];
            if ($rme == "yes")
                {
                /* If the user required us to keep him logged in, then we simple generate username and password hashes and store it in the user's browser and insert the same data in a table called loggedin_users */
                $username2 = md5($username1);
                $sql2 = "INSERT INTO loggedin_users (username,ip,cookie,cookie2) VALUES ('" . $username1 . "','" . $_SERVER[REMOTE_ADDR] . "','" . $username2 . "','" . $password . "')";
                if (mysqli_query($conn, $sql2))
                    {
                    setCookie("rl1", $username2, time() + 86400 * 30, "/");
                    setCookie("rl2", $password1, time() + 86400 * 30, "/");
                    }
                  else
                    {
                    exit("Unknown error occured");
                    }
                }

            // The script returns 0 on successful login which instructs the browser to reload the page. See script.js

            echo "0";
            }
          else
            {
            /* If the password doesn't match we report a error. Make sure you donot use only password error */
            exit("<font size=\"2px\" face=\"arial\"><b>Error : No such username or password found. </b></font>");
            }
        }
    }
  else
    {
    /* If the username doesn't exists in the database we report a error. Make sure you donot use only password error */
    exit("<font size=\"2px\" face=\"arial\"><b>Error : No such username or password found. </b></font>");
    }

mysqli_close($conn);
?>