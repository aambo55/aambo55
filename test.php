<?php

 $answertrue =array("aa","bb","cc","dd","ee","ff","gg","hh","ii","jj","kk","ll","mm");
     // สุ่มคำตอบ
		$k=array_rand($answertrue);
		print $answertrue[$k];
/*
   $order_command 'คำสั่งของระบบ\n 1. แจ้งสถานะ 1\n 2. เปิดปั๊ม 1(หรือ 2)\n  3. ปิดปั๊ม 1(หรือ 2)';
   $text_select = 'foobarคำสั่งumhowpbhow3az';
   preg_match('/(คำสั่ง)/', $text_select, $matches1, PREG_OFFSET_CAPTURE);
   preg_match('/(วิธีใช้)/', $text_select, $matches2, PREG_OFFSET_CAPTURE);
   preg_match('/(การใช้งาน)/', $text_select, $matches3, PREG_OFFSET_CAPTURE);
   
  // print_r($matches);
   if($matches1[0][0]=="คำสั่ง"){
	 
	 print $order_command;
     
   }
   elseif($matches2[0][0]=="วิธีใช้"){
         
		 print $order_command;
		 
     
   }
   elseif($matches3[0][0]=="การใช้งาน"){
         
		 print $order_command;
     
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