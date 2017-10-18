BitZoom is an open source project that sets up a content, files, papers sharing system for a college, research institution, etc. It is built primarily on PHP and uses Javascript, AJAX, BootStrap as its major technology. Each of the file has been properly documented with comments. 

<b>Developed by : </b><br>
Sushant Kumar Gupta & Abhishek Kujur <br>
Computer Science and Engineering <br>
Birla Institute of Technology<br>
Ranchi, India<br>

<h3>To setup the site follow the following steps : </h3>

1. Install a WAMP or LAMP server on the server.
2. Login to PHPMYADMIN (http://localhost/phpmyadmin if the server is on localhost). Now run the SQL query present in the bitzoom.sql file in the database. 
3. Open the file config.php and enter the database details in the file.
4. Give full permission to uploads/ folder, so that PHP can write to it when a file is uploaded.
5. Visit index.php in a browser. Sign up as a new user and login.
6. Test the downloads and uploads.

<br>Done. Congrats you have set up BitZoom.

<b>Details of Database :</b><br><br>
The database consists of 6 tables:<br>
<b>1. registered_users :</b> In this table records of those who have registered exists.<br>
<b>2. loggedin_users :</b> This table stores information about user's username and password hashes when he/she is logged in.<br>
<b>3. course :</b> This table contains records of all the major, sem, coursename and course ID offered by your college. The folder inside BitZoom/ has same name as the courseid found in the course table.<br>
<b>4. contact :</b> Whenever someone contacts you, the records of contact is saved here. You may add 'ip' and 'time' column to the table and capture the ip and time of the contacting user.<br>
<b>5. uploads :</b> Whenever a user uploads something, details about the same is inserted here.<br>


<b>Additional Settings :</b><br>
1. To increase the security change the Session cookie name of PHP to something else.<br>
2. Increase the upload file limit in php.ini. By default it is about 8 MB.<br>
3. Increase the time limit for a script to be executed on the server. This is required so as large files can be downloaded.<br>
4. Turn off error and warning reporting in 'php.ini' file.
5. Change the folder location of BitZoom, BitZoomQP and uploads to another location and update about the same in upload.php, list.php, listqp.php, download.php, downloadqp.php
