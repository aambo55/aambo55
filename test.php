<?php
   preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
 //  print_r($matches)."<br>";
   for($i = 0; $i < count($matches); $i++) {
	   print $i;
        for($x = 0; $x < count($matches[$i]); $x++) {
          print $matches[$i][$x];

		}
    }
?>