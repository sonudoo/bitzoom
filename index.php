<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    	/*Included at the header of each page. It includes the JS,CSS, JQuery, BootStrap etc files*/ 
    	include "header_details.php"; 
    ?>

    <?php
    /*php code to extract all the files from the course folder recursevily*/
        $curr_dir = getcwd();
        $dir    = "$curr_dir/BitZoom/";
        $all_dir = scandir($dir);
         $a=array();
        foreach ($all_dir as $key => $value) {
            if($key<2||!is_dir($dir.$value))
                continue;
            array_push($a,$value);
        }

        $files = array();
        foreach ($a as $key => $value) {
            $file1 = scandir($dir.$value);
            foreach ($file1 as $key1 => $value1) {
                if($key1<2)
                    continue;
                $files[$value1] = $value;
            }
            $js_array = json_encode($files);
        }
        
    ?>

    <script type="text/javascript">
    /*A script to make the search engine */
        var cnt=0;

        function searchCourses(files){
           var table = document.getElementById("resultTable");
           var rows = table.getElementsByTagName("tr")
           
            if(cnt>0){
                var n = rows.length;
                for(var i=1;i<n;i++){
                    table.deleteRow(1);        
                }
            }
            cnt++;
            var file_list = Object.keys(files);
            document.getElementById('non_search_part').style.display = "none";
            document.getElementById('result').style.display = "block";
          
            if(document.getElementById('filter').value.length < 1){
                document.getElementById('non_search_part').style.display = "block";
                document.getElementById('result').style.display = "none";
            }

            var search = document.getElementById('filter').value.toUpperCase();
            
            for(var i=0;i<file_list.length;i++){
                if(file_list[i].toUpperCase().indexOf(search) > -1){
                   //configuring the table rows and cells
                   var row = table.insertRow(1);
                   var cell1 = row.insertCell(0);
                   var cell2 = row.insertCell(1);
                   var cell3 = row.insertCell(2);
                   cell3.className = "btn btn-primary"
                   cell1.innerHTML = "<bold>" + file_list[i] + "</bold>";
                   cell2.innerHTML = files[file_list[i]];
                   cell2.value = files[file_list[i]];
                   cell2.id = "course";
                   cell3.innerHTML = "Download"
                   cell1.style.textAlign = "center"
                   cell2.style.textAlign = "center"
                   cell3.style.float = "middle"
                   var cuurrent_file = file_list[i];
                   cell3.onclick = function(){
                        downloadf(cuurrent_file);
                        document.getElementById('non_search_part').style.display = "block";
                        document.getElementById('result').style.display = "none";
                   }
                   
                }
            }
        }
    </script>


    <title>:: HOME ::</title>
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

<body <?php /*This block of code is used to toggle the toggle button on page load if the user is logged in. And if the user is not logged in it displays the login modal. Another thing is if the user is newly registered, it shows the Register box for the user to complete the registration. Please check newreg folder scripts to know more about it*/ 
	session_start(); 
	if (isset($_GET[ 'register']) && $_GET[ 'register']=="1" ) { 
	echo "><script type=\"text/javascript\">
	$(document).ready(function () {

	    $('#sign_modal').modal('show');

	});

</script>"; } else if (!$_SESSION[ 'username']) { echo "><script type=\"text/javascript\">
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
                <div style="text-align: center ;width:100%; font-family: arial;font-size: 24px; ">Download Study Materials</div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-sm-1"></div>
           <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search for  materials" id="filter" onkeyup='searchCourses(<?php echo $js_array ?>)' style="width: 1000px;">
            </div>
            <div class="col-sm-1"></div>
        </div>
        <br>
    </div>

    <div class="container" id="result" style="display: none">
        <table class="table table-hover" style="word-wrap:break-word;" id="resultTable">
            <tbody>
                <tr style="background-color:black;color:white;text-align:center">
                    <th style="text-align:center">File name</th>
                    <th style="text-align:center">Course ID</th>
                    <th style="text-align:center">Download</th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container" id="non_search_part">
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
                    <select class="form-control" name="sem" id="sem" style="background-color:white;height:40px;border-radius:5px; font-size:20px; color:grey; font-family:times;display:none;font-weight:bold" onchange="semfunc()">
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