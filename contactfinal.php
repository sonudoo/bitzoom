<?php
/* Here is the script that validates contact form and puts the record into the database in case the validation succeeds */
/* The following lines include the CAPTCHA library (securimages) for Human verification */
require_once 'secureimages/securimage.php';

/* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
$name = $_POST['name']; //Name entered  by user
$email = $_POST['email']; //Email ID entered by user
$phno = $_POST['phno']; //Phone number entered by user
$message = $_POST['message']; //The message that the user wants to provide
$secans = $_POST['secans']; //The value of CAPTCHA image solved by user

// First validation is for any empty input fields.

if ($name == "" || $email == "" || $phno == "" || $message == "")
  {
  exit("Error : Form contains missing values");
  }

// Second validation is for Name. It must contain only letters. See the use of preg_match()

if (!preg_match("/^[a-zA-Z ]*$/", $name))
  {
  exit("Error: Please enter your correct name");
  }

// Third is the validation of Email. See the use of parameter FILTER_VALIDATE_EMAIL

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
  exit("Error : Invalid email format");
  }

// Fourth we validate the Phno. It first checks for Number only format and then checks if its length exactly equals 10

if (!preg_match("/^[0-9 ]*$/", $phno))
  {
  exit("Error: Please enter correct phone number");
  }

if (strlen($phno) != 10)
  {
  exit("Error: Please enter correct phone number. It must be strictly 10 digits long");
  }

// Last we validate the captcha entered. The script exits if the captcha entered is wrong.

$image = new Securimage();

if ($image->check($_POST['captcha_code']) == true)
  {
  }
  else
  {
  exit("Invalid Captcha. Please reload the captcha and try again");
  }

/* This is an important include for connecting to the database*/
include('config.php');

// Now we enter the data to the contact table.

$sql1 = "INSERT INTO contact (name,email,phno,message) VALUES ('" . $name . "','" . $email . "','" . $phno . "','" . $message . "')";

if (mysqli_query($conn, $sql1))
  {

  // If the insert operation was successful then the script echoes/returns 0, which is signal for confirmation

  echo "0";
  }
  else
  {

  // The insert operation was not successful. Error occured.

  echo "An unknown error occured.";
  }

// Close the connection made to the database.

mysqli_close($conn);
?>