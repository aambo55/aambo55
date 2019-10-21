<?php
   preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_PATTERN_ORDER);
 //  print_r($matches)."<br>";
   for ($i = 0; $i < count($matches); $i++) {
        for ($x = 0; $x < count($matches[$i]); $x++) {
          print $matches[$i][$x];

		}
    }
?>