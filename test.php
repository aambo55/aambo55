<?php
  $text = "Bin2,setting, 1,5 ,33;ffgghh";
  preg_match("/((^[B|b][I|i][N|n])\d.*)(;)/", $text,$data);
  if ($data[2} == '[B|b][I|i][N|n]'){
    print "rrr".$dat[2];
  }
  print_r($data);
?>