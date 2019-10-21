<?php
   preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
 //  print_r($matches)."<br>";

  foreach($matches as $val){
     //  print $val[$i][0]."<br>";
	   print $i."<br>";
	   $i++
       
   }
?>

Array ( [0] => Array ( [0] => foobarbaz [1] => 0 ) [1] => Array ( [0] => foo [1] => 0 ) [2] => Array ( [0] => bar [1] => 3 ) [3] => Array ( [0] => baz [1] => 6 ) ) 