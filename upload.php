
  <?php

session_start();

$result = "Form contains missing values";

if (isset($_POST['uploadCourse']) && $_FILES["file"]["size"] > 0 && isset($_SESSION['id']))
{

  $result = "0";
  
  $output = rand(1, 9);
  for ($i = 0; $i < 10; $i++)
  {
    $output.= rand(0, 9);
  }

  $rand = $output;
  mkdir("uploads/" . $rand . "/");
  $target_dir = "uploads/" . $rand . "/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $uploadbool = 1;
  $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


  if (addslashes($_POST['uploadCourse']) == "")
  {
    $result = "Please mention the course name..";
  }

  else if (addslashes($_POST['uploadMajor']) == "")
  {
    $result = "Please select a major..";
  }

  else if (addslashes($_POST['uploadSemester']) == "")
  {
    $result = "Please select a semester..";
  }
  else if (file_exists($target_file))
  {
    $result = "This file already exists on server..";
  }

  else if ($_FILES["file"]["size"] > 50000000)
  {
    $result = "File is too large. Max is 50 MB.";
  }

  else if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "ppt" && $imageFileType != "docx" && $imageFileType != "zip" && $imageFileType != "rar" && $imageFileType != "pptx")
  {
    $result = "This file format is not supported for uploads..";
  }
  else
  {

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
    {
      include ('config.php');

      $subject = $_POST['uploadCourse'];
      $major = $_POST['uploadMajor'];
      $sem = $_POST['uploadSemester'];

      $sql1 = "INSERT INTO uploads (username,folder,subject,major,sem) VALUES ('" . $_SESSION['username'] . "','" . $rand . "','" . $subject . "','" . $major . "','" . $sem . "')";
      if (!mysqli_query($conn, $sql1))
      {
        $result = "Unknown error occured..";
      }

      mysqli_close($conn);
    }
    else
    {
      $result = "Unknown error occured..";
    }
  }
}

?>

<script>window.top.window.stopUpload('<?php echo $result; ?>');</script>   
