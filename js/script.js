var countDownDate = new Date("Sep 19, 2018 00:00:00").getTime();

var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  document.getElementById("timer").innerHTML = days + " Days " + hours + " Hours "
  + minutes + " Minutes " + seconds + " Seconds ";
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "Exams Started";
  }
}, 1000);

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

var searchInitiated = false;

var files = "";

var cnt=0;

var table = document.getElementById("resultTable");
var rows = table.getElementsByTagName("tr")

var file_list = "";
var file_list_orig = "";

function searchCourses(){

    $('#searchProcess').text("Processing..");
    toastr.info("Processing..","Please wait..");
    if(searchInitiated==false){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                files = JSON.parse(xmlhttp.responseText);
                file_list_orig = Object.keys(files);
                file_list = Object.keys(files);
                for(var i=0;i<file_list.length;i++){
                    file_list[i] = file_list[i].toUpperCase();
                }
            }
        }
        xmlhttp.open("GET","scanner.php", false);
        xmlhttp.send();
        searchInitiated = true;
    }
       
    if(cnt>0){
        var n = rows.length;
        for(var i=1;i<n;i++){
            table.deleteRow(1);        
        }
    }
    cnt++;
        
    if(document.getElementById('searchText').value.length < 4){
       $('#searchProcess').text("Please enter at least 4 letters to initiate search.");
    }
    else{
        var found = false;
        var search = document.getElementById('searchText').value.toUpperCase();
        for(var i=0;i<file_list.length;i++){
            if(file_list[i].indexOf(search) > -1){
                found = true;
                table.style.cssText = "max-width: 70%; table-layout: fixed;";
                var row = table.insertRow(1);
                row.style.cssText = "margin:10px;";
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.style.cssText = "word-wrap: break-word; padding-left: 15px; width:50%;";
                cell2.className = "text-center";
                cell1.innerHTML = file_list_orig[i];
                cell2.innerHTML = "<span style=\"vertical-align:middle;\">"+files[file_list_orig[i]]+"</span>";
                cell2.value = files[file_list_orig[i]];
                cell2.id = "course";
                cell3.className = "text-center";
                cell3.innerHTML = "<a href=\"download.php?course="+files[file_list_orig[i]]+"&file="+file_list_orig[i]+"\" class=\"btn btn-success\" style=\"vertical-align:middle\"><span class=\"glyphicon glyphicon-download-alt\"></span> Download</a>";
                cell2.style.textAlign = "center";
                cell3.style.verticalAlign = "middle";
                var cuurrent_file = file_list[i];
            }
        }
        if(found==false){
            document.getElementById('result').style.display = "none";
            $('#searchProcess').html("<br><h4>Nothing found..</h4><br>");
            toastr.error("Nothing found..","Oops..");
        }
        else{
            document.getElementById('result').style.display = "block";
            $('#searchProcess').text("");
        }
    }
 }

function regVal() {
    var roll1 = document.getElementById('registerRoll1').value;
    var roll2 = document.getElementById('registerRoll2').value;
    var roll3 = document.getElementById('registerRoll3').value;
    var date = document.getElementById('registerDate').value;
    var month = document.getElementById('registerMonth').value;
    var year = document.getElementById('registerYear').value;
    var name = document.getElementById('registerName').value;
    var gender = document.getElementById('registerGender').value;
    var email = document.getElementById('registerEmail').value;
    var phno = document.getElementById('registerPhno').value;
    var username = document.getElementById('registerUsername').value;
    var major = document.getElementById('registerMajor').value;
    var semester = document.getElementById('registerSemester').value;
    var password = document.getElementById('registerPassword').value;
    var cpassword = document.getElementById('registerCpassword').value;
    var secques = document.getElementById('registerSecques').value;
    var secans = document.getElementById('registerSecans').value;

    var rollno = roll1 + "/" + roll2 + "/" + roll3;
    var dob = date + "/" + month + "/" + year;
    document.getElementById("registerError").innerHTML = "Processing. Please Wait...";
    document.getElementById("registerError").style = "display: block";
    document.getElementById("registerButton").style = "border-color:";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                toastr.success("Registration successful","Success");
                document.getElementById("registerForm").innerHTML = "<font color='lightgreen'>You have been successfully registered. Please </font><a href='index.php'>Login</a>";
            } 
            else{
                document.getElementById("registerError").innerHTML = xmlhttp.responseText;
                document.getElementById("registerError").style = "display: block";
                document.getElementById("registerButton").style = "border-color: red";
                toastr.error("Form contains missing/incorrect values.", "Oops..");
            }
        }
    };
    xmlhttp.open("POST", "register.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("rollno="+rollno+"&dob="+dob+"&name="+name+"&gender="+gender+"&email="+email+"&phno="+phno+"&username="+username+"&major="+major+"&semester="+semester+"&password="+password+"&cpassword="+cpassword+"&secques="+secques+"&secans="+secans);
}

function checkForgot() {
    var roll1 = document.getElementById("forgotRoll1").value;
    var roll2 = document.getElementById("forgotRoll2").value;
    var roll3 = document.getElementById("forgotRoll3").value;
    var username = document.getElementById("forgotUsername").value;
    var rollno = roll1 + "/" + roll2 + "/" + roll3;
    document.getElementById("forgotError").innerHTML = "Processing. Please Wait...";
    document.getElementById("forgotError").style = "display: block";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                toastr.error("No such records found.","Oops..");
                document.getElementById("forgotError").innerHTML = "No such records found in database. Try again..";
            } else {
                document.getElementById("forgotForm").innerHTML = xmlhttp.responseText;
                document.getElementById("forgotError").innerHTML = "";
                document.getElementById("forgotError").style = "display: none";
            }
        }
    };
    xmlhttp.open("POST", "forgot.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("rollno=" + rollno + "&username=" + username);
}

function checkForgot1() {
    var secans = document.getElementById("forgotSecans").value;
    var xmlhttp = new XMLHttpRequest();
    document.getElementById("forgotError").innerHTML = "Processing. Please Wait...";
    document.getElementById("forgotError").style = "display: block";
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                toastr.error("Wrong Answer.","Oops..");
                document.getElementById("forgotError").innerHTML = "Wrong answer to security question. Please try again";
            } 
            else {
                document.getElementById("forgotError").innerHTML = "";
                document.getElementById("forgotError").style = "display: none";
                document.getElementById("forgotForm").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "forgot1.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("secans=" + secans);
}

function checkForgot3() {
    var pwd1 = document.getElementById("forgotPassword1").value;
    var pwd2 = document.getElementById("forgotPassword2").value;
    document.getElementById("forgotError").innerHTML = "Processing. Please Wait...";
    document.getElementById("forgotError").style = "display: block";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                toastr.success("Updation successful","Success");
                document.getElementById("forgotForm").innerHTML = "<font color='green'>Your password has been updated. Please now onwards </font><a href='index.php'>Login</a><font color='green'><b> with your new password</font>";
                document.getElementById("forgotError").innerHTML = "";
                document.getElementById("forgotError").style = "display: none";
            } 
            else {
                toastr.error("Errors","Oops..");
                document.getElementById("forgotError").innerHTML = xmlhttp.responseText;
                document.getElementById("forgotError").style = "display: block";
            }
        }
    };
    xmlhttp.open("POST", "forgot2.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("pwd1=" + pwd1 + "&pwd2=" + pwd2);
}

function checkUpdateForm() {
    var currpwd = document.getElementById("curr_pwd").value;
    var pwd1 = document.getElementById("up_pwd1").value;
    var pwd2 = document.getElementById("up_pwd2").value;
    document.getElementById("updateError").innerHTML = "Processing. Please Wait...";
    document.getElementById("updateError").style = "display: block";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("updateError").innerHTML = "<font color='darkgreen'>Your password has been successfully updated.</font>";
                document.getElementById("updateError").style = "display: block";
                document.getElementById("up_pwd1").value = "";
                document.getElementById("up_pwd2").value = "";
                document.getElementById("curr_pwd").value = "";
                toastr.success("Update successful.","Success");
            } else {
                toastr.error("Updation failed.","Oops..");
                document.getElementById("updateError").innerHTML = xmlhttp.responseText;
                document.getElementById("updateError").style = "display: block";
            }
        }
    };
    xmlhttp.open("POST", "update.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("currpwd=" + currpwd + "&pwd1=" + pwd1 + "&pwd2=" + pwd2);
}

function updateMajSem() {
    var major = document.getElementById("updateMajor").value;
    var sem = document.getElementById("updateSemester").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                document.getElementById("updateError").innerHTML = "";
                document.getElementById("updateError").style = "display: none";
                toastr.success("Update Successful", "Update");
            } else {
                toastr.error("Updation failed.","Oops..");
                document.getElementById("updateError").innerHTML = xmlhttp.responseText;
                document.getElementById("updateError").style = "display: block";
            }
        }
    };
    xmlhttp.open("POST", "update1.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("major="+major+"&sem="+sem);
}

function validateupload() {
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
    var username = document.getElementById("loginUsername").value;
    var password = document.getElementById("loginPassword").value;
    var rme;
    if (document.getElementById("rme").checked) {
        rme = "yes";
    } else {
        rme = "no";
    }
    document.getElementById("loginError").innerHTML = "Processing. Please Wait...";
    document.getElementById("loginError").style = "display: block";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                toastr.success("Login successful","Success");
                location.reload();
            } else {
                toastr.error("Authentication failed.","Oops..");
                document.getElementById("loginError").innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("username="+username+"&password="+password+"&rme="+rme);
}

function checkContactForm() {
    var name = document.getElementById("contactName").value;
    var email = document.getElementById("contactEmail").value;
    var phno = document.getElementById("contactPhno").value;
    var message = document.getElementById("contactMsg").value;
    toastr.info("Please wait..", "Processing");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                toastr.success("Your message was successfully received. We will get back to you as soon as possible", "Success");
                $("#contact-form").hide(500);
            } else {
                toastr.error(xmlhttp.responseText, "Oops..");
            }
        }
    };
    xmlhttp.open("POST", "contactfinal.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("name="+name+"&email="+email+"&phno="+phno+"&message="+message);
}



function coursefunc(courseid) {
    var course = courseid;
    $("#list-course-download").hide(500);
    document.getElementById("list-files-download").innerHTML = "Processing. Please Wait...";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                toastr.error("No files available for download", "Oops..");
                $("#list-course-download").show(1000);
                $("#list-files-download").hide();
            } else {
                document.getElementById("list-files-download").innerHTML = xmlhttp.responseText;
                $("#list-files-download").show(1000);
            }
        }
    };
    xmlhttp.open("POST", "list.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("course="+course);
}

function showCourses(){
    $("#list-files-download").hide();
    $("#list-course-download").show(500);
}

function initiateUpload(){
    $("#uploadInstructions").hide(500);
    $("#uploadForm").show(500);
}
function coursefuncqp(courseid) {
    var course = courseid;
    $("#list-course-qp").hide(500);
    document.getElementById("list-files-qp").innerHTML = "Processing. Please Wait...";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == "0") {
                toastr.error("No question papers for download", "Oops..");
                $("#list-course-qp").show(1000);
                $("#list-files-qp").hide();
            } else {
                document.getElementById("list-files-qp").innerHTML = xmlhttp.responseText;
                $("#list-files-qp").show(1000);
            }
        }
    };
    xmlhttp.open("POST", "listqp.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("course="+course);
}

function showCoursesqp(){
    $("#list-files-qp").hide();
    $("#list-course-qp").show(500);
}


function startUpload(){
    document.getElementById('uploadButton').innerHTML = "Uploading.. Please wait..";
    toastr.info("Upload started","Hang on..");
    return true;
}

function stopUpload(success){
      var result = '';
      document.getElementById('uploadButton').innerHTML = "Upload <span class=\"glyphicon glyphicon-upload\"></span>";
      if (success=="0"){
         toastr.success("Thank you for sharing.","Upload successful");
         document.getElementById("uploadFormForm").reset();
         $("#uploadForm").hide(500);
         $("#uploadSuccess").show(500);
     }
      else {
         toastr.error(success,"Oops..");
      }     
      return true;   
}

function showUpload(){
    $("#uploadSuccess").hide(500);
    $("#uploadForm").show(500);
}