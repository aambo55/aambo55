<?php
  $text = "Bin2,11,22,33;";
  preg_match("/((^[B|b]in)\d.*)(;)/", $text,$data);

  print_r($data);
?>