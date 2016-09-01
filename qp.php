<!-- This file is similar to index.php. It only makes requests for Question papers -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    	/*Included at the header of each page. It includes the JS,CSS, JQuery, BootStrap etc files*/ 
    	include "header_details.php"; 
    ?>
    <title>:: QUESTION PAPERS ::</title>
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
    <div class="container">
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div style="text-align: center ;width:100%; font-family: arial;font-size: 24px; ">Download Question Papers</div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?php 
                /* This block of code is used to show ads, messages, notifications etc. If you want you can add certain conditions. For example check the IP to validate the hostel and show messages relevant to residers of that hostel. */ 

                echo "<div style=\"padding:20px;margin-bottom:20px; margin-bottom:10px; background-color:purple;border-radius:10px;color:white\" id=\"ad\"><font size=2px face=arial><div style=\"cursor:pointer\"></div> <table border=0><tr><td>"; echo "Add your message to display here"; echo "</td></tr></table></div>"; 
                ?></div>
            <div class="col-sm-1"></div>
        </div>
        <br>
    </div>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div style="text-align: center; font-size: 20px; font-family:Times New Roman;font-weight: bold; color:purple;" id="instruction">Step 1: Select Your Major</div>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <!-- Here is the select menu on the home page-->
        <br>
        <form role="form">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="form-group col-sm-6">
                    <select class="form-control" name="major" id="major" style="background-color:white;height:40px;border-radius:5px; font-size:20px; color:grey; font-family:times;font-weight:bold" onchange="majorfunc()">
                        <option value="">---</option>
                        <option value="CHEM">Chemical Engineering</option>
                        <option value="CIVIL">Civil Engineering</option>
                        <option value="CSE">Computer Science Engineering</option>
                        <option value="EEE">Electrical and Electronics Engineering</option>
                        <option value="IT">Information Technology</option>
                        <option value="ECE">Electronics and Communication Engineering</option>
                        <option value="MECH">Mechanical Engineering</option>
                        <option value="PROD">Production Engineering
                        </option>
                    </select>
                    <br>
                    <br>
                    <select class="form-control" name="sem" id="sem" style="background-color:white;height:40px;border-radius:5px; font-size:20px; color:grey; font-family:times;display:none;font-weight:bold" onchange="semfuncqp()">
                        <option value="">---</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>

                    <br>
                    <div id="courseresponse" style="text-align:center"></div>
                    <div id="downloadresponse" style="text-align:center">
                        <br>
                        <br>
                    </div>
                    <div id="filesresponse" style="text-align:center">
                        <br>
                    </div>
                    <!-- Select menu ends here -->
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
        <?php 
        	/*This file is included at the footer of each page where we can provide credit information include*/ 
        	include "footer.php"; 
        ?>
</body>

</html>