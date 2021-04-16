<?php
  $log_file_name = './recourses/ProgiIdeen.txt';
  $message = "";
  foreach($_POST as $i){
    if($i != "Mensch"){
      $message .= $i.PHP_EOL;
    }
  }
  file_put_contents($log_file_name, $message, FILE_APPEND);
  header("LOCATION:./sites/Hüttenstrasse/Map.html");
?>