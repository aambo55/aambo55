<?php
  $text = "Bin2 restart;";
  preg_match("/((^[B|b]in(\d))*([R|r]estart)(;)/", $text,$data);

  print_r($data);
?>