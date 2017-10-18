<?php
/* This is the file which validates the download that the user requests to be initiated */
session_start();
$file = $_GET['file'];
$course = $_GET['course'];

if (!isset($_SESSION['username']))
    {
    echo "<title>404 Not Found</title><h1>Not Found</h1>No such file was found on the server. Alternatively you have not have enough privileges to access the content. <a href=index.php>Click here</a> to go back home";
        exit("");
    }

$path = "BitZoomQP/";
$fullPath = $path . $course . "/" . $file;

if (!file_exists($fullPath))
    {
    echo "<title>404 Not Found</title><h1>Not Found</h1>No such file was found on the server. Alternatively you have not have enough privileges to access the content. <a href=index.php>Click here</a> to go back home";
    exit;
    }


if ($fd = fopen($fullPath, "r"))
{
    $log = 'download.log';
    date_default_timezone_set('Asia/Kolkata');
    $time = date('Y/m/d H:i:s');
    $data = "File - " . $file . " ||| Course - " . $course . " ||| Username - " . $_SESSION['username'] . " ||| IP - " . $_SERVER[REMOTE_ADDR] . " ||| " . $time . "\n";
    file_put_contents($log, $data, FILE_APPEND | LOCK_EX);
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext)
    {
    case "pdf":
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=\"" . $path_parts["basename"] . "\"");
        break;
    default;
    header("Content-type: application/octet-stream");
    header("Content-Disposition: filename=\"" . $path_parts["basename"] . "\"");
    break;
    }

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