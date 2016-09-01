<?php
/* This is the file which lists the content of directory, for example when user selects a course called FDS having course number CS2001, the contents of directory 'BitZoom\CS2001\' is listed by this script. Change the folder to the location where your files are stored */
/* First we get the user data for the course he/she selects. Remember to filter the user data using addslashes(mysql_real_esape(htmlspecialchars())) */
$course = $_POST['course'];
/* Now we validate the data to see if its not null. If its null return error */

if ($course == "")
	{
	exit("<br /><br /><font color=red face=arial size=2px><b><center></center></b></font>");
	}
/* If the user data is correct then traverse the directory to scan it */
$dir = "BitZoom/" . $course . "/";

if (!is_dir($dir))
	{
	/* If the directory is not found, then the admin has not added any course material related to the subject so return No file found error */
	exit("<br><br><br><font color=red face=arial size=2px><b><center>No files found related to this course. Please check back later.</center></b></font>");
	}

/* If the directory is found then list all the files within it. Make sure not to have any folder inside the course folder or else it will result in error. This is because the script traverses only one directory level */
$ffs = scandir($dir);
echo "<br /><table class=\"table table-hover\" style=\"word-wrap:break-word;\"><tr style=\"background-color:black;color:white;text-align:center\"><th style=\"text-align:center\">File name</th><th style=\"text-align:center\">Course ID</th><th style=\"text-align:center\">Download</th></tr>";

foreach($ffs as $ff)
	{
	if ($ff != '.' && $ff != '..')
		{
		echo '<tr><td style=\"word-wrap:break-word;max-width:160px;min-width:160px;\"><font color="#000033">' . $ff;
		if (is_dir($dir . '/' . $ff)) listFolderFiles($dir . '/' . $ff);

		/* Remember the file name can contain several illegal characters, so they need to be encoded in url */
		$ff = urlencode($ff);
		$ff = str_replace('@', '%40', $ff);
		$ff = str_replace('&', '%26', $ff);
		/* Here we also include a button, which onclick, sends a request to validatedownload.php */
		echo '</font></td> <td>' . $course . '</td><td><div onclick=downloadf(\'' . $ff . '\') class="btn btn-primary" style="vertical-align:middle">Download</div></td></tr>';
		}
	}

echo "</table>";
?>