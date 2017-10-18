<?php

session_start();

if (!$_SESSION['id'] || (!$_SESSION['name']) || (!$_SESSION['rollno']) || (!$_SESSION['sex']) || (!$_SESSION['branch']) || (!$_SESSION['sem']) || (!$_SESSION['dob']))
{
    echo "Please login first to update your details";
}
  else
  {
    $major = $_POST['major'];
    $sem = $_POST['sem'];

    if ($major!="CSE" && $major!="ECE" && $major!="EEE" && $major!="IT" && $major!="MECH" && $major!="BIOTECH" && $major!="CHEM" && $major!="CHEMP" && $major!="PROD" && $major!="CIVIL") {
      exit("Select your Major."); 
    }
    else if ($sem < 1 || $sem > 8) {
      exit("Select your Semester."); 
    }

    $username1 = $_SESSION['username'];

    include ('config.php');

    $sql2 = "UPDATE registered_users SET branch='$major',sem='$sem' WHERE username='$username1'";
    if (mysqli_query($conn, $sql2))
    {
        $_SESSION['branch'] = $major;
        $_SESSION['sem'] = $sem;
        echo "0";
    }
    else
    {
        exit("Unknown error");
    }

    mysqli_close($conn);
}

?>