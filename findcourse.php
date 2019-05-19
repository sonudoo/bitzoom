<?php 
/* This is another important file which basically lists down the subject related to the major and semester. Whenever a user selects a course, a request is made to database which replies back all the possible subjects related to the major and sem. The reply is made in the form of a 'select' form from which user can select te desired subject */ 

/* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */

$major = $_POST['major'];
$sem = $_POST['sem'];

/* Now we validate the user data, For this we check that the major and semester field is not empty. If user selects an empty field the script dies. Remember here echo "0" doesn 't imply script has successfully executed.*/

if ($major == "" || $sem == "")
	{
	echo "0";
	exit();
	}

/* This is an important include for connecting to the database*/
include ('config.php ');

/* Now we run the SQL query in which we look for all courses where major and sem is like the one user has entererd*/
$sql1 = "SELECT * FROM course WHERE major LIKE '%$major%' AND sem LIKE '%$sem%'";
$result1 = mysqli_query($conn, $sql1);
/* If the result of query is greater than 0 then courses has been found and we list down the courses along with course ID */

if (mysqli_num_rows($result1) > 0)
	{
	echo "<br><br><select class=\"form-control\" name=\"course\" id=\"course\" style=\"background-color:white;height:40px;border-radius:5px; font-size:20px; color:grey; font-family:times;font-weight:bold\" onchange=\"coursefunc()\">";
	echo "<option value=\"\">---</option>";
	while ($row1 = mysqli_fetch_assoc($result1))
		{
		echo "<option value=\"" . $row1['courseid'] . "\">" . $row1['coursename'] . " (" . $row1['courseid'] . ")</option>";
		}

	echo "</select><br><br>";
	}
  else
	{
	/* If no course is found, we echo 0, the 0 doesn't mean that script is successful. Check script.js to understand */
	echo "0";
	}

mysqli_close($conn); 
?>
