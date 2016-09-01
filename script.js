function togglefucntion() {
  // The following function is used to toggle the toggle function upon call. Note the name its fucntion and not function
    document.getElementById("toggle").classList.toggle("toggleclicked");
    document.getElementById("circle").classList.toggle("clicked");
    $('#log_modal').modal('show');
}

function change() {
  // The following function shows up the Update modal when 'Settings' button is clicked
    $('#change_modal').modal('show');
    $('#sign_modal').modal('hide');
}

function nomsg() {
  // The following function hides the message modal
    document.getElementById("msg_modal").style.display = "none";
}

function loadregister() {
  //The following function is used to show the register modal upon page load
    document.getElementById("toggle").classList.toggle("toggleclicked");
    document.getElementById("circle").classList.toggle("clicked");
    $('#sign_modal').modal('show');
}

function loggedin() {
  //The following function is used to toggle the toggle button automatically on poage load if the user is logged in
    document.getElementById("toggle").classList.toggle("toggleclicked");
    document.getElementById("circle").classList.toggle("clicked");
}

function closelog() {
  //This function is used to hide the login modal when close button is pressed
    $('#log_modal').modal('hide');
    document.getElementById("toggle").classList.toggle("toggleclicked");
    document.getElementById("circle").classList.toggle("clicked");
}

function closereg() {
  //This function is used to hide the register modal when close button is pressed
    $('#sign_modal').modal('hide');
    document.getElementById("toggle").classList.toggle("toggleclicked");
    document.getElementById("circle").classList.toggle("clicked");
}

function closemsg() {
  //This function is used to hide the message modal when close button is pressed
    $('#msg_modal').modal('hide');
}

function closechange() {
  //This function is used to hide the update modal when close button is pressed
    $('#change_modal').modal('hide');
}

function closeforgot() {
  //This function is used to hide the forgot modal when close button is pressed
    $('#forgot_modal').modal('hide');
    document.getElementById("toggle1").classList.toggle("toggleclicked");
    document.getElementById("circle").classList.toggle("clicked");
}

function registercall() {
  //This function is show the register modal when the page loads
    $('#log_modal').modal('hide');
    $('#sign_modal').modal('show');
}

function regVal() {
  //This function validates the registeration form and creates a AJAX request to register.php
    var roll1 = document.getElementById('rroll1').value;
    var roll2 = document.getElementById('rroll2').value;
    var roll3 = document.getElementById('rroll3').value;
    var date = document.getElementById('rdate').value;
    var month = document.getElementById('rmonth').value;
    var year = document.getElementById('ryear').value;
    var rollno = roll1 + "/" + roll2 + "/" + roll3;
    var dob1 = date + "/" + month + "/" + year;
    var dob2 = month + "/" + date + "/" + year;
    document.getElementById("response").innerHTML = "<img src=3.gif> Processing. Please Wait...";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("response").innerHTML = "<font color=red>No such records found in BIT's database. Please try again else </font><a href=contact.php>Contact us</a>";

            } else {
                document.getElementById("response").innerHTML = "";
                document.getElementById("already").innerHTML = "";
                document.getElementById("alreadyb").innerHTML = "";
                document.getElementById("register").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "register.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("rollno=" + rollno + "&dob1=" + dob1 + "&dob2=" + dob2);
}

function checkRegForm() {
  //This function validates the registeration form and creates a AJAX request to regfinal.php
    var username = document.getElementById("reg_username").value;
    var pwd1 = document.getElementById("reg_pwd1").value;
    var pwd2 = document.getElementById("reg_pwd2").value;
    var secques = document.getElementById("secques").value;
    var secans = document.getElementById("secans").value;
    document.getElementById("response").innerHTML = "<img src=3.gif> Processing. Please Wait...";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("response").innerHTML = "You have been successfully registered. Please <a href=index.php>Login</a> now";
                document.getElementById("register_error").innerHTML = "";
                document.getElementById("register").innerHTML = "";

            } else {
                document.getElementById("response").innerHTML = "";
                document.getElementById("register_error").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "regfinal.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("username=" + username + "&pwd1=" + pwd1 + "&pwd2=" + pwd2 + "&secques=" + secques + "&secans=" + secans);
}

function checkForgot() {
  //This function validates the Forgot your passsword form and creates a AJAX request to forgot.php
    var roll1 = document.getElementById("f_roll1").value;
    var roll2 = document.getElementById("f_roll2").value;
    var roll3 = document.getElementById("f_roll3").value;
    var username = document.getElementById("f_username").value;
    var rollno = roll1 + "/" + roll2 + "/" + roll3;
    document.getElementById("forgot_error").innerHTML = "<font size=\"2px\" face=\"arial\" color=black><b><img src=3.gif> Processing. Please Wait...</b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("forgot_error").innerHTML = "<font size=\"2px\" face=\"arial\" color=red><b>No such records found in database. Please try again else <a href=contact.php>Contact us</a></b></font>";
            } else {
                document.getElementById("forgotresponse").innerHTML = xmlhttp.responseText;
                document.getElementById("forgot_error").innerHTML = "";
                document.getElementById("forgotform").innerHTML = "";
            }
        }
    };
    xmlhttp.open("POST", "forgot.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("rollno=" + rollno + "&username=" + username);
}

function checkForgot1() {
  //This function validates the second step Forgot your passsword form and creates a AJAX request to forgot1.php
    var secans = document.getElementById("f_secans").value;
    var xmlhttp = new XMLHttpRequest();
    document.getElementById("forgot_error").innerHTML = "<font size=\"2px\" face=\"arial\" color=black><b><img src=3.gif> Processing. Please Wait...</b></font>";
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("forgot_error").innerHTML = "<font size=\"2px\" face=\"arial\" color=red><b>Wrong answer to security question. Please try again else </b></font><a href=contact.php>Contact us</a><br>";
            } else {
                document.getElementById("forgotresponse").innerHTML = xmlhttp.responseText;
                document.getElementById("forgot_error").innerHTML = "";
                document.getElementById("forgotform").innerHTML = "";
            }
        }
    };
    xmlhttp.open("POST", "forgot1.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("secans=" + secans);
}

function checkForgot3() {
  //This function validates the final step Forgot your passsword form and creates a AJAX request to forgot2.php
    var pwd1 = document.getElementById("f_pwd1").value;
    var pwd2 = document.getElementById("f_pwd2").value;
    document.getElementById("forgot_error").innerHTML = "<font size=\"2px\" face=\"arial\" color=black><b><img src=3.gif> Processing. Please Wait...</b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("forgotresponse").innerHTML = "<font size=\"2px\" face=\"arial\" color=green><b>Your password has been updated. Please now onwards </b></font><a href=index.php>login</a><font size=\"2px\" face=\"arial\" color=green><b> with your new password</b></font><br>";
                document.getElementById("forgot_error").innerHTML = "";
                document.getElementById("update").innerHTML = "";
                setTimeout(location.reload(), 3000);
            } else {
                document.getElementById("forgot_error").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "forgot2.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("pwd1=" + pwd1 + "&pwd2=" + pwd2);
}

function checkUpdateForm() {
  //This function validates the Update form and creates a AJAX request to update.php
    var currpwd = document.getElementById("curr_pwd").value;
    var pwd1 = document.getElementById("up_pwd1").value;
    var pwd2 = document.getElementById("up_pwd2").value;
    document.getElementById("update_error").innerHTML = "<font size=\"2px\" face=\"arial\" color=black><b><img src=3.gif> Processing. Please Wait...</b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("update_response").innerHTML = "Your password has been updated. Please now onwards login with your new password<br>";
                document.getElementById("update_error").innerHTML = "";
                document.getElementById("update").innerHTML = "";
                setTimeout(location.reload(), 3000);
            } else {
                document.getElementById("update_response").innerHTML = "";
                document.getElementById("update_error").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "update.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("currpwd=" + currpwd + "&pwd1=" + pwd1 + "&pwd2=" + pwd2);
}

function validateupload() {
  //This function validates the upload form
    var major = document.getElementById("major").value;
    var sem = document.getElementById("sem").value;
    var subject = document.getElementById("subject").value;
    if (major == "") {
        alert("Please select the major to which the file belongs to");
    } else if (sem == "") {
        alert("Please select the semester to which the file belongs to");
    } else if (subject == "") {
        alert("Please mention the subject to which the file belongs to");
    } else {
        document.getElementById("uploadupload").submit();
    }
}

function checkLogForm() {
  //This function validates the login form and creates a AJAX request to login.php
    var username = document.getElementById("log_username").value;
    var password = document.getElementById("log_password").value;
    var rme;
    if (document.getElementById("rme").checked) {
        rme = "yes";
    } else {
        rme = "no";
    }
    document.getElementById("login_error").innerHTML = "<font size=\"2px\" face=\"arial\" color=black><b><img src=3.gif> Processing. Please Wait...</b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                location.reload();
            } else {
                document.getElementById("login_error").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("username=" + username + "&password=" + password + "&rme=" + rme);
}

function checkContactForm() {
  //This function validates the contact form and creates a AJAX request to contactfinal.php
    var name = document.getElementById("cname").value;
    var email = document.getElementById("cemail").value;
    var phno = document.getElementById("cphno").value;
    var message = document.getElementById("cmessage").value;
    var captcha_code = document.getElementById("captcha_code").value;
    document.getElementById("contact_error").innerHTML = "<font size=\"2px\" face=\"arial\" color=black><b><img src=3.gif> Processing. Please Wait...</b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("cform").innerHTML = "<br><br><font color=green size=2px face=arial><b>Your message was received. <a href=index.php>Click Here</a> to go back.</b></font>";
                document.getElementById("form").innerHTML = "";
            } else {
                document.getElementById("contact_error").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "contactfinal.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("name=" + name + "&email=" + email + "&phno=" + phno + "&message=" + message + "&captcha_code=" + captcha_code);
}

function logout() {
  //This function navigates user to logout.php when user presses the toggle button
    window.location.href = "logout.php";
}

function majorfunc() {
  //This function shows the semester field once the user selects the major field
    document.getElementById("sem").style.display = "inline";
    document.getElementById("instruction").innerHTML = "Step 2: Select your Semester";
    document.getElementById("downloadresponse").innerHTML = "";
    document.getElementById("courseresponse").innerHTML = "";
    document.getElementById("filesresponse").innerHTML = "";
}

function semfunc() {
  //This function shows the all the course related to the chosen major and semester on the basis of record present in the database. Check the database structure and findcourse.php for more details
    var major = document.getElementById("major").value;
    var sem = document.getElementById("sem").value;
    document.getElementById("downloadresponse").innerHTML = "";
    document.getElementById("courseresponse").innerHTML = "<br><br><font size=2px color=black face=arial><b><img src=3.gif> Processing. Please Wait...</b></font>";
    document.getElementById("filesresponse").innerHTML = "";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("courseresponse").innerHTML = "<br><br><b><font color=red face=arial size=2px>Nothing found related to query. Please checkback again later</b></font>";
            } else {
                document.getElementById("instruction").innerHTML = "Step 3: Select your course";
                document.getElementById("courseresponse").innerHTML = xmlhttp.responseText;

            }
        }
    };
    xmlhttp.open("POST", "findcourse.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("major=" + major + "&sem=" + sem);
}

function semfuncqp() {
   //This function shows the all the course related to the chosen major and semester on the basis of record present in the database. Check the database structure and findcourseqp.php for more details
    var major = document.getElementById("major").value;
    var sem = document.getElementById("sem").value;
    document.getElementById("downloadresponse").innerHTML = "";
    document.getElementById("courseresponse").innerHTML = "<br><br><font size=2px color=black face=arial><b><img src=3.gif> Processing. Please Wait...</b></font>";
    document.getElementById("filesresponse").innerHTML = "";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("courseresponse").innerHTML = "<br><br><b><font color=red face=arial size=2px>Nothing found related to query. Please checkback again later</b></font>";
            } else {
                document.getElementById("instruction").innerHTML = "Step 3: Select your course";
                document.getElementById("courseresponse").innerHTML = xmlhttp.responseText;

            }
        }
    };
    xmlhttp.open("POST", "findcourseqp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("major=" + major + "&sem=" + sem);
}

function coursefunc() {
  //This function creates a request to list.php to display all the available files related to the course.
    var course = document.getElementById("course").value;
    document.getElementById("downloadresponse").innerHTML = "";
    document.getElementById("filesresponse").innerHTML = "<font size=2px color=black face=arial><b><br><br><img src=3.gif> Processing. Please Wait...</b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("filesresponse").innerHTML = "<br><br><font color=red>Nothing found related to query. Please checkback again later</font>";
            } else {
                document.getElementById("instruction").innerHTML = "Step 4: Download the files :)";
                document.getElementById("filesresponse").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "list.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("course=" + course);
}

function coursefuncqp() {
  //This function creates a request to listqp.php to display all the available question papers related to the course.
    var course = document.getElementById("course").value;
    document.getElementById("downloadresponse").innerHTML = "";
    document.getElementById("filesresponse").innerHTML = "<font size=2px color=black face=arial><b><br><br><img src=3.gif> Processing. Please Wait...</b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("filesresponse").innerHTML = "<br><br><font color=red>Nothing found related to query. Please checkback again later</font>";
            } else {
                document.getElementById("instruction").innerHTML = "Step 4: Download the files :)";
                document.getElementById("filesresponse").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "listqp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("course=" + course);
}

function downloadf(file) {
  //This function creates a request to server to check if the user is logged in or not before downloading the file
    var fltodl = file;
    var course = document.getElementById("course").value;
    document.getElementById("downloadresponse").innerHTML = "<font size=2px color=black face=arial><b><div style=\"margin-left:0%\"> &nbsp;&nbsp;&nbsp;&nbsp; <img src=3.gif> Processing. Please Wait...</div></b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("downloadresponse").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST", "validatedownload.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("fltodl=" + fltodl + "&course=" + course);
}

function downloadqp(file) {
  //This function creates a request to server to check if the user is logged in or not before downloading the file
    var fltodl = file;
    var course = document.getElementById("course").value;
    document.getElementById("downloadresponse").innerHTML = "<font size=2px color=black face=arial><b><div style=\"margin-left:0%\"> &nbsp;&nbsp;&nbsp;&nbsp; <img src=3.gif> Processing. Please Wait...</div></b></font>";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("downloadresponse").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST", "validatedownloadqp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("fltodl=" + fltodl + "&course=" + course);
} 