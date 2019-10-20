<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'C37KqAyzCZVk/hEGnpkz2ztML1DbHJE7JQDC4l8+USFND54JAxPAA/TXHFiBl+utcYVRWj27bdl2wzdRxHC4LonEIHj96W2npcTLFdE3DlmB1OlkqhS5PSQDO2ngZQ4JUpyiPjt8sloCnNgJagz4DgdB04t89/1O/w1cDnyilFU='; 
//$channelSecret = 'xxxxxxxxxxxxxxxxxxx';
$POST_HEADER = array('Content-Type: application/json; charset=UTF-8','cache-control: no-cache', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$datas = file_get_contents('php://input');   // Get request content
$deCode = json_decode($datas, true);   // Decode JSON to Array
//ประกาศ Array คำคอบ
$answer =array("ใช่ครับ","ใช่ๆเห็นมากับตาเลย","ไม่แน่ใจอะ","ไม่รู้ซิ","พอดีไม่ชอบเผือกครับ","ว่างมากเหรอ","ใช่แล้ว","ใช่เลย","มั่วแระ","แม่นแล้ว","หมันเลย","ใช่แล้วไงอะ");
$text_wrong = 'คำสั่งคือ "เปิดปั๊ม1" หรือ "เปิดปั๊ม2"';
$text_open1 = "เปิดปั๊มถังที่ 1 แล้ว";            
			
			
$text_wrong = iconv("tis-620","utf-8",$text_wrong);
$text_open1 = iconv("tis-620","utf-8",$text_wrong);

// Test Code Zone
//{"events":[{"type":"message","replyToken":"254f2da0a8d5454cb5023f5aa0bb862b","source":{"userId":"U8ec1d38548c43fb44dd07b90df4ac427","type":"user"},"timestamp":1571539105278,"message":{"type":"text","id":"10771871390735","text":"\u0e43\u0e0a\u0e48\u0e40\u0e2b\u0e23\u0e2d"}}],"destination":"Ub7cffc449b3567dd78a3b1b8b58555d7"}

//Array ( [userId] => U8ec1d38548c43fb44dd07b90df4ac427 [displayName] => Karaket Saefung [pictureUrl] => https://profile.line-scdn.net/0hSjj7sgVEDEVXTie7ridzEmsLAiggYAoNL3hHI3dKWnEtKRhDYi0Tc3dIV31zdx5GPyBAKiZHVSBy [result] => E )

$text5 ="swdedaafer";
preg_match_all("/(ใช่ไหม)(ใช่เหรอ)(aa)(bb)(cc)(1)(2)/", $text5, $matches, PREG_SET_ORDER);
print_r($matches);
foreach ($matches as $val) {
              //$text = $val[0];
			  

			  if($val == "ใช่ไหม"){
				  $text = $val;
              }
			  elseif($val == "aa"){
                 $text1_1 = $val;
			  }else{}

               $i++;
}
		print $text1_1."<BR>";
/*

}*/
//End test zone

if ( sizeof($deCode['events']) > 0 ) {
    foreach ($deCode['events'] as $event) {
        $reply_message = '';
        $replyToken = $event['replyToken'];
        $text = $event['message']['text'];

		//Get user Profile 
		$userId = $event['source']['userId'];
        $LINEDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
        $LINEDatas['token'] = $ACCESS_TOKEN;
        $idname = getLINEProfile($LINEDatas); 


		//*************************************
        // สุ่มคำตอบ
		$random_keys = array_rand($answer);
        //แปลงรหัสให้เพื่อให้โปรแกรมเอามาเปรียบเทียบได้
		$text_reply= iconv("tis-620","utf-8",$answer[$random_keys]); 
        $text = iconv("utf-8","tis-620",$text); 
       //ค้นหาคำที่ต้องการจะโต้ตอบ
        preg_match_all("/(ใช่ไหม)(ใช่เหรอ)(aa)(bb)(cc)(1)(2)/", $text, $matches, PREG_SET_ORDER);

        foreach ($matches as $val) {
              //$text = $val[0];
			  

			  if($val[$i] == "ใช่ไหม"){
				  $text = $val[$i];
              }
			  elseif($val[$i] == "aa"){
                 $text1_1 = $val[$i];
			  }
			  elseif($val[$i] == "bb"){
                 $text1_2= $val[$i];
			  }
              elseif($val[$i] == "cc"){
                 $text1_3= $val[$i];
			  }
			  elseif($val[$i] == "1"){
                 $text2_1= $val[$i];
			  }
			  elseif($val[$i] == "2"){
                 $text2_2= $val[$i];
			  }
               $i++;
        }
		$text1_1="aa";
/*		//$text1 = ปั๊ม 1 เปิด
        $text1= $text1_1.$text2_1.$text1_2;
		//$text2 = ปั๊ม 1 ปิด
		$text2= $text1_1.$text2_1.$text1_3;

        //$text3 = ปั๊ม 2 เปิด
		$text3= $text1_1.$text2_2.$text1_2;
		//$text4 = ปั๊ม 2 ปิด
		$text4= $text1_1.$text2_2.$text1_3;
        $text1 = iconv("utf-8","tis-620",$text1); 
		$text2 = iconv("utf-8","tis-620",$text2); 
       //print $text;
*/

		if($text == "ใช่ไหม" || $text == "ใช่เหรอ" ){
           $text = "@".$idname['displayName']." ".$text_reply;

          // $text = $userId; //Debug userID
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $replyToken, $text);
            echo "Result: ".$send_result."\r\n";
		}
		if($text1_1 == "aa"){
			$text1_1 = iconv("tis-620","utf-8",$text1_1);
            $text_reply = $text1_1;
			    
            $text = $text_reply;
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $replyToken, $text);
            echo "Result: ".$send_result."\r\n";
		}
/*		elseif($text1 == "ปั๊มเปิด" || $text2 == "ปั๊มปิด" ){

            
			$text_reply = $text_wrong;
			    
            $text = "@".$idname['displayName']." ".$text_reply;
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $replyToken, $text);
            echo "Result: ".$send_result."\r\n";
		}
        elseif($text1 == "ปั๊ม1เปิด"){
		    $text_reply = $text_open1;
			    
            $text = "@".$idname['displayName']." ".$text_reply;
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $replyToken, $text);
            echo "Result: ".$send_result."\r\n";
		}
		*/
     }
}
echo "OK <br>";
        

function send_reply_message($url, $post_header, $replyToken, $text)
{
    $data = [
			   'replyToken' => $replyToken,
		      //'messages' => [['type' => 'text', 'text' => json_encode($deCode) ]]  //Debug Detail message
		       'messages' => [['type' => 'text', 'text' => $text ]]
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