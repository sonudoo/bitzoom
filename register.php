<?php
$rollno = $_POST['rollno'];
$dob = $_POST['dob'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phno = $_POST['phno'];
$username = $_POST['username'];
$major = $_POST['major'];
$semester = $_POST['semester'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$secques = $_POST['secques'];
$secans = $_POST['secans'];
$ip = $_SERVER['REMOTE_ADDR'];

$date = explode("/",$dob);
$roll = explode("/",$rollno);

if($roll[0]!="BE" || $roll[1] < 10001 || $roll[1] > 11000 || $roll[2] < 13 || $roll[2] > 17){
  exit("Roll no seems to be invalid.");
}
else if(!checkdate($date[1] ,$date[0] ,$date[2])){
  exit("Date of Birth doesn't seem to be valid."); 
}
else if (strlen($name)==0) {
  exit("Name seems to be invalid."); 
}
else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  exit("Name seems to be invalid."); 
}
else if($gender!="Male" && $gender!="Female"){
  exit("Please select a gender.");
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  exit("Email seems to be invalid."); 
}
else if (!preg_match("/^[0-9]*$/",$phno)) {
  exit("Phone number seems to be invalid."); 
}
else if (strlen($phno)!=10) {
  exit("Phone number seems to be invalid."); 
}
else if (strlen($username)==0) {
  exit("Please enter your username."); 
}
else if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
  exit("Only alphanummeric charaters and underscore allowed in username."); 
}
else if (strlen($username) > 15) {
  exit("Username can be maximum 15 characters long."); 
}
else if ($major!="CSE" && $major!="ECE" && $major!="EEE" && $major!="IT" && $major!="MECH" && $major!="BIOTECH" && $major!="CHEM" && $major!="CHEMP" && $major!="PROD" && $major!="CIVIL") {
  exit("Please select your Major."); 
}
else if ($semester < 1 || $semester > 8) {
  exit("Please select your Semester."); 
}
else if (strlen($password) < 6 || strlen($password) > 15) {
  exit("Password must be between 6 to 15 characters long."); 
}
else if ($password!=$cpassword) {
  exit("Passwords don't match."); 
}
else if ($secques < 1  || $secques > 4) {
  exit("Please select a security question."); 
}
else if (strlen($secans)==0) {
  exit("Please enter the answer to security question."); 
}
else{
  include ('config.php');
  $sql = "SELECT * FROM registered_users WHERE username = '$username'";
  $res = mysqli_query($conn, $sql);
  if(mysqli_num_rows($res)>0){
    exit("Username already exists.");
  } 
  $password = md5($password);
  $sql = "INSERT INTO registered_users (rollno,dob,name,email,phno,sex,branch,sem,username,password,secques,secans,ip) VALUES ('$rollno','$dob','$name','$email','$phno','$gender','$major','$semester','$username','$password','$secques','$secans','$ip')";
  if(mysqli_query($conn,$sql)){
    echo "0";
  }
  else{
    exit("Unknown error occured");
  }
}

mysqli_close($conn);
?>
