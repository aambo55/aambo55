<?php
      preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_PATTERN_ORDER);
 //  print_r($matches)."<br>";
   for ($i = 0; $i < count($matches); $i++) {
        for ($x = 0; $x < count($matches[$i]); $x++) {
          echo $matches[$i][$x];
		}
    }
?>

Array ( [0] => Array ( [0] => foobarbaz [1] => 0 ) [1] => Array ( [0] => foo [1] => 0 ) [2] => Array ( [0] => bar [1] => 3 ) [3] => Array ( [0] => baz [1] => 6 ) ) 