<?php /* This is the header file and the longest script of all. This file contains the header part of every page. It contains menus, logo, scripts, modals etc. */ ?>
<?php
/* Uncomment the following to add a hits counter for your site */
/*$datei = fopen("counter.log","r");
$count = fgets($datei,1000);
fclose($datei);
$count=$count + 1 ;
echo "$count" ;
echo " hits" ;
echo "\n" ;
$datei = fopen("counter.log","w");
fwrite($datei, $count);
fclose($datei);*/
?>
<?php 
/* Uncomment the following lines if you want to forse SSL on your website for secure browsing */ 
/*if($_SERVER[ "HTTPS"] !="on" ) { 
	$pageURL="Location: https://" ; 
	if ($_SERVER[ "SERVER_PORT"] !="80" ) { 
		$pageURL .=$ _SERVER[ "SERVER_NAME"] . ":" . $_SERVER[ "SERVER_PORT"] . $_SERVER[ "REQUEST_URI"]; 
	} else { 
		$pageURL .=$ _SERVER[ "SERVER_NAME"] . $_SERVER[ "REQUEST_URI"]; 
	} 
	header($pageURL); 
}*/ 
?>

<!-- This part creates a container which contains the logo and the toggle button -->

<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-4"><img src="zoom.png" class="img-responsive" style="height: 100px">
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
                <table>
                    <tr>
                        <td><span>

  <?php
session_start();

/* If the user is already logged in then check for username as a session variable and echo it */

if (isset($_SESSION['username']))
	{
	echo "<br /><font size=\"2px\" face=\"arial\"><b>Logged as: <font color=blue>" . $_SESSION['username'] . "</font></b></font><br /><br />";
	echo "<button onclick=\"change()\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Settings</button>";
	}

	/* If the user is not logged in then check for remember me cookie, This is because suppose the user has already checked "Keep logged in" during login then we check the cookie values and autologin the user */

  else if (isset($_COOKIE['rl1']))
	{
		/*Since cookie is again a user data, always filter the data using addslashes(mysql_real_escape(htmlspechialchars())). Never trust the use data */

	$rl1 = $_COOKIE['rl1'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$rl2 = $_COOKIE['rl2'];
	/* This is an important include for connecting to the database*/
	include('config.php');

	/* When a new record regarding "Keep logged in" is added to the database, we use three values namely username hash, password hash and IP address to validate the autologin */

	$sql1 = "SELECT * FROM loggedin_users WHERE cookie='$rl1' AND ip='$ip' AND cookie2='$rl2'";
	$result1 = mysqli_query($conn, $sql1);
	if (mysqli_num_rows($result1) > 0)
		{
		$row = mysqli_fetch_assoc($result1);

		/* If a record is found, we find the details of the users by running another query and store them as session */
		session_start();
		$_SESSION['username'] = $row['username'];
		$sql2 = "SELECT * FROM registered_users WHERE username='" . $_SESSION['username'] . "'";
		$result2 = mysqli_query($conn, $sql2);
		while ($row1 = mysqli_fetch_assoc($result2))
			{
			$_SESSION['id'] = $row1['id'];
			$_SESSION['rollno'] = $row1['rollno'];
			$_SESSION['name'] = $row1['name'];
			$_SESSION['sex'] = $row1['sex'];
			$_SESSION['roomno'] = $row1['roomno'];
			$_SESSION['branch'] = $row1['branch'];
			$_SESSION['dob'] = $row1['dob'];
			$_SESSION['sem'] = $row1['sem'];
			$_SESSION['msg'] = $row1['notify'];
			}

		//Once logged in the page is refreshed

		header('location:index.php');
		}
	  else
		{
		/* If the cookie is found to be fake, we simply unset the cookie from the browser */

		setCookie("rme", "rme", time() - 3700, "/");
		echo "</span>
                        </td>
                        <td width=\"60%\"><span><font size=\"2px\" face=\"arial\"><b><br />Not Logged in <font color=blue>";
		}
	}
  else
	{
		/*If neither the user is logged in nor any remember me cookie is set then the following code is executed */

	echo "</span>
                        </td>
                        <td width=\"30%\"><span><font size=\"2px\" face=\"arial\"><b><br />Not Logged in <font color=blue>";
	}

?></span>
                        </td>
                        <td width="40%"></td>
                        <td><span style=""><div class="sign1" id="toggle" <?php
session_start();
// The following code toggles the toggle button depending on the user is logged in or not
if (isset($_SESSION['username']))
	{
	echo "onclick=\"logout()\"";
	}
  else
	{
	echo "onclick=\"togglefucntion()\"";
	}

?> ><div class="uncircle" id="circle"></div></div></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</div>

<br />

<!-- The following block of codes displays the menu -->

<nav class="navbar navigationstyle span6 offset3">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="newbutton navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav nav-pills nav-justified">
                <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp&nbsp<span><b><font size=2px face=arial>Home</font></b></span></a>
                </li>

                <li><a href="qp.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp&nbsp<span><b><font size=2px face=arial>Question Papers</font></b></span></a>
                </li>

                <li><a href="upload.php"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>&nbsp&nbsp<span><b><font size=2px face=arial>Upload files</font></b></span></a>
                </li>
                <li><a href="about.php"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>&nbsp&nbsp<span><b><font size=2px face=arial>About BitZoom</font></b></span></a>
                </li>
                <li><a href="contact.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp&nbsp<span><b><font size=2px face=arial>Contact Us</font></b></span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Menu ends here -->

<!-- Signup modal starts here -->

<div class="modal fade" id="sign_modal" role="dialog" style="overflow-y:scroll;clear:both">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Registration Form</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3" id="already" style="vertical-align:middle"><b>Already a user?</b>
                        </font>
                    </div>
                    <div class="col-sm-2" id="alreadyb">
                        <button onclick="location.href='index.php'" class="btn btn-primary" style="vertical-align:middle">Login</button>
                    </div>
                    <div class="col-sm-7"></div>
                </div>
                <!-- This is the part where messages related to register error is shown -->
                <font color="red"><font size="2px" face="arial"><b><div id="register_error"></div></b></font></font>
                <font size="2px" face="arial"><b><div id="response"></div></b></font>
                <br />
                <div class="form-group" id="register">

                    <font size="2px" face="arial"><b>Roll no:</b></font>
                    <br />
                    <br />
                    <select class="form-control" style="width:auto;display:inline" id="rroll1">
                        <option value="BE">BE</option>
                    </select>
                    <input type="text" value="" style="width:20%;display:inline" class="form-control" placeholder="10XXX" aria-describedby="sizing-addon1" id="rroll2">
                    <select class="form-control" style="width:auto;display:inline" id="rroll3">
                        <option value="16">2016</option>
                        <option value="15">2015</option>
                        <option value="14">2014</option>
                        <option value="13">2013</option>
                        <option value="12">2012</option>
                    </select>
                    <br />
                    <br />

                    <br />
                    <font size="2px" face="arial"><b>Date of Birth : </b></font>
                    <br />
                    <br />
                    <select name="rdate" id="rdate" class="form-control" style="width:auto;display:inline">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>&nbsp;&nbsp;
                    <select name="month" id="rmonth" class="form-control" style="width:auto;display:inline">
                        <option value="">---</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>&nbsp;&nbsp;
                    <select name="year" class="form-control" id="ryear" style="width:auto;display:inline">
                        <option value="">---</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1995">1995</option>
                        <option value="1994">1994</option>
                        <option value="1993">1993</option>
                        <option value="1992">1992</option>
                        <option value="1991">1991</option>
                        <option value="1990">1990</option>
                    </select>&nbsp;&nbsp;
                    <br />
                    <br />
                    <button type="button" onclick="regVal()" class="btn btn-primary" style="vertical-align:middle">Continue >> </button>
                </div>
                <br />


            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

<!-- Signup modal ends here -->

<!-- Login modal begins here -->

<div class="modal fade" id="log_modal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="closelog()">&times;</button>
                <div class="row">
                    <div class="col-sm-3"><font style="color:#696969;" face=arial size=2px><b>Not a user?</b></font>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#sign_modal" data-dismiss="modal">Sign up</button>
                    </div>
                    <div class="col-sm-5"></div>
                </div>
            </div>
            <div class="modal-body">
            	<!-- Messages related to login errors appear here -->
                <font color="red"><div id="login_error"></div></font>
                <div id="loginresponse"></div>
                <br />
                <form method="post" action="" class="modal_content" name="login" id="login">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1" id="log_username">
                    </div>
                    <br />
                    <br />
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-eye-open"></span></span>
                        <input type="password" class="form-control" placeholder="********" aria-describedby="sizing-addon1" id="log_password">
                    </div>
                    <br />
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">
        <input type="checkbox" aria-label="Keep logged in" name="rememberme" id="rme" value="yes" checked="true">&nbsp&nbsp Keep logged in
      </span>
                    </div>
                    <br />
                    <br />

                    <button class="btn btn-primary" type="button" onclick="checkLogForm()" style="align:center">Login</button>
                    <br />
                    <br />

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="forgot()" class="btn btn-primary" style="vertical-align:middle" data-toggle="modal" data-dismiss="modal" data-target="#forgot_modal">Forgot password</button>
                <br />
            </div>
        </div>

    </div>
</div>

<!-- Login modal ends here -->

<!-- Update modal starts. It is a modal that helps a logged in user to change his/her password. If a user is not logged in, it throws an error -->

<div class="modal fade" id="change_modal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="closelog()">&times;</button>
                <h3 style="color: #555555;font-family:arial ; " align="center">Settings</h3>
            </div>

            <div class="modal-body">
            	<!-- This is where error are displayed -->
                <font color="red"><font size="2px" face="arial"><b><div id="update_error"></div></b></font></font>
                <font size="2px" face="arial"><b><div id="update_response"></div></b></font>
                <br />
                <div id="update">
                    <?php
session_start();

if ((!$_SESSION['id']) || (!$_SESSION['name']) || (!$_SESSION['rollno']) || (!$_SESSION['roomno']) || (!$_SESSION['sex']) || (!$_SESSION['branch']) || (!$_SESSION['sem']) || (!$_SESSION['dob']))
    {
    echo "<font size=\"2px\" face=\"arial\"><b>Please <a href=\"update.php\">login</a> first to update your details<br /><br /></b></font>";
    }
  else
    {
    echo "<div class=\"row\">
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>BITzoom ID : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $_SESSION['id'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Name : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $_SESSION['name'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Gender : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $_SESSION['sex'] . "</b></font></div>
</div><div class=\"row\">
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b><font size=\"2px\" face=\"arial\"><b>Hostel/Room no: </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $_SESSION['roomno'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b><font size=\"2px\" face=\"arial\"><b>Roll no : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $_SESSION['rollno'] . "</b></font></div>
  <div class=\"col-sm-4\"><b><font size=\"2px\" face=\"arial\"><b>Branch : </b></font></b><font size=\"2px\" face=\"arial\" color=blue><b>" . $_SESSION['branch'] . "</b></font></font></div>
</div>
<br /><br /></b></b></b>
  <font size=\"2px\" face=\"arial\"><b><b>Current Password:<br /></b></b></font>
                <input type=\"password\" name=\"username\" class=\"form-control\" id=\"curr_pwd\"></input><br />
    <font size=\"2px\" face=\"arial\"><b><b>New Password:<br /></b></b></font>
                <input type=\"password\" name=\"pwd1\" class=\"form-control\" id=\"up_pwd1\"></input><br />
    <font size=\"2px\" face=\"arial\"><b><b>Re-enter new Password:<br /></b></b></font>
                <input type=\"password\" name=\"pwd2\" class=\"form-control\" id=\"up_pwd2\"></input><br />
  <button type=\"button\" onclick=\"checkUpdateForm()\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Update</button><br /><br />";
    } ?>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Update model ends -->

<!-- Forgot modal starts to let user recover their lost password -->

<div class="modal fade" id="forgot_modal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-sm-8"><font style="letter-spacing:2px;color:#696969;"><h2 style=" margin: 0px; " >Forgot Password?</h2></font>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
            <div class="modal-body">
                <font color="red"><div id="forgot_error"></div></font>
                <div id="forgotresponse"></div>
                <br />
                <div class="form-group" id="forgotform">
                    <font size="2px" face="arial"><b>Roll no:</b></font>
                    <br />
                    <br />
                    <select class="form-control" style="width:auto;display:inline" id="f_roll1">
                        <option value="BE">BE</option>
                    </select>
                    <input type="text" style="width:20%;display:inline" class="form-control" placeholder="10XXX" aria-describedby="sizing-addon1" id="f_roll2">
                    <select class="form-control" style="width:auto;display:inline" id="f_roll3">
                        <option value="16">2016</option>
                        <option value="15">2015</option>
                        <option value="14">2014</option>
                        <option value="13">2013</option>
                        <option value="12">2012</option>
                    </select>
                    <br />
                    <br />
                    <font size="2px" face="arial"><b>Username:</b></font>
                    <br />
                    <br />
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1" id="f_username">
                    </div>
                    <br />

                    <button onclick="checkForgot()" class="btn btn-primary" style="vertical-align:middle">Continue >> </button>
                    <br />
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forgot modal ends -->
