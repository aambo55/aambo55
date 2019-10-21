<?php

   $text_select = 'foobarhow1pumpbaz';
   preg_match('/(how1)/', $text_select, $matches, PREG_OFFSET_CAPTURE);

  // print_r($matches);
   if($matches[0][0]=="how1"){
	 preg_match('/(how2)/', $text_select, $matches, PREG_OFFSET_CAPTURE);
	 print "how1";

   }
   elseif($matches[0][0]=="how2"){
         preg_match('/(how3)/', $text_select, $matches, PREG_OFFSET_CAPTURE);
		 print "how2";
     
   }
   elseif($matches[0][0]=="how2"){
         preg_match('/(how3)/', $text_select, $matches, PREG_OFFSET_CAPTURE);
		 print "how2";
     
   }
 //  print $matches[0][0];
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
?>=