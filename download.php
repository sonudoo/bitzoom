<?php
/* This is the file which validates the download that the user requests to be initiated */
session_start();
/* The input received from the query string generated dynamically from the link. See validatedownload.php where the link is generated. The query string is not validated. However you must include a validation before posting the pages online. addslashes(mysql_real_escape(htmlspecialchars())) does good user data validation. However be careful as user data can never be trusted*/
$file = $_GET['file'];
$course = $_GET['course'];
/*Check if the user is logged in. If not, simply kill the script and notify user that he/she is accessing a 404 page. You see the page exists, but we are forcefully throwing a 404 error because the user is not logged in.*/

if (!isset($_SESSION['username']))
    {
    echo "<title>404 Not Found</title><h1>Not Found</h1>No such file was found on the server. Alternatively you have not have enough privileges to access the content. <a href=index.php>Click here</a> to go back home";
    exit("");
    }

// If the user is logged in the script continues.

$path = "BitZoom/"; //The drive and the folder where your files are present. Inside BitZoom folder, we have the folders by Subject code .
$fullPath = $path . $course . "/" . $file; /*The full path to the file on server is the $path as declared in the above variable, followed by the course ID (for ex CS2001) and then the file name. If such a file exists then the script continues or dies*/

if (!file_exists($fullPath))
    {
    echo "<title>404 Not Found</title><h1>Not Found</h1>No such file was found on the server. Alternatively you have not have enough privileges to access the content. <a href=index.php>Click here</a> to go back home";
    exit;
    }

// If file exists then all conditions are satisfies for download to be initiated.

if ($fd = fopen($fullPath, "r"))
    {
    /*We need to maintain a log of files that were downloaded. The following code does that and saves the data in download.log*/
    $log = 'download.log';
    date_default_timezone_set('Asia/Kolkata');
    $time = date('Y/m/d H:i:s');
    $data = "File - " . $file . " ||| Course - " . $course . " ||| Username - " . $_SESSION['username'] . " ||| IP - " . $_SERVER[REMOTE_ADDR] . " ||| " . $time . "\n";
    file_put_contents($log, $data, FILE_APPEND | LOCK_EX);

    // End of logging

    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext)
        {
        /* Some browsers donot download PDF files, instead they themselves open them, so we need to force the download process for PDF file*/
    case "pdf":
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=\"" . $path_parts["basename"] . "\"");
        break;
        /* For rest of the file type, the download initiates automatically*/
    default;
    header("Content-type: application/octet-stream");
    header("Content-Disposition: filename=\"" . $path_parts["basename"] . "\"");
    break;
    }

// The following lines sends header to begin download.

header("Content-length: $fsize");
header("Cache-control: private");

while (!feof($fd))
    {
    $buffer = fread($fd, 2048);
    echo $buffer;
    }
}

fclose($fd);
exit;
?>