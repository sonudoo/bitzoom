<!DOCTYPE html>
<html>

<head>
    <?php /*Included at the header of each page. It includes the JS,CSS, JQuery, BootStrap etc files*/ include "header_details.php"; ?>
    <title>:: ABOUT ::</title>
    <style type="text/css">
        /* This block of style is specific for this page only. Commons are included in header_details.php*/
        
        .major {
            position: relative;
        }
        .major ul {
            text-align: center;
            list-style-type: none;
            width: 33.5%;
            margin: 3px 32.9%;
            padding: 0px 0px;
            cursor: pointer;
            color: #696969;
            font-size: 18px;
            border-radius: 4px;
            border: 1px solid #e1eaea;
        }
        .major ul li:hover {
            background-color: #f0f5f5;
        }
        .major ul li {
            padding: 4px 0px;
            border-style: solid;
            border-color: transparent transparent #f0f5f5 transparent;
            border-width: .5px;
        }
        .major_option:hover {
            box-shadow: 0px 0px 10px #696969;
        }
        .hide {
            display: none;
            transition: 1s;
        }
        .show {
            display: block;
            animation-name: showhide;
            animation-duration: 1s;
        }
        @-webkit-keyframes showhide {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes showhide {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @-webkit-keyframes hideshow {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
        @keyframes hideshow {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<!-- This block of code is used to toggle the toggle button on page load if the user is logged in. Since this page doesn't require user to be logged in, so the login modal is not displayed -->

<body <?php session_start(); if($_SESSION[ 'username']){ echo "onload=\"loggedin()\""; } ?>>

    <?php /* header.php contains the menus, logo etc that forms the header part of the site*/ include "header.php"; ?>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div><font size="2px" face="arial">

<div style="text-align: center ;width:100%; font-family: arial;font-size: 24px; " >About us</div>
<br><br>
<!-- This is where information about the site goes -->
<div style="margin-left:2%;">BitZoom is created by 2k15 CSE students. It is created primarily for content sharing but in future we may include other stuffs to.<br> So Please stay tuned. <br><br><b>Backend -</b> Sushant Kumar Gupta<br><b>Frontend - </b>Abhishek Kujur, Sushant Kumar Gupta<br><b><ul><li> Why I need to sign up?</li></b><br>Very simply we need to track which files are downloaded the most and so we can increase its availability and improve our services. Signing up is a very short process and takes hardly half a minute.<br><br><b><br><li>Where did you get my information from? </li></b><br>It is publicly available on BIT's website. Pinky swear we don't share any of your<br> personal information. Your passwords are hashed in the database. <br><br><br><b><li>What data are you tracking?</li></b><br>We are only tracking your IP from which the file was uploaded or downloaded.<br> We also track your cookies when you login or signup.<br><br><br><br><br><br></ul></div></font>
                </b>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <?php 
        	/*This file is included at the footer of each page where we can provide credit information include*/ 
        	include "footer.php"; 
        ?>
</body>

</html>