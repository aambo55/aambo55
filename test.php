<?php
  $text = "Bin2 restart;";
  preg_match("/((^[B|b][I|i][N|n])\d.*)(;)/", $text,$data);

  print_r($data);
?>