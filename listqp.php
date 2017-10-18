<?php
$course = $_POST['course'];

if($course=="")
{
    exit("0");
}
$dir = "BitZoomQP/" . $course . "/";

if (!is_dir($dir)) {
    exit("0");
}

$ffs = scandir($dir);
echo "<button class=\"btn btn-primary\" onclick=\"showCoursesqp()\" style=\"margin: 20px\"><span class=\"glyphicon glyphicon-arrow-left\"></span> Back</button>
        <div class=\"table-title\">
        </div>
        <table class=\"table-fill\">
        <thead>
        <tr>
        <th class=\"text-center\">Filename</th>
        <th class=\"text-center\">Course ID</th>
        <th class=\"text-center\">Download</th>
        </tr>
        </thead>
        <tbody class=\"table-hover\">";

foreach($ffs as $ff)
    {
    if ($ff != '.' && $ff != '..')
        {
        if (is_dir($dir . '/' . $ff)) listFolderFiles($dir . '/' . $ff);

        $orig_ff = str_replace("[bitZoom]","",$ff);

        $ff = urlencode($ff);
        $ff = str_replace('@', '%40', $ff);
        $ff = str_replace('&', '%26', $ff);

        echo '<tr>
            <td class="text-left">' . $orig_ff;

        echo '</td> <td  class="text-left">' . $course . '</td><td class="text-center"><a href="downloadqp.php?file='.$ff.'&course='.$course.'" class="btn btn-success" style="vertical-align:middle"><span class="glyphicon glyphicon-download-alt"></span> Download</div></td></tr>';
        }
    }

echo "</tbody></table>";
?>