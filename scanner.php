<?php
    session_start();
    if(isset($_SESSION['id'])){
        $dir    = "BitZoom/";
        $all_dir = scandir($dir);
        $a=array();
        foreach ($all_dir as $key => $value) {
            if($key<2||!is_dir($dir.$value))
                continue;
            array_push($a,$value);
        }
        $files = array();
        foreach ($a as $key => $value) {
            $file1 = scandir($dir.$value);
            foreach ($file1 as $key1 => $value1) {
                if($key1<2)
                    continue;
                $value = str_replace("'", ' ',$value);
                $value1 = str_replace("'", ' ',$value1);
                $files[$value1] = $value;
            }
        }
        $js_array = json_encode($files);
        echo $js_array;
    }
    else{
        echo "";
    }
?>