<?php
  $text = "yyybin2,setting, 1,5 ,33ffgghh";
  preg_match("/((^[B|b]in\d).*)(;)/", $text,$data);
  print_r($data);
?>