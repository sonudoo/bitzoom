<?php

$name = $_POST['name']; 
$email = $_POST['email'];
$phno = $_POST['phno']; 
$message = $_POST['message'];

if ($name == "" || $email == "" || $phno == "" || $message == "")
  {
  exit("Error : Form contains missing values");
  }


if (!preg_match("/^[a-zA-Z ]*$/", $name))
  {
  exit("Error: Please enter your correct name");
  }

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
  exit("Error : Invalid email format");
  }


if (!preg_match("/^[0-9 ]*$/", $phno))
  {
  exit("Error: Please enter correct phone number");
  }

if (strlen($phno) != 10)
  {
  exit("Error: Please enter correct phone number. It must be strictly 10 digits long");
  }

include('config.php');
$sql1 = "INSERT INTO contact (name,email,phno,message) VALUES ('" . $name . "','" . $email . "','" . $phno . "','" . $message . "')";

if (mysqli_query($conn, $sql1))
  {

  echo "0";
  }
  else
  {


  echo "An unknown error occured.";
  }


mysqli_close($conn);
?>