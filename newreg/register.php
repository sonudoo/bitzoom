<?php
/* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
$name = $_POST['name']; //Name entered by the user
$dob = $_POST['dob']; //Date of Birth entered by the user
$rollno = $_POST['rollno']; //Rollno entered by the user
$branch = $_POST['branch']; //Major selected by the user
$roomno = $_POST['roomno']; //Hostel and room no entered by the user. Change it to your own needs
$sex = $_POST['sex']; //Gender selected by the user
/*Now validate the form data */

// None of the fields must be empty

if ($name == "" || $dob == "" || $branch == "" || $roomno == "" || $rollno == "")
  {
  exit("Error: Form contains missing values");
  }

// Name must contain only letter and white spaces

if (!preg_match("/^[a-zA-Z ]*$/", $name))
  {
  exit("Only letters and white space allowed");
  }

// The following code validates the Date of Birth.

$list = explode("/", $dob);

if (sizeof($list) != 3)
  {
  exit("Invalid Date of Birth");
  }

if (!preg_match("/^[0-9 ]*$/", $list[2]))
  {
  exit("Invalid DOB. Please make sure the format is correct");
  }

if ($list[2] > 1999 || $list[2] < 1990)
  {

  // A student can be 17 to 26 years old as of 2016

  exit("Invalid DOB. Please make sure the format is correct");
  }

if (!preg_match("/^[0-9 ]*$/", $list[0]))
  {
  exit("Invalid DOB. Please make sure the format is correct");
  }

if ($list[0] < 1 || $list[0] > 31)
  {
  exit("Invalid DOB. Please make sure the format is correct");
  }

if (!preg_match("/^[0-9 ]*$/", $list[1]))
  {
  exit("Invalid DOB. Please make sure the format is correct");
  }

if ($list[1] < 1 || $list[1] > 12)
  {
  exit("Invalid DOB. Please make sure the format is correct");
  }

$list[0] = (int)$list[0];
$list[1] = (int)$list[1];
$list[2] = (int)$list[2];
$dob = $list[0] . "/" . $list[1] . "/" . $list[2];

// Rollno must be validated accordingly
// Next we need to validate that the major is selected from one of the fields

if ($branch != "CSE" && $branch != "ECE" && $branch != "EEE" && $branch != "IT" && $branch != "MECH" && $branch != "PROD" && $branch != "CIVIL" && $branch != "CHEM" && $branch != "BIOTECH")
  {
  exit("Invalid branch selected");
  }

// Roomno must contain only numbers. Change the validation to your needs.

if (!preg_match("/^[0-9 ]*$/", $roomno))
  {
  exit("Invalid Room no." . $roomno);
  }

/*Form validation ends */
/* This is an important include for connecting to the database*/
include ('../config.php');

// Now we insert the records to user_details table and redirect the user to home page register modal to complete the registration

$sql2 = "INSERT INTO user_details (rollno, dob, roomno, name, sex, branch, sem) VALUES ('" . $rollno . "','" . $dob . "','" . $roomno . "','" . $name . "','" . $sex . "','" . $branch . "','1')";

if (mysqli_query($conn, $sql2))
  {
  session_start();
  session_destroy();
  setCookie("cin", "cin", time() + 86400, "/");
  echo "0";
  }
  else
  {
  echo "Error: " . $sql . "<br />" . mysqli_error($conn);
  }

mysqli_close($conn);
?>