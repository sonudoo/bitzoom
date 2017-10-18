<?php
$username1 = $_POST['username'];
$password1 = $_POST['password'];
$rme = $_POST['rme'];

if ($password1 == "" || $username1 == "")
{
    exit("Error : Form contains missing values");
}

include ('config.php');

$password1 = md5($password1);

$sql1 = "SELECT * FROM registered_users WHERE username='$username1'";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) === 1)
    {
    while ($row1 = mysqli_fetch_assoc($result1))
        {
        if ($password1 === $row1['password'])
            {

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
            if ($rme == "yes")
                {
                $username2 = md5($username1);
                $sql2 = "INSERT INTO loggedin_users (username,ip,cookie,cookie2) VALUES ('" . $username1 . "','" . $_SERVER[REMOTE_ADDR] . "','" . $username2 . "','" . $password1 . "')";
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

            echo "0";
            }
          else
            {
            exit("Error : No such username or password found.");
            }
        }
    }
  else
    {
    exit("Error : No such username or password found.");
    }

mysqli_close($conn);
?>