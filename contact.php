<?php 
/*This line of code includes the library securimages. This generates images required for Human verification. It forms a important part of the contact form to make sure you don 't receive automated requests */
  require_once 'secureimages/securimage.php ';
?>
<!DOCTYPE html>
<html>
<head>
  <style type="text/css"> 
  /* This block of style is specific for this page only. Commons are included in header_details.php*/
  .feedback form  table tr td input{
    margin-left: 20px
    }
  </style>
<title>::Contact us::</title>
</head>

<?php 
/*Included at the header of each page. It includes the JS,CSS, JQuery, BootStrap etc files*/
include "header_details.php"; 
?>

<!-- This block of code is used to toggle the toggle button on page load if the user is logged in. Since this page doesn't require user to be logged in, so the login modal is not displayed -->

<body <?php session_start(); if($_SESSION[ 'username']){ echo "onload=\"loggedin()\""; } ?>>
    <?php /* header.php contains the menus, logo etc that forms the header part of the site*/ include "header.php"; ?>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div style="text-align: center ;width:100%; font-family: arial;font-size: 24px; ">Contact us </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <br>
    <!-- Here goes our contact us form -->
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" id="cform" style="text-align:center"></div>
        <div class="col-sm-4"></div>
    </div>
    <div id="form">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="input-group input-group-lg" style="margin: 5px 5px 5px 5px;">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span></span>
                    <!-- If the user is already logged in then we can directly use the name from the session variable -->
                    <input type="text" class="form-control" name="name" placeholder="Name" aria-describedby="sizing-addon1" id="cname" value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?>">
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>


        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="input-group input-group-lg" style="margin: 5px 5px 5px 5px; ">
                    <span class="input-group-addon" id="sizing-addon1">@</span>
                    <input type="text" class="form-control" placeholder="you@somemail.com" name="email" aria-describedby="sizing-addon1" id="cemail">
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="input-group input-group-lg" style="margin: 5px 5px 5px 5px; ">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-phone"></span></span>
                    <input type="text" class="form-control" placeholder="898XXXXXXX" name="branch" aria-describedby="sizing-addon1" id="cphno">
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="input-group input-group-lg" style="margin: 5px 5px 5px 5px;height: 100px; ">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-list-alt"></span></span>
                    <textarea type="text" class="form-control" style="height: 100px; " placeholder="Feedback/Comment" name="comment" aria-describedby="sizing-addon1" id="cmessage"></textarea>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div style="margin: 0px 0px 5px 0px; ">
                    <?php /* This is where the object for Catptcha appears */ echo Securimage::getCaptchaHtml(); ?>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="feedback">
                    <font color="red" size="2px" face="arial"><b><div id="contact_error" style="text-align:center"></div><!-- This is the DIV block in which any error received in the form is displayed --></b></font>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <!-- The form is submitted using AJAX to a PHP file called contactfinal.php. For the AJAX code, see script.js -->
            <div class="col-sm-4">
                <center>
                    <button type="button" class="btn btn-primary" style="vertical-align:middle" onclick="checkContactForm()">Send Message</button>
                </center>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    </div><?php 
          /*This file is included at the footer of each page where we can provide credit information include*/ 
          include "footer.php"; 
        ?>
</body>
</html>