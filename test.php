<?php

 $answertrue =array("aa","bb","cc","dd","ee","ff","gg","hh","ii","jj","kk","ll","mm");
     // �����ӵͺ
		$k=array_rand($answertrue);
		print $answertrue[$k];
/*
   $order_command '����觢ͧ�к�\n 1. ��ʶҹ� 1\n 2. �Դ���� 1(���� 2)\n  3. �Դ���� 1(���� 2)';
   $text_select = 'foobar�����umhowpbhow3az';
   preg_match('/(�����)/', $text_select, $matches1, PREG_OFFSET_CAPTURE);
   preg_match('/(�Ը���)/', $text_select, $matches2, PREG_OFFSET_CAPTURE);
   preg_match('/(�����ҹ)/', $text_select, $matches3, PREG_OFFSET_CAPTURE);
   
  // print_r($matches);
   if($matches1[0][0]=="�����"){
	 
	 print $order_command;
     
   }
   elseif($matches2[0][0]=="�Ը���"){
         
		 print $order_command;
		 
     
   }
   elseif($matches3[0][0]=="�����ҹ"){
         
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