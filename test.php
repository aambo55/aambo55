<?php

   $text_select = 'foobarhow2pumpbaz';
   preg_match('/(how1)/', $text_select, $matches1, PREG_OFFSET_CAPTURE);
   preg_match('/(how2)/', $text_select, $matches2, PREG_OFFSET_CAPTURE);
   preg_match('/(how3)/', $text_select, $matches3, PREG_OFFSET_CAPTURE);

  // print_r($matches);
   if($matches1[0][0]=="how1"){
	 
	 print "how1";
     
   }
   elseif($matches2[0][0]=="how2"){
         
		 print "how2";
		 
     
   }
   elseif($matches3[0][0]=="how3"){
         
		 print "how3";
     
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
?>