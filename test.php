<?php

   preg_match('/(foo)(bar)(baz)(xxx)/', 'foobarxxxbaz', $matches, PREG_OFFSET_CAPTURE);

   foreach($matches as $val){
	      $i++;
          print $matches[$i][0]."<br>";
		 
   }

 //  print_r($matches)."<br>";
 /*  for($i = 0; $i < count($matches); $i++) {
        for($x = 0; $x < count($matches[$i]); $x++) {
          print $matches[$i][$x]."<br>";

		}
    }
	*/
?>