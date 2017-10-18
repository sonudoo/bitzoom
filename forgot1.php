<?php
session_start();

if (!$_SESSION['fusername'])
{
    exit("<b>Please select your account before answering the question</b>");
}
else{

    $username1 = $_SESSION['fusername'];
    $rollno = $_SESSION['frollno'];
    $secans = $_POST['secans'];

    if ($secans == "")
    {
        exit("0");
    }

    include ('config.php');

    $sql1 = "SELECT * FROM registered_users WHERE username='$username1' AND secans='$secans' AND rollno='$rollno'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0)
    {
        $_SESSION['answered'] = 1;
        echo "<input type=\"password\" placeholder=\"New Password\" class=\"form-control center-block\" name=\"forgotPassword1\" id=\"forgotPassword1\" ><br>
                <input type=\"password\" placeholder=\"Confirm Password\" class=\"form-control center-block\" name=\"forgotPassword2\" id=\"forgotPassword2\"><br>
                <button type=\"button\" onclick=\"checkForgot3()\" class=\"btn btn-primary\">Change my password</button><br /><br />";
    }
    else
    {
        echo "0";
    }
    mysqli_close($conn);
}

?>