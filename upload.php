<?php
/* This is where the user can upload his/her files so that it can be shared with the whole of the college. This page needs particular attention. First because this is the only page which doesn't use AJAX and second file upload can be dangerous and it is the prive source for server attacks */
/* First we include the CAPTCHA library secureimages for human verification */
require_once 'secureimages/securimage.php';

?>
  <?php
/* The form used for uploading the file is self posting, that is the uploaded file is processed by the same script */

// So first we check if the script has received some post data or file from user. If not echo out the form if the user is logged in.

session_start();

if (isset($_POST['subject']) && isset($_POST['captcha_code']) && $_FILES["file"]["size"] > 0 && isset($_SESSION['id']))
  {

  // If the user has submitted the form, we check if CAPTCHA entered is correct, if not we throw an error.

  $image = new Securimage();
  if ($image->check($_POST['captcha_code']) == true)
    {
    }
    else
    {
    header('location:upload.php?error=2');
    exit();
    }

  // Next we make sure that subject, major and semester fields are filled out. This is also validated on javascript but still user data cannot be trusted.

  if (addslashes($_POST['subject']) == "")
    {
    header('location:upload.php?error=3');
    exit();
    }

  if (addslashes($_POST['major']) == "")
    {
    header('location:upload.php?error=4');
    exit();
    }

  if (addslashes($_POST['sem']) == "")
    {
    header('location:upload.php?error=5');
    exit();
    }

  /* Now when the form is validated, we generate a 10 digit long random number and create a directory in which we will store the uploaded file. To make sure that the file is inaccessible unless the file is checked by the admin, we upload it to Random folder */
  $output = rand(1, 9);
  for ($i = 0; $i < 10; $i++)
    {
    $output.= rand(0, 9);
    }

  $rand = $output;
  mkdir("uploads/" . $rand . "/");
  $target_dir = "uploads/" . $rand . "/";
  $uploadOk = 1;
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
  /* Now we check the file type, extension, mime type, and size. All the conditions must be satisfied before the file can be submitted to be stored */
  if (file_exists($target_file))
    {

    // Validate a file of same name doesn't already exists. Not ver likely to happen as we used a 10 digit long random number.

    $uploadOk = 0;
    }

  if ($_FILES["file"]["size"] > 40000000)
    {

    // Next we make sure the size of the uploaded file is less than 40 MB. You can set it to your own value. Accordingly you need to change the value in php.ini file as well

    $uploadOk = 0;
    }

  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "ppt" && $imageFileType != "docx" && $imageFileType != "zip" && $imageFileType != "rar" && $imageFileType != "pptx")
    {

    // We restrict the file to be of type hpg, gif, jprg, pdf, gif, doc, ppt, docx, pdf, zip, pptx. You may add more

    $uploadOk = 0;
    }

  if ($uploadOk == 0)
    {

    // If any of the above conditions was not not satisfied, we throw a error.

    header('location:upload.php?error=1');
    }
    else
    {

    // If all the conditions are satisfied we store the uploaded file in the database and update about the same in the database.

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
      {
      /* This is an important include for connecting to the database*/
      include ('config.php');

      /* The following code reads user data posted by users. I have not used any filter to user data here. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted */
      $subject = $_POST[subject];
      $major = $_POST[major];
      $sem = $_POST[sem];
      $sql1 = "INSERT INTO uploads (username,folder,subject,major,sem) VALUES ('" . $_SESSION[username] . "','" . $rand . "','" . $subject . "','" . $major . "','" . $sem . "')";
      if (mysqli_query($conn, $sql1))
        {
        }
        else
        {
        echo "Error: " . $sql . "<br />" . mysqli_error($conn);
        }

      mysqli_close($conn);

      // After record insertion we redirect the user to success page.

      header('location:upload.php?done=1');
      }
      else
      {

      // If some unknown error occurs, we throw a file upload error.

      header('location:upload.php?error=1');
      }
    }
  }

?><!DOCTYPE html>
<html>
<head><?php 
      /*Included at the header of each page. It includes the JS,CSS, JQuery, BootStrap etc files*/ 
      include "header_details.php"; 
    ?>
	<title>:: UPLOAD ::</title>
	<style type="text/css">
    /* This block of style is specific for this page only. Commons are included in header_details.php*/
		.major{
			position: relative;
		}

		.major ul{
			text-align: center;
			list-style-type: none;
			width: 33.5%;margin: 3px 32.9%;padding: 0px 0px;
			cursor: pointer;			
			color: #696969;			
			font-size: 18px;
			border-radius: 4px;
			border: 1px solid #e1eaea;

		}

		.major ul li:hover{
			background-color: #f0f5f5;

		}

		.major ul li{
			padding: 4px 0px;
			border-style: solid;
			border-color: transparent transparent #f0f5f5 transparent;
			border-width:.5px;
		}

		.major_option:hover{
			box-shadow:0px 0px 10px #696969;
		}

		.hide{
			display: none;
			transition: 1s;

		}

		.show{
			display: block;
			animation-name: showhide;
			animation-duration: 1s;
		}

		@-webkit-keyframes showhide {
	    from {opacity:0;} 
	    to {opacity:1 ;}
		}

		@keyframes showhide {
			from {opacity:0;} 
		    to {opacity:1;}
		}

		@-webkit-keyframes hideshow {
		    from {opacity:1;} 
		    to {opacity:0 ;}
		}

		@keyframes hideshow {
			from {opacity:1;} 
		    to {opacity:0;}
		}

	</style>
</head>
<body <?php /*This block of code is used to toggle the toggle button on page load if the user is logged in. And if the user is not logged in it displays the login modal.*/ 
  session_start(); 
  if (!$_SESSION[ 'username']) { echo "><script type=\"text/javascript\">
  $(document).ready(function () {

      $('#log_modal').modal('show');

  });

</script>"; } else { echo "onload=\"loggedin()\">"; } ?>
<?php 
      /* header.php contains the menus, logo etc that forms the header part of the site*/ 
      include "header.php"; 
    ?>
    <div style="margin-left:2%;">
<?php
session_start();

if (isset($_SESSION['username']) && (!isset($_GET['done'])))
  {
  echo "
<div class=\"row\">
  <div class=\"col-sm-4\"></div>
  <div class=\"col-sm-4\"><div style=\"text-align: center ;width:100%; font-family: arial;font-size: 24px; \" >Upload your files</div></div>
  <div class=\"col-sm-4\"></div>
</div>
<br />
";
  if (isset($_GET['error']) && $_GET['error'] == 1)
    {
    echo "<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><div style=\"text-align: center \" ><font color=\"red\" size=2px face=arial><b>The last file was not of correct type or correct size. Please verify the same</b></font></div></div>
  <div class=\"col-sm-3\"></div>
</div>
";
    }
    else
  if (isset($_GET['error']) && $_GET['error'] == 2)
    {
    echo "<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><div style=\"text-align: center \" ><font color=\"red\" size=2px face=arial><b>Please Enter the correct Captcha</b></font></div></div>
  <div class=\"col-sm-3\"></div>
</div>
";
    }
    else
  if (isset($_GET['error']) && $_GET['error'] == 3)
    {
    echo "<div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><div style=\"text-align: center \" ><font color=\"red\" size=2px face=arial><b>Please mention the subject to which this file belongs to</b></font></div></div>
  <div class=\"col-sm-3\"></div>
</div>
";
    }
    else
  if (isset($_GET['error']) && $_GET['error'] == 4)
    {
    echo "<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><div style=\"text-align: center \" ><font color=\"red\" size=2px face=arial><b>Please Select the subject</b></font></div></div>
  <div class=\"col-sm-3\"></div>
</div>
";
    }
    else
  if (isset($_GET['error']) && $_GET['error'] == 5)
    {
    echo "<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><div style=\"text-align: center \" ><font color=\"red\" size=2px face=arial><b>Please select the semester</b></font></div></div>
  <div class=\"col-sm-3\"></div>
</div>
";
    }
    else
    {
    }

  echo "<form role=\"form\" id=\"uploadupload\" name=\"form\" method=\"post\" action=\"\" enctype=\"multipart/form-data\">
  <div class=\"row\">
  <div class=\"col-sm-3\"></div>
    <div class=\"form-group col-sm-6\">
    <div><b>Select your File :</b> </div>
     <input type=\"file\" name=\"file\" id=\"file\" class=\"form-control\"><br /><br />
    <div><b>Select your Major :</b> </div>
      <select class=\"form-control\" name=\"major\" id=\"major\" style=\"background-color:white;height:40px;border-radius:5px; font-size:20px; color:grey; font-family:times;font-weight:bold\"><option value=\"\">---</option><option value=\"CHEM\">Chemical Engineering</option>
  <option value=\"CIVIL\">Civil Engineering</option>
  <option value=\"CSE\">Computer Science Engineering</option>
  <option value=\"EEE\">Electrical and Electronics Engineering</option>
  <option value=\"IT\">Information Technology</option>
  <option value=\"ECE\">Electronics and Communication Engineering</option>
  <option value=\"MECH\">Mechanical Engineering</option>
  <option value=\"PROD\">Production Engineering
  </option></select>      <br />
  <br /><br />
  <div><b>Select your Semester :</b> </div>
  <select class=\"form-control\" name=\"sem\" id=\"sem\" style=\"background-color:white;height:40px;border-radius:5px; font-size:20px; color:grey; font-family:times;display:inline;font-weight:bold\" onchange=\"semfunc()\"><option value=\"\">---</option><option value=\"1\">Semester 1</option>
  <option value=\"2\">Semester 2</option>
  <option value=\"3\">Semester 3</option>
  <option value=\"4\">Semester 4</option>
  <option value=\"5\">Semester 5</option>
  <option value=\"6\">Semester 6</option>
  <option value=\"7\">Semester 7</option>
  <option value=\"8\">Semester 8</option></select>
      
    </div>
    <div class=\"col-sm-3\"></div>
    </div>
    <br /><br />

<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><font size=2px face=arial><b>Comments (Please mention the subject):&nbsp&nbsp </b></font><b><input type=\"text\" id=\"subject\" name=\"subject\"></div>
  <div class=\"col-sm-3\"></div>
</div>

<b><br /><br /> <div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\">";
  echo Securimage::getCaptchaHtml();
  echo "</div>
  <div class=\"col-sm-3\"></div>
</div><br /><br />
<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><center><button type=\"button\" class=\"btn btn-primary\" style=\"vertical-align:middle\" onclick=\"validateupload()\">Upload</button></center></div>
  <div class=\"col-sm-3\"></div>
</div>

<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><br /><br /><font size=2px face=arial><b>General Instructions : <br />1. Max upload size is 40 MB.<br />2. Uploaded files would be verified before posting.<br />3. If you have many files to upload, please Zip and upload. Mention about the same in the comments. <br />4. Allowable file formats : JPG, PNG, PDF, ZIP, RAR, DOC, PPT</b></font><br /><br /></div>
  <div class=\"col-sm-3\"></div>
</div>
</div>
";
  }
  else
if (isset($_SESSION['username']) && (isset($_GET['done'])))
  {
  echo "
<div class=\"row\">
  <div class=\"col-sm-4\"></div>
  <div class=\"col-sm-4\"><div style=\"text-align: center ;width:100%; font-family: arial;font-size: 24px; \" >Upload your files</div></div>
  <div class=\"col-sm-4\"></div>
</div><br /><br />";
  echo "<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><div style=\"text-align: center \" ><font color=\"green\" size=2px face=arial><b>Your file was successfully uploaded. <a href=upload.php>Click here</a> to upload another.</b></font></div></div>
  <div class=\"col-sm-3\"></div>
</div>
";
  }
  else
  {
  echo "
<div class=\"row\">
  <div class=\"col-sm-4\"></div>
  <div class=\"col-sm-4\"><div style=\"text-align: center ;width:100%; font-family: arial;font-size: 24px; \" >Upload your files</div></div>
  <div class=\"col-sm-4\"></div>
</div>
<br />
<br />
";
  echo "<div class=\"row\">
  <div class=\"col-sm-3\"></div>
  <div class=\"col-sm-6\"><div style=\"text-align: center \" ><font size=2px color=red face=arial><b>You must be logged in to upload a file</b></font></div></div>
  <div class=\"col-sm-3\"></div>
</div>
";
  }

?></div>
    <?php 
          /*This file is included at the footer of each page where we can provide credit information include*/ 
          include "footer.php"; 
    ?>
</body>
</html>
