<?php
  $text = "Bin2 on";
  preg_match("/(^[B|b]in)(\d).(on|off)/", $text,$data);

  print_r($data);
?>