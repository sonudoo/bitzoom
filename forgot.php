<?php
/* What if user forgets the password. This is one of the three file which runs on backend to help the user to recover the password. The first step is to ask for Roll no and username of user and based on this if a record is found we ask for the answer to security question. */
/* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
$rollno = $_POST['rollno'];
$username1 = $_POST['username'];
/* This is an important include for connecting to the database*/
include ('config.php');

/* Now we run the SQL query to check if there is any record that has the inputted roll number ans username*/
$sql1 = "SELECT * FROM registered_users WHERE rollno='$rollno' AND username='$username1'";
$result1 = mysqli_query($conn, $sql1);
/* If a record is found, we start a session, echo out the Security question and wait for the user to enter the answer entered by the user. The answer is validated in the next script. Since a session is started so we can easily check the user's answers */

if (mysqli_num_rows($result1) > 0)
	{
	while ($row1 = mysqli_fetch_assoc($result1))
		{
		echo "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=\"2px\" face=\"arial\">Roll no : </font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $rollno . "</b></font><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=\"2px\" face=\"arial\"><b>Name : </b></font><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['name'] . "</font><br /><br /><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=\"2px\" face=\"arial\"><b>Username : </b></font><font size=\"2px\" face=\"arial\" color=blue><b>" . $username1 . "</b></font><br /><br />
		   <font size=\"2px\" face=\"arial\"><b>Security Question (as set by you during registration): </b></font><font size=\"2px\" face=\"arial\" color=green><b>";

		// Session needs to be started

		session_start();
		$_SESSION['fusername'] = $username1;
		$_SESSION['frollno'] = $rollno;

		// Session was started ans session variables were stored.

		/* In the database the question is stored as numeric equivalent, so we need to decode it to question. The following lines does the same */
		if ($row1['secques'] == 1)
			{
			echo "<input type=\"hidden\" value=\"1\" id=\"f_secques\">";
			echo "Whats your favorite book?";
			}
		  else
		if ($row1['secques'] == 2)
			{
			echo "<input type=\"hidden\" value=\"1\" id=\"f_secques\">";
			echo "WWhats your pet's name?";
			}
		  else
		if ($row1['secques'] == 3)
			{
			echo "<input type=\"hidden\" value=\"1\" id=\"f_secques\">";
			echo "Who according to you created this world?";
			}
		  else
		if ($row1['secques'] == 4)
			{
			echo "<input type=\"hidden\" value=\"1\" id=\"f_secques\">";
			echo "Which is your favorite song?";
			}

		echo "</b></font><br /><br /><font size=\"2px\" face=\"arial\"><b>Security Answer (Case sensitive): </b></font><input type=\"password\" class=\"form-control\" name=\"secans\" id=\"f_secans\"><br />
		<button type=\"button\" onclick=\"checkForgot1()\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Verify</button><br /><br />";
		}
	}
  else
	{
	/* If no such record is found, the script echo 0 which is interpreted by script.js that no record has been found */
	echo "0";
	}

mysqli_close($conn);
?>