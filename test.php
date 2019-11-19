<?php
  $text = "Bin2 on";
  preg_match("/(^[B|b]in)(\d)(.on)/", $text,$data);

  print_r($data);
?>