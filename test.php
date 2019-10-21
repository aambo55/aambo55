<?php

   preg_match('/(foo)(baz)(bar)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);

   print_r($matches);
/*
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