BitZoom is an open source project that sets up a content, files, papers sharing system for a college, research institution, etc. It is built primarily on PHP and uses Javascript, AJAX, BootStrap as its major technology. Each of the file has been properly documented with comments. 

<b>Developed by : </b><br>
Sushant Kumar Gupta & Abhishek Kujur <br>
Computer Science and Engineering <br>
Birla Institute of Technology<br>
Ranchi, India<br>

<h3>To setup the site follow the following steps : </h3>

1. Install a WAMP or LAMP server on the server.
2. Login to PHPMYADMIN (http://localhost/phpmyadmin if the server is on localhost). Now run the SQL query present in the bitzoom.sql file in the bitzoom database. 
3. Open the file config.php and enter the database details in the file.
4. Give full permission to uploads/ folder, so that PHP can write to it when a file is uploaded.
5. Visit the index.php in the browser. 
6. You will be prompted to login, just select "Forgot your password" option.
7. In the next modal that appears enter roll no "BE/00000/15" and username "sampleuser". The answer to security question is "noanswer". Change the password now to make sure the database works.
8. Now login using the username "sampleuser" and password that you resetted above. At the home page select "Computer Science and Engg", then Select "Semester 1" and finally select "Fundamental of Data Structures". If PHP has the required permission it will list the contents of directory /BitZoom/CS2001/ which by default contains a sample text file. Download the file to check if the download option works.
9. Repeat step 8 for Question papers as well.
10. Go to upload.php, and check its working by uploading a file. If you constanstly get error, you need to provide permission to uploads/ folder.
11. Finally check the working of contact form and the newreg/new.php form.

<br>Done. Congrats you have set up BitZoom.

<b>Details of Database :</b><br><br>
The database consists of 6 tables:<br>
<b>1. registered_users :</b> In this table records of those who have registered exists. The 'slno' column is the primary key here and 'id' column is derived from the 'user_details'->'id' column.<br>
<b>2. user_details :</b> In this table the student records are present which may derived from your college's records, or you may use newreg/new.php to add new records to user_details. Remember a user cannot have a record in registered_users table unless he/she has record in user_details table. 'id' column is the primary column here.<br>
<b>3. loggedin_users :</b> This table stores information about user's username and password hashes when he/she is logged in.<br>
<b>4. course :</b> This table contains records of all the major, sem, coursename and course ID offered by your college. The folder inside BitZoom/ has same name as the courseid found in the course table.<br>
<b>5. contact :</b> Whenever someone contacts you, the records of contact is saved here. You may add 'ip' and 'time' column to the table and capture the ip and time of the contacting user.<br>
<b>6. uploads :</b> Whenever a user uploads something, details about the same is inserted here.<br>


<b>Additional Settings :</b><br>
1. To increase the security change the Session cookie name of PHP to something else.<br>
2. Increase the upload file limit in php.ini. By default it is about 8 MB.<br>
3. Increase the time limit for a script to be executed on the server. This is required so as large files can be downloaded.<br>
4. Turn off error and warning reporting in 'php.ini' file.
5. Change the folder location of BitZoom, BitZoomQP and uploads to another location and update about the same in upload.php, list.php, listqp.php, download.php, downloadqp.php
