<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BitZoom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.min.js"></script>

    
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/animate.min.css" />
    <link rel="stylesheet" href="./css/ionicons.min.css" />
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link href="css/toastr.min.css" rel="stylesheet"/>
  </head>
  <body>
    <div id="toast"></div>
    <nav id="topNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#first"> BitZoom </a>
            </div>
            <div class="navbar-collapse collapse" id="bs-navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="#download">Downloads</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#qp">Question Papers</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#search">Search</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#upload">Upload</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php
                        session_start();
                        if (isset($_SESSION['username']))
                        {
                            echo "<a class=\"page-scroll\" style=\"vertical-align:middle\" data-toggle=\"modal\" href=\"#settingsModal\">Settings</a></li><li><a class=\"page-scroll\" style=\"vertical-align:middle\" href=\"logout.php\">Logout</a>";
                        }

                        else if (isset($_COOKIE['rl1']))
                        {

                            $rl1 = $_COOKIE['rl1'];
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $rl2 = $_COOKIE['rl2'];

                            include('config.php');

                            $sql1 = "SELECT * FROM loggedin_users WHERE cookie='$rl1' AND ip='$ip' AND cookie2='$rl2'";
                            $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result1) > 0)
                            {
                                $row = mysqli_fetch_assoc($result1);
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

                                header('location:index.php');
                            }
                            else
                            {
                                setCookie("rme", "rme", time() - 3700, "/");
                                echo "
                                    <script>
                                        $(window).on('load',function(){
                                            $('#loginModal').modal('show');
                                        });
                                    </script>

                                    <a class=\"page-scroll\" data-toggle=\"modal\" href=\"#registerModal\">Register</a></li><li><a class=\"page-scroll\" data-toggle=\"modal\" href=\"#loginModal\">Login</a>";
                            }
                        }
                        else
                        {
                            echo "
                                    <script>
                                        $(window).on('load',function(){
                                            $('#loginModal').modal('show');
                                        });
                                    </script>
                                    <a class=\"page-scroll\" data-toggle=\"modal\" href=\"#registerModal\">Register</a></li><li><a class=\"page-scroll\" data-toggle=\"modal\" href=\"#loginModal\">Login</a>";
                        }

                        ?>
                    </li>
                    <li>
                        <a class="page-scroll" data-toggle="modal" href="#aboutModal">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header id="first">
        <div class="header-content">
            <div class="inner">
                <h4 id="timer"></h4>
                <hr>
                <a href="#download" class="btn btn-primary btn-xl page-scroll">Download now</a>
            </div>
        </div>
    </header>
    <section class="bg-primary" id="download">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php
                        if (!isset($_SESSION['username']))
                        {
                            echo "<h2 class=\"margin-top-0 text-primary\">Please login :(</h2>
                                    <br>
                                    <p class=\"text-faded\">
                                        Before you can really download the resources, we want you to login. If you don't have an account, then you can register which takes hardly a minute.
                                    </p>
                                    <a href=\"#loginModal\" data-toggle=\"modal\" class=\"btn btn-default btn-xl page-scroll\">Login Now</a>";
                        }
                        else{

                            echo "<h2 class=\"margin-top-0 text-primary\">Downloads</h2>
                                    <div class=\"text-faded\" id=\"list-course-download\">";

                            include ('config.php');

                            $major = $_SESSION['branch'];
                            $sem = $_SESSION['sem'];

                            $sql = "SELECT * FROM course WHERE major LIKE '%$major%' AND sem LIKE '%$sem%'";
                            $result = mysqli_query($conn, $sql);


                            if (mysqli_num_rows($result) > 0)
                            {
                                echo "<div class=\"funkyradio\">";

                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<div class=\"funkyradio-default\">
                                                <input type=\"radio\" name=\"".$row['courseid']."\" id=\"".$row['courseid']."\" onclick=\"coursefunc('".$row['courseid']."')\" />
                                                <label for=\"".$row['courseid']."\">".$row['coursename']."</label>
                                            </div>";
                                }


                                echo "</div>";
                            }
                            else
                            {
                                echo "We are sorry :(. We have nothing to offer you in this section.";
                            }

                            echo "</div><p class=\"text-faded\" id=\"list-files-download\">
                                    </p>";

                            mysqli_close($conn); 
                                    
                        }

                    ?>
                </div>
            </div>
        </div>
    </section>
    <section id="qp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php
                        if (!isset($_SESSION['username']))
                        {
                            echo "<h2 class=\"margin-top-0 text-primary\">Please login :(</h2>
                                    <br>
                                    <p class=\"text-faded\">
                                        Before you can really download the resources, we want you to login. If you don't have an account, then you can register which takes hardly a minute.
                                    </p>
                                    <a href=\"#loginModal\" data-toggle=\"modal\" class=\"btn btn-default btn-xl page-scroll\">Login Now</a>";
                        }
                        else{

                            echo "<h2 class=\"margin-top-0 text-primary\">Question Papers</h2>
                                    <div class=\"text-faded\" id=\"list-course-qp\">";

                            include ('config.php');

                            $major = $_SESSION['branch'];
                            $sem = $_SESSION['sem'];

                            $sql = "SELECT * FROM course WHERE major LIKE '%$major%' AND sem LIKE '%$sem%' AND coursename NOT LIKE '%lab%' AND coursename NOT LIKE '%LAB%' AND coursename NOT LIKE '%Lab%'";
                            $result = mysqli_query($conn, $sql);


                            if (mysqli_num_rows($result) > 0)
                            {
                                echo "<div class=\"funkyradio\">";

                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<div class=\"funkyradio-default\">
                                                <input type=\"radio\" name=\"".$row['courseid']."\" id=\"".$row['courseid']."QP\" onclick=\"coursefuncqp('".$row['courseid']."')\" />
                                                <label for=\"".$row['courseid']."QP\">".$row['coursename']."</label>
                                            </div>";
                                }


                                echo "</div>";
                            }
                            else
                            {
                                echo "We are sorry :(. We have nothing to offer you in this section.";
                            }

                            echo "</div><p class=\"text-faded\" id=\"list-files-qp\">
                                    </p>";

                            mysqli_close($conn); 
                                    
                        }

                    ?>
                </div>
            </div>
        </div>
    </section>
    <section id="search">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php
                        if (!isset($_SESSION['username']))
                        {
                            echo "<h2 class=\"margin-top-0 text-primary\">Please login :(</h2>
                                    <br>
                                    <p class=\"text-faded\">
                                        Before you can really download the resources, we want you to login. If you don't have an account, then you can register which takes hardly a minute.
                                    </p>
                                    <a href=\"#loginModal\" data-toggle=\"modal\" class=\"btn btn-default btn-xl page-scroll\">Login Now</a>";
                        }
                        else{

                            echo "<h2 class=\"margin-top-0 text-primary\">Search for files</h2>
                                    <br>
                                    <p class=\"text-faded\">
                                        <input type=\"text\" class=\"form-control center-block\" placeholder=\"Search..\" id=\"searchText\" style=\"width:50%;\">
                                            <br>
                                        <button type=\"button\" onclick=\"searchCourses()\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Search</button>
                                    </p>
                                    <p>
                                        <div id=\"searchProcess\">
                                        </div>
                                        <div class=\"search-table\" id=\"result\" style=\"display: none; text-align:center;\">
                                             <table class=\"table table-fill\" id=\"resultTable\">
                                                 <tbody>
                                                     <tr>
                                                         <th class=\"text-center\">File name</th>
                                                         <th class=\"text-center\">Course ID</th>
                                                         <th class=\"text-center\">Download</th>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </div>
                                    </p>";
                                    
                        }

                    ?>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-primary" id="upload">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                    <?php
                        if (!isset($_SESSION['username']))
                        {
                            echo "<h2 class=\"margin-top-0 text-primary\">Please login :(</h2>
                                    <br>
                                    <p class=\"text-faded\">
                                        Before you can really download the resources, we want you to login. If you don't have an account, then you can register which takes hardly a minute.
                                    </p>
                                    <a href=\"#loginModal\" data-toggle=\"modal\" class=\"btn btn-default btn-xl page-scroll\">Login Now</a>";
                        }
                        else{
                            echo "<h2 class=\"margin-top-0 text-primary\">Upload your files</h2>
                                    <div class=\"text-faded\" id=\"uploadInstructions\">
                                        You like to share? Nothing can be better than this. But before we proceed please keep in mind that:-
                                        <ul class=\"list-group\" style=\"background: transparent; margin-top: 50px; text-align: left;\">
                                            <li class=\"list-group-item\" style=\"background: transparent;\">Max upload size is 50 MB.</li>
                                            <li class=\"list-group-item\" style=\"background: transparent;\">Uploaded files would be verified before they appear.</li>
                                            <li class=\"list-group-item\" style=\"background: transparent;\">If you have many files to upload, please Zip and upload. Mention about the same in the comments.</li>
                                            <li class=\"list-group-item\" style=\"background: transparent;\">Allowable file formats : JPG, PNG, PDF, ZIP, RAR, DOC, PPT.</li>
                                        </ul>
                                        <br><br>
                                        <button type=\"button\" onclick=\"initiateUpload()\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Continue >></button>
                                    </div>
                                    <div class=\"text-faded\" id=\"uploadForm\" style=\"display: none;\">
                                        <div class=\"center-block\">
                                            <form id=\"uploadFormForm\" method=\"post\" enctype=\"multipart/form-data\" target=\"uploadTarget\" action=\"upload.php\">
                                                <br>
                                                <input  name=\"file\" type=\"file\" id=\"uploadFile\" class=\"form-control center-block\">
                                                <br>
                                                <select name=\"uploadMajor\" class=\"form-control center-block\" id=\"uploadMajor\">
                                                      <option value=\"\">Major</option>
                                                      <option value=\"BIOTECH\">Biotechnology</option>
                                                      <option value=\"CHEM\">Chemical Engineering</option>
                                                      <option value=\"CIVIL\">Civil Engineering</option>
                                                      <option value=\"CSE\">Computer Science Engineering</option>
                                                      <option value=\"EEE\">Electrical and Electronics Engineering</option>
                                                      <option value=\"IT\">Information Technology</option>
                                                      <option value=\"ECE\">Electronics and Communication Engineering</option>
                                                      <option value=\"MECH\">Mechanical Engineering</option>
                                                      <option value=\"PROD\">Production Engineering</option>
                                                </select> 
                                                <br>
                                                <select  name=\"uploadSemester\" class=\"form-control center-block\" id=\"uploadSemester\">
                                                      <option value=\"\">Semester</option>
                                                      <option value=\"1\">1</option>
                                                      <option value=\"2\">2</option>
                                                      <option value=\"3\">3</option>
                                                      <option value=\"4\">4</option>
                                                      <option value=\"5\">5</option>
                                                      <option value=\"6\">6</option>
                                                      <option value=\"7\">7</option>
                                                      <option value=\"8\">8</option>
                                                </select> 
                                                <br>
                                                <input type=\"text\" name=\"uploadCourse\" id=\"uploadCourse\" class=\"form-control center-block\" placeholder=\"Course Name\">
                                                <br>
                                                <br>
                                                <button type=\"submit\" data-toggle=\"modal\" class=\"btn btn-primary btn-lg center-block\" onclick=\"startUpload()\" id=\"uploadButton\">Upload <span class=\"glyphicon glyphicon-upload\"></span></button>
                                                </div>
                                                <iframe id=\"uploadTarget\" name=\"uploadTarget\" src=\"#\" style=\"width:0;height:0;border:0px solid #fff;\"></iframe>
                                            </form>
                                        </div>
                                    <div class=\"text-faded\" id=\"uploadSuccess\" style=\"display: none\">
                                        <br>
                                        <br>
                                        Upload Successful. It will be reviewed by the moderators soon.
                                        <br><br>
                                        <button type=\"button\" onclick=\"showUpload()\" class=\"btn btn-primary\" style=\"vertical-align:middle\">Upload Another</button>
                                    </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="margin-top-0 wow fadeIn">Contact us</h2>
                    <hr class="primary">
                    <p>We'll get back to you as soon as possible.</p>
                </div>
                <div class="center-block">
                    <form class="contact-form row" id="contact-form">
                        <input type="text" id="contactName" class="form-control center-block" placeholder="Name">
                        <br>
                        <input type="text" id="contactEmail" class="form-control center-block" placeholder="Email">
                        <br>
                        <input type="text" id="contactPhno" class="form-control center-block" placeholder="Phone">
                        <br>
                        <textarea class="form-control center-block" id="contactMsg" rows="9" placeholder="Your message here.."></textarea>
                        <br>
                        <br>
                        <button type="button" data-toggle="modal" data-target="#alertModal" class="btn btn-primary btn-lg center-block" onclick="checkContactForm()">Send <i class="ion-android-arrow-forward" ></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="container-fluid" style="text-align: center">
            <span class="center-block text-muted small">&copy; Sushant Kumar Gupta, Birla Institute of Technology</span>
        </div>
    </footer>
    <div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color:#ffffff">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
                <div class="error" id="loginError" style="display: none;"></div>
                <div id="loginresponse"></div>
                    <input type="text" class="form-control center-block" placeholder="Username" id="loginUsername">
                    <br />
                        <input type="password" class="form-control center-block" placeholder="********" id="loginPassword">
                    <br />
                        <div class="checkbox" style="text-align: center">
                            <label>
                                <input type="checkbox" class="center-block" aria-label="Keep logged in" name="rememberme" id="rme" value="yes" checked="true">&nbsp;&nbsp; Keep logged in
                            </label>
                        </div>
                    <br />

                    <button class="btn btn-primary center-block" type="button" onclick="checkLogForm()" style="align:center">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary center-block" data-dismiss="modal" data-toggle="modal" data-target="#forgotModal"  style="display: inline-block;">Forgot password</button>
                <button type="button" class="btn btn-primary center-block" data-dismiss="modal" data-toggle="modal" data-target="#registerModal" style="display: inline-block;">Register</button>
                <br />
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="forgotModal" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="color:#ffffff">&times;</button>
                    <h4 class="modal-title">Forgot Password</h4>
                </div>
                <div class="modal-body">
                    <div id="forgotError" class="error" style="display: none;"></div>
                    <br />
                    <div class="form-group" id="forgotForm" style="text-align: center;">
                        <select class="form-control center-block" style="width:auto;display:inline" id="forgotRoll1">
                            <option value="BE">BE</option>
                        </select>
                        <input type="text" style="width:20%;display:inline" class="form-control" placeholder="10XXX" id="forgotRoll2">
                        <select class="form-control" style="width:auto;display:inline" id="forgotRoll3">
                            <option value="16">2016</option>
                            <option value="15">2015</option>
                            <option value="14">2014</option>
                            <option value="13">2013</option>
                            <option value="12">2012</option>
                        </select>
                        <br />
                        <br />
                        <input type="text" class="form-control center-block" placeholder="Username" id="forgotUsername">
                        <br />
                        <button onclick="checkForgot()" class="btn btn-primary center-block">Continue</button>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="settingsModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="color:#ffffff">&times;</button>
                    <h4 class="modal-title">Settings</h4>
                </div>

                <div class="modal-body">
                    <div id="update" style="text-align: center;">
                        <div id="updateError" class="error" style="display: none;"></div>
                        <br />
                        <?php
                        session_start();

                        if ((!$_SESSION['id']) || (!$_SESSION['name']) || (!$_SESSION['rollno']) || (!$_SESSION['sex']) || (!$_SESSION['branch']) || (!$_SESSION['sem']) || (!$_SESSION['dob']))
                            {
                            echo "<b>Please <a href=\"\">Login</a> first to update your details</b>";
                            }
                          else
                            {
                            echo "<b>Username : </b><font color='lightyellow'>".$_SESSION['username']."</font><br>
                                    <b>Name : </b><font color='lightyellow'>".$_SESSION['name']."</font><br>
                                    <b>Username : </b><font color='lightyellow'>".$_SESSION['username']."</font><br>
                                    <b>Rollno : </b><font color='lightyellow'>".$_SESSION['rollno']."</font><br><br>
                                    <b>Major : </b>
                                    <select id=\"updateMajor\" class=\"form-control center-block\" style=\"width: 20%; display: inline;\" onchange=\"updateMajSem()\">
                                        <option value=\"".$_SESSION['branch']."\">".$_SESSION['branch']."</option>
                                        <option value=\"CSE\">CSE</option>
                                        <option value=\"ECE\">ECE</option>
                                        <option value=\"EEE\">EEE</option>
                                        <option value=\"IT\">IT</option>
                                        <option value=\"MECH\">MECH</option>
                                        <option value=\"CHEM\">CHEM</option>
                                        <option value=\"CHEMP\">CHEM and POLY</option>
                                        <option value=\"PROD\">PROD</option>
                                        <option value=\"CIVIL\">CIVIL</option>
                                        <option value=\"BIOTECH\">BIOTECH</option>
                                    </select>
                                    <br>
                                    <br>
                                    <b>Semester : </b>
                                    <select id=\"updateSemester\" class=\"form-control center-block\" style=\"width: 20%; display: inline;\" onchange=\"updateMajSem()\">
                                        <option value=\"".$_SESSION['sem']."\">".$_SESSION['sem']."</option>
                                        <option value=\"1\">1</option>
                                        <option value=\"2\">2</option>
                                        <option value=\"3\">3</option>
                                        <option value=\"4\">4</option>
                                        <option value=\"5\">5</option>
                                        <option value=\"6\">6</option>
                                        <option value=\"7\">7</option>
                                        <option value=\"8\">8<option>
                                    </select></font><br>
                                    <br>
                                        <input type=\"password\" name=\"curr_pwd\" placeholder=\"Current Password\" class=\"form-control center-block\" id=\"curr_pwd\">
                                        <br>
                                        <input type=\"password\" name=\"pwd1\" placeholder=\"New Password\" class=\"form-control center-block\" id=\"up_pwd1\">
                                        <br>
                                        <input type=\"password\" name=\"pwd2\" placeholder=\"Confirm Password\" class=\"form-control center-block\" id=\"up_pwd2\"></input><br />
                                      <button type=\"button\" onclick=\"checkUpdateForm()\" class=\"btn btn-primary center-block\" style=\"vertical-align:middle\">Update Password</button><br /><br />";
                            } 
                        ?>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="registerModal" role="dialog" style="overflow-y:scroll;clear:both">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color:#ffffff">&times;</button>
                <h4 class="modal-title">Registration</h4>
            </div>
            <div class="modal-body">
                <div class="form-group" id="registerForm" style="text-align: center;">
                    <div id="registerError" class="error" style="display: none;"></div>
                    <br />
                    <select class="form-control" style="width:auto;display:inline" id="registerRoll1">
                        <option value="BE">BE</option>
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" value="" style="width:20%;display:inline" class="form-control" placeholder="10XXX" aria-describedby="sizing-addon1" id="registerRoll2">&nbsp;&nbsp;
                    <select class="form-control" style="width:auto;display:inline" id="registerRoll3">
                        <option value="17">2017</option>
                        <option value="16">2016</option>
                        <option value="15">2015</option>
                        <option value="14">2014</option>
                        <option value="13">2013</option>
                    </select>&nbsp;&nbsp;
                    <br />
                    <br />
                    <select name="rdate" id="registerDate" class="form-control" style="width:auto;display:inline">
                        <option value="">DD</option>
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
                    <select name="month" id="registerMonth" class="form-control" style="width:auto;display:inline">
                        <option value="0">MM<option>
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
                    <select name="year" class="form-control" id="registerYear" style="width:auto;display:inline">
                        <option value="">YYYY</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1995">1995</option>
                        <option value="1994">1994</option>

                    </select>&nbsp;&nbsp;
                    <br>
                    <br>
                    <input type="text" class="form-control center-block" placeholder="Full Name" id="registerName">
                    <br>
                    <select id="registerGender" class="form-control center-block">
                        <option value="0">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <br>
                    <input type="text" class="form-control center-block" placeholder="Email ID" id="registerEmail">
                    <br>
                    <input type="number" class="form-control center-block" placeholder="Phno" id="registerPhno">
                    <br>
                    <input type="text" class="form-control center-block" placeholder="Username" id="registerUsername">
                    <br>
                    <select id="registerMajor" class="form-control center-block">
                        <option value="">Major</option>
                        <option value="CSE">CSE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                        <option value="IT">IT</option>
                        <option value="MECH">MECH</option>
                        <option value="CHEM">CHEM</option>
                        <option value="CHEMP">CHEM and POLY</option>
                        <option value="PROD">PROD</option>
                        <option value="CIVIL">CIVIL</option>
                        <option value="BIOTECH">BIOTECH</option>
                    </select>
                    <br>
                    <select id="registerSemester" class="form-control center-block">
                        <option value="0">Semeter</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8<option>
                    </select>
                    <br>
                    <input type="password" class="form-control center-block" placeholder="Password" id="registerPassword">
                    <br>
                    <input type="password" class="form-control center-block" placeholder="Confirm Password" id="registerCpassword">
                    <br>
                    <select id="registerSecques" class="form-control center-block">
                        <option value="0">Select security question</option>
                        <option value="1">What is your favorite book?</option>
                        <option value="2">What is your pet's name?</option>
                        <option value="3">Who according to you created this world?</option>
                        <option value="4">What is your favorite song?</option>
                    </select>
                    <br>
                    <input type="text" class="form-control center-block" placeholder="Answer" id="registerSecans">
                    <br>
                    <br>
                    <button type="button" onclick="regVal()" class="btn btn-primary" id="registerButton" style="vertical-align:middle">Register</button>
                </div>
                <br />


            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>
    <div id="aboutModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-body">
        		<h2 class="text-center">BitZoom</h2>
        		<h5 class="text-center">
        		    
        		</h5>
        		<p class="text-justify">
                    BitZoom is created by 2k15 students of CSE, Birla Institute of Technology, Ranchi.<br><br><b>Backend -</b> Sushant Kumar Gupta<br><b>Frontend - </b>Abhishek Kujur, Sushant Kumar Gupta<br><br><b><ul><li> Why I need to sign up?</li></b><br>We need to track which files are downloaded the most and so we can increase its availability and improve our services. Signing up is a very short process and takes hardly half a minute.<br><br><b><br><b><li>What data are you tracking?</li></b><br>We are only tracking your IP from which the file was uploaded or downloaded.<br> We also track your cookies when you login or signup.<br><br><br></ul>
        		</p>
        		<br/>
        		<button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Close</button>
        	</div>
        </div>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.easing.min.js"></script>
    <script src="./js/wow.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>