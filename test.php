<?php
  $text = "Bin2,setting, 1,5 ,33;";
  $data = preg_match("/^Bin\D*/", $text);
  print_r($data);
?>