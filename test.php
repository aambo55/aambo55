<?php
  $text = "Bin2,setting, 1,5 ,33;";
  preg_match("/^[B|b]in\D*/", $text,$data);
  print_r($data);
?>