<!-- If you don't have the hostel records of student and you need users to register from the scratch, then you may redirect them to this form, where there records can be first added to user_details table and then the user can register to get his/her record inserted in registered_users table. Remember this file only add a new user detail and doesn't register him/her. After his/her record is added to user_details table then we can redirect him to the register modal of home page where he/she can complete his/her registration -->

<!DOCTYPE html>
<html>
    <head>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <script>
            function validate() {
                //This function validates the registration form and creates a AJAX request to register.php
            
                var rollno = document.getElementById("rollno").value;
                var name = document.getElementById("name").value;
                var dob = document.getElementById("dob").value;
                var branch = document.getElementById("branch").value;
                var roomno = document.getElementById("roomno").value;
                var sex = document.getElementById("sex").value;
                document.getElementById("response").innerHTML = "Processing. Please Wait...";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        if (xmlhttp.responseText == "0") {
                          //If the user_detail insertion is completed successfully, we can now redirect the user to home page and prompt the register modal for the user to continue the registration.
                            location.href = "../index.php?register=1&new=1&rollno=" + rollno;
            
                        } else {
                            document.getElementById("response").innerHTML = xmlhttp.responseText;
                        }
                    }
                };
                xmlhttp.open("POST", "register.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("name=" + name + "&rollno=" + rollno + "&dob=" + dob + "&branch=" + branch + "&roomno=" + roomno + "&sex=" + sex);
            }
        </script>
    </head>
    <body>
        <div class="maindiv">
        <div class="form_div">
            <form action="" method="post" class="">
                <h2>New Registration</h2>
                <!--This is where the errors are displayed -->
                <span class="error"></span>
                <b>Roll no:</b> <input class="form-control" id="rollno" type="text" style="display:inline;width:20%;"><br>
                <span class="error">Please enter in the format BE/10XXX/YY</span><br><br>
                <b>Name: </b>
                <input class="form-control" id="name" type="text" value="" style="display:inline;width:80%;"><br>
                <span class="error"></span><br>
                <b>Gender: </b>
                <select class="form-control" style="display:inline;width:80%;" id="sex">
                    <option value="">---</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
                <br><br>
                <span class="error"></span>
                <b>Date of Birth: </b>
                <input class="form-control" id="dob" type="text" style="display:inline;width:75%;"><br>
                <span class="error">Please enter in the format DD/MM/YYYY</span><br><br>
                <b>Branch: </b>
                <select class="form-control" style="display:inline;width:80%;" id="branch">
                    <option value="">---</option>
                    <option value="CSE">Computer Science and Engg</option>
                    <option value="ECE">Electronics and Comm Engg</option>
                    <option value="EEE">Electrical and Electronics Engg</option>
                    <option value="MECH">Mechanical Engg</option>
                    <option value="PROD">Production Engg</option>
                    <option value="CHEM">Chemical Engg</option>
                    <option value="IT">Information Technology</option>
                    <option value="CIVIL">Civil Engg</option>
                    <option value="BIOTECH">Biotech Engg</option>
                </select>
                <br><br>
                <span class="error"></span>
                <br>
                <b>Roomno: </b>
                <input class="form-control" style="display:inline;width:75%;" id="roomno" type="text"><br>
                <span class="error"></span><br>
                Before submitting please make sure the information given above is in correct format.<br><br>
                <font color=red>
                    <b>
                        <div id="response"></div>
                    </b>
                </font>
                <br>
                <input class="btn btn-primary" name="submit" type="button" value="Submit" onclick="validate()">
            </form>
        </div>
    </body>
</html>
