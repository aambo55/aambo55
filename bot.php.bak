<?php
require("phpMQTT.php");
$server = "m11.cloudmqtt.com";     // change if necessary
$port = 16214;                     // change if necessary
$username = "aambo55";                   // set your username
$password = "rukyonaja13";                   // set your password
$client_id = "phpMQTT-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()
$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'C37KqAyzCZVk/hEGnpkz2ztML1DbHJE7JQDC4l8+USFND54JAxPAA/TXHFiBl+utcYVRWj27bdl2wzdRxHC4LonEIHj96W2npcTLFdE3DlmB1OlkqhS5PSQDO2ngZQ4JUpyiPjt8sloCnNgJagz4DgdB04t89/1O/w1cDnyilFU='; 
//$channelSecret = 'xxxxxxxxxxxxxxxxxxx';
$POST_HEADER = array('Content-Type: application/json; charset=UTF-8','cache-control: no-cache', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$datas = file_get_contents('php://input');   // Get request content
$deCode = json_decode($datas, true);   // Decode JSON to Array

$text_wrong = 'คำสั่งคือ "เปิดปั๊ม1" หรือ "เปิดปั๊ม2"';
$text_open1 = "เปิดปั๊มถังที่ 1 แล้ว";            
			
			
$text_wrong = iconv("tis-620","utf-8",$text_wrong);
$text_open1 = iconv("tis-620","utf-8",$text_wrong);

// Test Code Zone
//{"events":[{"type":"message","replyToken":"254f2da0a8d5454cb5023f5aa0bb862b","source":{"userId":"U8ec1d38548c43fb44dd07b90df4ac427","type":"user"},"timestamp":1571539105278,"message":{"type":"text","id":"10771871390735","text":"\u0e43\u0e0a\u0e48\u0e40\u0e2b\u0e23\u0e2d"}}],"destination":"Ub7cffc449b3567dd78a3b1b8b58555d7"}

//Array ( [userId] => U8ec1d38548c43fb44dd07b90df4ac427 [displayName] => Karaket Saefung [pictureUrl] => https://profile.line-scdn.net/0hSjj7sgVEDEVXTie7ridzEmsLAiggYAoNL3hHI3dKWnEtKRhDYi0Tc3dIV31zdx5GPyBAKiZHVSBy [result] => E )

/*

}*/
//End test zone

if ( sizeof($deCode['events']) > 0 ) {
    foreach ($deCode['events'] as $event) {
        $reply_message = '';
		$text_reply = '';
        $replyToken = $event['replyToken'];
        $text = $event['message']['text'];
		$text = iconv("utf-8","tis-620",$text);

		//Get user Profile 
		$userId = $event['source']['userId'];
        $LINEDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
        $LINEDatas['token'] = $ACCESS_TOKEN;
        $idname = getLINEProfile($LINEDatas); 


		//*************************************
       
        if (preg_match("/Led1 on/", $text)) {  
		if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/message", "Led1 on", 0);
	              $mqtt->close();
        } else {
                   echo "Time out!\n";
        }
        }
		if (preg_match("/Led1 off/", $text)) {  
		if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/message", "Led1 off", 0);
	              $mqtt->close();
        } else {
                   echo "Time out!\n";
        }
		}
		if (preg_match("/Led2 off/", $text)) {  
		if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/message", "Led2 off", 0);
	              $mqtt->close();
        } else {
                   echo "Time out!\n";
        }
		}
		if (preg_match("/Led2 on/", $text)) {  
		if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/message", "Led2 on", 0);
	              $mqtt->close();
        } else {
                   echo "Time out!\n";
        }
        }
 /*   // ในส่วนที่คอมเม้น เป็นส่วนที่ใช้  subscribe data บน mqtt

		 if(!$mqtt->connect(true, NULL, $username, $password)) {
               	exit(1);
        }
        $topics['/message'] = array("qos" => 0, "function" => "procmsg");
        $mqtt->subscribe($topics, 0);
        while($mqtt->proc()){
		
        }
        $mqtt->close();
        function procmsg($topic, $msg){
		//echo "Msg Recieved: " . date("r") . "\n";
		//echo "Topic: {$topic}\n\n";
		$text_reply = "\t$msg\n\n";
        }
*/
        //แปลงรหัสให้เพื่อให้โปรแกรมเอามาเปรียบเทียบได้
		
        if($text_reply == ''){ $text_reply = how_control($text);  } //บอกวิธีการสั่งงาน
		if($text_reply == ''){ $text_reply = system_status($text);  } //แจ้งสถานะการทำงานของระะบบ
		if($text_reply == ''){ $text_reply = system_controll($text);  } //สั่งให้ระบบทำงาน
        if($text_reply == ''){ $text_reply = yes_no_message($text); }//ตอบกลับประโยคที่มีคำว่า ใช่ไหม
		if($text_reply <> ''){
		   $text_reply= iconv("tis-620","utf-8",$text_reply);
           $text = $idname['displayName']." ".$text_reply;

          // $text = $userId; //Debug userID
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $replyToken, $text);
            echo "Result: ".$send_result."\r\n";
		}

     }
}

echo "<br> OK <br>";

function system_controll($text)
{
   $check_order ='';
   $text_select = '';
   $temp_status = "xxx";
   $moisture_status = "yyy";
   $bin1_on = "on";
   $bin1_off = "off";
   $bin2_on = "on";
   $bin2_off = "off";
   $order_command = "\nการสั่งงานระบบ ให้พิมพ์คำสั่งตามข้อความด้านล่าง  \n 1. แจ้งสถานะ   \n 2. เปิดปั๊ม 1(หรือ 2) \n 3. ปิดปั๊ม 1(หรือ  2) \n 4. ปิดปั๊มทั้งหมด  \n 5. เปิดปั๊มทั้งหมด)";
   $text_status = "\nสถานะของระบบปัจจุบัน\n อุณหถูมิ : ".$temp_status." ํC\n ความชื้น RH : ".$moisture_status."%\n"." สถานะปั๊มน้ำถังที่ 1 : ".$bin1_status."\n สถานะปั๊มน้ำถังที่ 2 : ".$bin2_status;
   $text_select = $text;
   

   preg_match('/(เปิดปั๊ม)/', $text_select, $pump_wrong1, PREG_OFFSET_CAPTURE);
   preg_match('/(ปิดปั๊ม)/', $text_select, $pump_wrong2, PREG_OFFSET_CAPTURE);
   //ค้นหาคำเปิดปิดปั๊ม 1
   preg_match('/(เปิดปั๊ม1)/', $text_select, $pump1_1, PREG_OFFSET_CAPTURE);
   preg_match('/(เปิดปั๊ม 1)/', $text_select, $pump1_2, PREG_OFFSET_CAPTURE);
   preg_match('/(pump 1 on)/', $text_select, $pump1_3, PREG_OFFSET_CAPTURE);
   preg_match('/(pump 1 off)/', $text_select, $pump1_4, PREG_OFFSET_CAPTURE);
   preg_match('/(ปิดปั๊ม1)/', $text_select, $pump1_5, PREG_OFFSET_CAPTURE);
   preg_match('/(ปิดปั๊ม 1)/', $text_select, $pump1_6, PREG_OFFSET_CAPTURE);

   //ค้นหาคำเปิดปิดปั๊ม 2
   preg_match('/(เปิดปั๊ม2)/', $text_select, $pump2_1, PREG_OFFSET_CAPTURE);
   preg_match('/(เปิดปั๊ม 2)/', $text_select, $pump2_2, PREG_OFFSET_CAPTURE);
   preg_match('/(pump 2 on)/', $text_select, $pump2_3, PREG_OFFSET_CAPTURE);
   preg_match('/(pump 2 off)/', $text_select, $pump2_4, PREG_OFFSET_CAPTURE);
   preg_match('/(ปิดปั๊ม2)/', $text_select, $pump2_5, PREG_OFFSET_CAPTURE);
   preg_match('/(ปิดปั๊ม 2)/', $text_select, $pump2_6, PREG_OFFSET_CAPTURE);

   //เปิดปิดปั๊มทุกตัว
   preg_match('/(pump all on)/', $text_select, $pump12_1, PREG_OFFSET_CAPTURE);
   preg_match('/(เปิดปั๊มทั้งหมด)/', $text_select, $pump12_2, PREG_OFFSET_CAPTURE);
   preg_match('/(ปิดปั๊มทั้งหมด)/', $text_select, $pump12_3, PREG_OFFSET_CAPTURE);
   preg_match('/(pump all off)/', $text_select, $pump12_4, PREG_OFFSET_CAPTURE);
   
  // print_r($matches);
   //ปั๊ม 1 เปิด
   if($pump1_1[0][0]=="เปิดปั๊ม1"){ $text_reply = "\nเปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_on.$text_status; }
   elseif($pump1_2[0][0]=="เปิดปั๊ม 1"){ $text_reply = "\nเปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_on.$text_status; }
   elseif($pump1_3[0][0]=="pump 1 on"){ $text_reply = "\nเปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_on.$text_status; }
   //ปั๊ม 1 ปิด
   elseif($pump1_4[0][0]=="pump 1 off"){ $text_reply = "\nปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_off.$text_status; }
   elseif($pump1_5[0][0]=="ปิดปั๊ม1"){ $text_reply = "\nปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_off.$text_status; }
   elseif($pump1_6[0][0]=="ปิดปั๊ม 1"){ $text_reply = "\nปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_off.$text_status; }
   //ปั๊ม 2 เปิด
   elseif($pump2_1[0][0]=="เปิดปั๊ม2"){ $text_reply = "\nเปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_on.$text_status; }
   elseif($pump2_2[0][0]=="เปิดปั๊ม 2"){ $text_reply = "\nเปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_on.$text_status; }
   elseif($pump2_3[0][0]=="pump 2 on"){ $text_reply = "\nเปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_on.$text_status; }
   //ปั๊ม 2 ปิด
   elseif($pump2_4[0][0]=="pump 2 off"){ $text_reply = "\nปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_off.$text_status; }
   elseif($pump2_5[0][0]=="ปิดปั๊ม2"){ $text_reply = "\nปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_off.$text_status; }
   elseif($pump2_6[0][0]=="ปิดปั๊ม 2"){ $text_reply = "\nปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_off.$text_status; }
   //เปิดปั๊มทุกตัว
   elseif($pump12_1[0][0]=="pump all on"){ $text_reply = "\nเปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_on."\n"."เปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_on.$text_status; }
   elseif($pump12_2[0][0]=="เปิดปั๊มทั้งหมด"){ $text_reply = "\nเปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_on."\n"."เปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_on.$text_status; }
   //ปิดปั๊มทุกตัว
   elseif($pump12_3[0][0]=="ปิดปั๊มทั้งหมด"){ $text_reply = "\nปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_off."\n"."ปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_off.$text_status; }
   elseif($pump12_4[0][0]=="pump all off"){ $text_reply = "\nปิดปั๊ม 1 แล้ว สถานะ : ".$bin1_off."\n"."ปิดปั๊ม 2 แล้ว สถานะ : ".$bin2_off.$text_status; }
   //สั่งผิด
   elseif($pump_wrong1[0][0]=="เปิดปั๊ม"){ $text_reply = $order_command; }
   elseif($pump_wrong2[0][0]=="ปิดปั๊ม"){ $text_reply = $order_command; }


   return $text_reply;

}
function system_status($text)
{
   $check_order ='';
   $text_select = '';
   $temp_status = "xxx";
   $moisture_status = "yyy";
   $bin1_status = "on";
   $bin2_status = "off";
   $text_status = "\nสถานะของระบบปัจจุบัน\n อุณหถูมิ : ".$temp_status." ํC\n ความชื้น RH : ".$moisture_status."%\n"." สถานะปั๊มน้ำถังที่ 1 : ".$bin1_status."\n สถานะปั๊มน้ำถังที่ 2 : ".$bin2_status;
   $text_select = $text;
   preg_match('/(แจ้งสถานะ)/', $text_select, $matches1, PREG_OFFSET_CAPTURE);
   preg_match('/(แจ้ง สถานะ)/', $text_select, $matches2, PREG_OFFSET_CAPTURE);
   preg_match('/(status)/', $text_select, $matches3, PREG_OFFSET_CAPTURE);
   
  // print_r($matches);
   if($matches1[0][0]=="แจ้งสถานะ"){
	 
	 $check_order = '1';
     
   }
   elseif($matches2[0][0]=="แจ้ง สถานะ"){
         
		 $check_order = '1';
		    
   }
   elseif($matches3[0][0]=="status"){
         
		 $check_order = '1';
     
   }
   if($check_order == '1'){
	    $text_reply = $text_status;
   }

   return $text_reply;

}

function how_control($text)
{
   $check_order ='';
   $text_select = '';
   $order_command = "\nการสั่งงานระบบ ให้พิมพ์คำสั่งตามข้อความด้านล่าง  \n 1. แจ้งสถานะ   \n 2. เปิดปั๊ม 1(หรือ 2) \n 3. ปิดปั๊ม 1(หรือ  2) \n 4. ปิดปั๊มทั้งหมด  \n 5. เปิดปั๊มทั้งหมด)";
   $text_select = $text;
   preg_match('/(คำสั่ง)/', $text_select, $matches1, PREG_OFFSET_CAPTURE);
   preg_match('/(วิธีใช้)/', $text_select, $matches2, PREG_OFFSET_CAPTURE);
   preg_match('/(การใช้งาน)/', $text_select, $matches3, PREG_OFFSET_CAPTURE);
   
  // print_r($matches);
   if($matches1[0][0]=="คำสั่ง"){
	 
	 $check_order = '1';
     
   }
   elseif($matches2[0][0]=="วิธีใช้"){
         
		 $check_order = '1';
		    
   }
   elseif($matches3[0][0]=="การใช้งาน"){
         
		 $check_order = '1';
     
   }
   if($check_order == '1'){
	    $text_reply = $order_command;
   }

   return $text_reply;

}
function yes_no_message($text)
{
     //ประกาศ Array คำคอบ
        $answeryes =array("ใช่ครับ","ใช่ๆเห็นมากับตาเลย","ไม่แน่ใจอะ","ไม่รู้ซิ","พอดีไม่ชอบเผือกครับ","ว่างมากเหรอ","ใช่แล้ว","ใช่เลย","มั่วแระ","แม่นแล้ว","หมันเลย","ใช่แล้วไงอะ");
		$answertrue =array("จริงครับ","จริง เคยเห็น","ไม่แน่ใจอะ","ไม่รู้ซิ","พอดีไม่ชอบเผือกครับ","ว่างมากเหรอ","จริงแท้แน่นอน","เป็นเรื่องจริง","มั่วแระ","แม่นแล้ว","จริงแล้วไงอะ","จริงซิจ๊ะ","ไม่จริงอะ");
     // สุ่มคำตอบ
		
		$text_select = '';
		$check_order ='';
        //ค้นหาคำที่ต้องการจะโต้ตอบ
        $text_select = $text;
        preg_match('/(ใช่ไหม)/', $text_select, $matches1, PREG_OFFSET_CAPTURE);
        preg_match('/(ใช่เหรอ)/', $text_select, $matches2, PREG_OFFSET_CAPTURE);
        preg_match('/(จริงไหม)/', $text_select, $matches3, PREG_OFFSET_CAPTURE);
		preg_match('/(จริงเหรอ)/', $text_select, $matches4, PREG_OFFSET_CAPTURE);
   
        // print_r($matches);
        if($matches1[0][0]=="ใช่ไหม"){
	        $k = array_rand($answeryes);
	        $check_order = '1';
     
        }
        elseif($matches2[0][0]=="ใช่เหรอ"){
            $k = array_rand($answeryes);
		    $check_order = '1';
		    
        }
        elseif($matches3[0][0]=="จริงไหม"){
            $y = array_rand($answertrue);
		    $check_order = '2';
     
        }
		elseif($matches4[0][0]=="จริงเหรอ"){
            $y = array_rand($answertrue);
		    $check_order = '2';
     
        }
        if($check_order == '1'){
	        $text_reply = $answeryes[$k];
        }
		elseif($check_order == '2'){
		    $text_reply = $answertrue[$y];
		}

   return $text_reply;

}
function send_reply_message($url, $post_header, $replyToken, $text)
{
    $data = [
			   'replyToken' => $replyToken,
		      //'messages' => [['type' => 'text', 'text' => json_encode($deCode) ]]  //Debug Detail message
		       'messages' => [['type' => 'text', 'text' => $text],['type' => 'sticker', 'packageId' => '1' , 'stickerId' => '131']]
    ];

    $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
	$ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function getLINEProfile($datas)
{
   $datasReturn = [];
   $curl = curl_init();   curl_setopt_array($curl, array(
     CURLOPT_URL => $datas['url'],
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "GET",
     CURLOPT_HTTPHEADER => array(
       "Authorization: Bearer ".$datas['token'],
       "cache-control: no-cache"
     ),
   ));   $response = curl_exec($curl);
   $err = curl_error($curl);   curl_close($curl);   if($err){
      $datasReturn['result'] = 'E';
      $datasReturn['message'] = $err;
   }else{
      if($response == "{}"){
          $datasReturn['result'] = 'S';
          $datasReturn['message'] = 'Success';
      }else{
		$datasReturn = json_decode($response, true);
        $datasReturn['result'] = 'E';
        //  $datasReturn['message'] = $response;
		
		 
      }
   }   return $datasReturn;
}


?>