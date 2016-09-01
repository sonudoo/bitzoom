<?php
/* This is the first script for user registration. I have taken the hostel records to validate the user details so that there is no fake registration. If your college doesn't provide user information, you may add some more fields to this form itself to enable registration from scratch.  Make sure you need to find your own way to validate the sign up process. Username, Password and Security Question fields are present in the next field. */

/* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */

$rollno = $_POST['rollno']; //Roll no in the form of BE/100XX/YY
$dob1 = $_POST['dob1']; //In DD/MM/YYYY
$dob2 = $_POST['dob2']; //In MM/DD/YYYY
$rollarr = explode("/", $rollno); //
$iparr = explode(".", $_SERVER[REMOTE_ADDR]); //IP address of regitration of user.
/* This is an important include for connecting to the database*/
include ('config.php');

/* The hostel records I have contain DOB given in both DDMMYYYY and MMDDYYYY format, so we use both these combination to search for a record */
$sql1 = "SELECT * FROM user_details WHERE rollno='$rollno' AND dob='$dob1'";
$sql2 = "SELECT * FROM user_details WHERE rollno='$rollno' AND dob='$dob2'";
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0)
  {
  if (mysqli_num_rows($result1) > 0)
    {
    while ($row1 = mysqli_fetch_assoc($result1))
      {
      /* If a record is found then we echo out the next form */
      echo "
<div class=\"row\">
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>BITzoom ID : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['id'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Name : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['name'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Gender : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['sex'] . "</b></font></div>
</div>

<div class=\"row\">
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b><font size=\"2px\" face=\"arial\"><b>Hostel/Room no: </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['roomno'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b><font size=\"2px\" face=\"arial\"><b>Roll no : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $rollno . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Date of Birth : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $dob1 . "</b></font></font></div>
</div>
<br /><br /></b></b></b>


        <div class=\"input-group input-group-lg\" style=\"margin:0px 0px 5px 20px; \">
  <span class=\"input-group-addon\" id=\"sizing-addon1\"><span class=\"glyphicon glyphicon-user\"></span></span>
  <input type=\"text\" style=\"width:auto\" class=\"form-control\"  placeholder=\"Username\" aria-describedby=\"sizing-addon1\" id=\"reg_username\">
</div>

<div class=\"input-group input-group-lg\" style=\"margin:0px 0px 5px 20px; \">
  <span class=\"input-group-addon\" id=\"sizing-addon1\"><span class=\"glyphicon glyphicon-eye-open\"></span></span>
  <input type=\"password\" style=\"width:auto\" class=\"form-control\"  placeholder=\"Password\" aria-describedby=\"sizing-addon1\" id=\"reg_pwd1\">
</div>

<div class=\"input-group input-group-lg\" style=\"margin:0px 0px 5px 20px; \">
  <span class=\"input-group-addon\" id=\"sizing-addon1\"><span class=\"glyphicon glyphicon-eye-open\"></span></span>
  <input type=\"password\" style=\"width:auto\" class=\"form-control\"  placeholder=\"Confirm Password\" aria-describedby=\"sizing-addon1\" id=\"reg_pwd2\">
</div>
<font size=\"2px\" face=\"arial\"><b>Security Question (Incase you forgot your password): </b></font>

<br /><br />

<select class=\"form-control\" style=\"width:auto;display:inline\" id=\"secques\">
<option value=\"1\">Whats your favorite book?</option><option value=\"2\">Whats your pet's name?</option><option value=\"3\">Who according to you created this world?</option><option value=\"4\">Which is your favorite song?</option>
  </select>
 <br /><br />
 

<div class=\"input-group input-group-lg\" style=\"margin:0px 0px 5px 20px; \">
  <span class=\"input-group-addon\" id=\"sizing-addon1\"><span class=\"glyphicon glyphicon-user\"></span></span>
  <input type=\"password\" style=\"width:auto\" class=\"form-control\"  placeholder=\"Security answer\" aria-describedby=\"sizing-addon1\" id=\"secans\" style=\"display:inline\">
</div>
<br /><br />
<button type=\"button\" onclick=\"checkRegForm()\" class=\"btn btn-primary \" style=\"vertical-align:middle\">Sign up</button>&nbsp;&nbsp;&nbsp;<a href=index.php?register=1><font face=arial size=2px><b>Not me try again</b></font></a><br /><br />";
      /* Here we also initiate a session so that the user can be validated in the next script */
      session_start();
      $_SESSION['id'] = $row1['id'];
      $_SESSION['rollno'] = $rollno;
      $_SESSION['name'] = $row1['name'];
      $_SESSION['sex'] = $row1['sex'];
      $_SESSION['roomno'] = $row1['roomno'];
      $_SESSION['branch'] = $row1['branch'];
      $_SESSION['dob'] = $dob1;
      $_SESSION['sem'] = $row1['sem'];
      }
    }
    else
  if (mysqli_num_rows($result2) > 0)
    {
    while ($row2 = mysqli_fetch_assoc($result2))
      {
      /* If a record is found then we echo out the next form. Note that the previous was for DDMMYYYY and this one is for MMDDYYYY format. If a record is found in MMDDYYYY format then we update it to DDMMYYYY. Thus our record is auto-corrected by user itself. Remember that this was for my college. You may add your own technique of user registration */
      $sql3 = "UPDATE user_details SET dob='$dob1' WHERE rollno='$rollno'";
      $result3 = mysqli_query($conn, $sql3);
      if (!$result3)
        {
        echo "Unknown error occured. Please come back later";
        }

      echo "<div class=\"row\">
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>BITzoom ID : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['id'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Name : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['name'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Gender : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['sex'] . "</b></font></div>
</div>

<div class=\"row\">
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b><font size=\"2px\" face=\"arial\"><b>Hostel/Room no: </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $row1['roomno'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b><font size=\"2px\" face=\"arial\"><b>Roll no : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $rollno . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Date of Birth : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $dob2 . "</b></font></font></div>
</div>
<br /><br /></b></b></b>


        <div class=\"input-group input-group-lg\" style=\"margin:0px 0px 5px 20px; \">
  <span class=\"input-group-addon\" id=\"sizing-addon1\"><span class=\"glyphicon glyphicon-user\"></span></span>
  <input type=\"text\" style=\"width:auto\" class=\"form-control\"  placeholder=\"Username\" aria-describedby=\"sizing-addon1\" id=\"reg_username\">
</div>

<div class=\"input-group input-group-lg\" style=\"margin:0px 0px 5px 20px; \">
  <span class=\"input-group-addon\" id=\"sizing-addon1\"><span class=\"glyphicon glyphicon-eye-open\"></span></span>
  <input type=\"password\" style=\"width:auto\" class=\"form-control\"  placeholder=\"Password\" aria-describedby=\"sizing-addon1\" id=\"reg_pwd1\">
</div>

<div class=\"input-group input-group-lg\" style=\"margin:0px 0px 5px 20px; \">
  <span class=\"input-group-addon\" id=\"sizing-addon1\"><span class=\"glyphicon glyphicon-eye-open\"></span></span>
  <input type=\"password\" style=\"width:auto\" class=\"form-control\"  placeholder=\"Confirm Password\" aria-describedby=\"sizing-addon1\" id=\"reg_pwd2\">
</div>
<font size=\"2px\" face=\"arial\"><b>Security Question (Incase you forgot your password): </b></font>

<br /><br />

<select class=\"form-control\" style=\"width:auto;display:inline\" id=\"secques\">
<option value=\"1\">Whats your favorite book?</option><option value=\"2\">Whats your pet's name?</option><option value=\"3\">Who according to you created this world?</option><option value=\"4\">Which is your favorite song?</option>
  </select>
 <br /><br />
 

<div class=\"input-group input-group-lg\" style=\"margin:0px 0px 5px 20px; \">
  <span class=\"input-group-addon\" id=\"sizing-addon1\"><span class=\"glyphicon glyphicon-user\"></span></span>
  <input type=\"password\" style=\"width:auto\" class=\"form-control\"  placeholder=\"Security answer\" aria-describedby=\"sizing-addon1\" id=\"secans\" style=\"display:inline\">
</div>
<br /><br />
<button type=\"button\" onclick=\"checkRegForm()\" class=\"btn btn-primary \" style=\"vertical-align:middle\">Sign up</button>&nbsp;&nbsp;&nbsp;<a href=index.php?register=1><font face=arial size=2px><b>Not me try again</b></font></a><br /><br />";

      // Start the session so that final registration can be validated

      session_start();
      $_SESSION['id'] = $row2['id'];
      $_SESSION['rollno'] = $rollno;
      $_SESSION['name'] = $row2['name'];
      $_SESSION['sex'] = $row2['sex'];
      $_SESSION['roomno'] = $row2['roomno'];
      $_SESSION['branch'] = $row2['branch'];
      $_SESSION['dob'] = $dob1;
      $_SESSION['sem'] = $row2['sem'];
      }
    }
  }
  else
  {
  if ($rollarr[2] == "16" && (!isset($_COOKIE['cin'])))
    {
    /* If a student is newly registered in our college. (For example first year student), I won't have a record of that student in hostel allotment list, since it is prepared before the freshers are alloted a hostel. So we create a seperate registration form for them */
    echo "<font color=black face=arial size=2px><b>You seem to be a new student of BIT. We don't have your data in our database. Please register using this form</b></font><br /><br /><button type=\"button\" onclick=\"location.href='newreg/new.php'\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Register as a new BIT student</button>&nbsp;&nbsp;&nbsp;";
    exit;
    }
    else
    {
    /*If no record is found in the database, we echo 0 */
    echo "0";
    }
  }

mysqli_close($conn);
?>