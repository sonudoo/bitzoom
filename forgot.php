<?php
$rollno = $_POST['rollno'];
$username1 = $_POST['username'];

include ('config.php');

$sql1 = "SELECT * FROM registered_users WHERE rollno='$rollno' AND username='$username1'";

$result1 = mysqli_query($conn, $sql1);


if (mysqli_num_rows($result1) > 0){
	while ($row1 = mysqli_fetch_assoc($result1))
	{
		echo "<b>Roll no: <font color='lightyellow'>".$rollno ."</font><br>Name: <font size=\"2px\" face=\"arial\" color='lightyellow'>".$row1['name']."</font><br>Username: <font color='lightyellow'>" . $username1 . "</font><br><br>Security Question (as set by you during registration):<br><br><font color='lightgreen'>";

		session_start();
		$_SESSION['fusername'] = $username1;
		$_SESSION['frollno'] = $rollno;

		if ($row1['secques'] == 1)
			{
			echo "<input type=\"hidden\" value=\"1\" id=\"forgotSecques\">";
			echo "What is your favorite book?";
			}
		  else
		if ($row1['secques'] == 2)
			{
			echo "<input type=\"hidden\" value=\"2\" id=\"forgotSecques\">";
			echo "What is your pet's name?";
			}
		  else
		if ($row1['secques'] == 3)
		{
			echo "<input type=\"hidden\" value=\"3\" id=\"forgotSecques\">";
			echo "Who according to you created this world?";
		}
		else if ($row1['secques'] == 4)
		{
			echo "<input type=\"hidden\" value=\"4\" id=\"forgotSecques\">";
			echo "What is your favorite song?";
		}
		echo "</font><br><br><b>Security Answer (Case sensitive): </b></font><input type=\"password\" class=\"form-control center-block\" name=\"secans\" id=\"forgotSecans\"><br />
		<button type=\"button\" onclick=\"checkForgot1()\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Verify</button><br /><br />";
		}
	}
  	else
	{
		echo "0";
	}

mysqli_close($conn);
?>