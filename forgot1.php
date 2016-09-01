<?php
/* This is the second file for forgot your password option. This script requires forgot session to be started, which is started when the user successfully selects a valid roll no and username. If a session is not already created, the script dies throwing an exception */
session_start();

if (!$_SESSION['fusername'])
    {
    exit("<font size=\"2px\" face=\"arial\"><b>Please select your account before answering the question</b></font>");
    }
  else
    {
    /* If the forgot session has already been established, we take the session variables from the session */
    $username1 = $_SESSION['fusername'];
    $rollno = $_SESSION['frollno'];
    /* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
    $secans = $_POST['secans'];

    // Now we validate the data; if its null, the script dies throwing a answer wrong exception. Check script.js to see implementation

    if ($secans == "")
        {
        exit("0");
        }

    /* This is an important include for connecting to the database*/
    include ('config.php');

    /*Now we run the SQL and check if the answer matches. If the answer matches we take the user to next step to enter the new username and password */
    $sql1 = "SELECT * FROM registered_users WHERE username='$username1' AND secans='$secans' AND rollno='$rollno'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0)
        {
        $_SESSION['answered'] = 1;
        echo "<b><font size=\"2px\" face=\"arial\"><b>Username: </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $username1 . "
                </b></font><br /><br /><b><font size=\"2px\" face=\"arial\"><b>Password:</b></b>
                <input type=\"password\" class=\"form-control\" name=\"fpwd1\" id=\"f_pwd1\"></input><br />
                <b>Re-enter Password:</b>
                <input type=\"password\" class=\"form-control\" name=\"fpwd2\" id=\"f_pwd2\"></input><br /><br />
                <button type=\"button\" onclick=\"checkForgot3()\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Change my password</button><br /><br />";
        }
      else
        {
        /* If the answer doesn't match, we throw 0, check script.js for implementation details*/
        echo "0";
        }

    mysqli_close($conn);
    }

?>