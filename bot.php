<?php
require("phpMQTT.php");
$server = "m11.cloudmqtt.com";     // change if necessary
$port = 16214;                     // change if necessary
$username = "beantemp";                   // set your username
$password = "rukyonaja13";                   // set your password
$client_id = "phpMQTT-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()
$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'C37KqAyzCZVk/hEGnpkz2ztML1DbHJE7JQDC4l8+USFND54JAxPAA/TXHFiBl+utcYVRWj27bdl2wzdRxHC4LonEIHj96W2npcTLFdE3DlmB1OlkqhS5PSQDO2ngZQ4JUpyiPjt8sloCnNgJagz4DgdB04t89/1O/w1cDnyilFU='; 
//$channelSecret = 'xxxxxxxxxxxxxxxxxxx';
$POST_HEADER = array('Content-Type: application/json; charset=UTF-8','cache-control: no-cache', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$datas = file_get_contents('php://input');   // Get request content
$deCode = json_decode($datas, true);   // Decode JSON to Array

$text_wrong = '����觤�� "�Դ����1" ���� "�Դ����2"';
$text_open1 = "�Դ�����ѧ��� 1 ����";            
			
			
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
       
        if (preg_match("/(^[B|b]in)(\d).(on|off)/", $text,$dataon)){
          if($dataon[1] == "Bin" || $dataon[1] == "bin"){
            $dataon[1] = "Bin".$dataon[2]." ".$dataon[3];
		    if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/temp", $dataon[1], 0);
	              $mqtt->close();
            } else {
                   $text_reply = "\n�������ö�觤������!\n";				   
            }
		  }
        }
		if (preg_match("/Open all/", $text)) {  
		if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/temp", "Open all", 0);
	              $mqtt->close();
        } else {
                   $text_reply = "\n�������ö�觤������!\n";
        }
		}
       if (preg_match("/Close all/", $text)) {  
		if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/temp", "Close all", 0);
	              $mqtt->close();
        } else {
                   $text_reply = "\n�������ö�觤������!\n";
        }
		}
		if (preg_match("/^Status/", $text) || preg_match("/^status/", $text)) {  
		if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/temp", "sta", 0);
	              $mqtt->close();
        } else {
                   $text_reply = "\n�������ö�觤������!\n";
        }
		}
		if (preg_match("/(^[B|b]in)(\d).(status)/", $text,$datasta)) { 
		  if($datasta[1] == "Bin" || $datasta[1] == "bin"){
			$datasta[1] = "Bin".$datasta[2]." ".$datasta[3];
		    if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/temp", $datasta[1], 0);
	              $mqtt->close();
            } else {
                   $text_reply = "\n�������ö�觤������!\n";
            }
		  }
        }
		if (preg_match("/(^[B|b]in)(\d)(.*)(;)/", $text,$datasave)){
		  if($datasave[4] == ";"){
             if($datasave[1] == "Bin" || $datasave[1] == "bin"){
				   $datasave[1] = "Bin".$datasave[2].$datasave[3];
                   if ($mqtt->connect(true, NULL, $username, $password)) {
	                       $mqtt->publish("/temp", $datasave[1], 0);
	                       $mqtt->close();
                   } else {
                           $text_reply = "\n�������ö�觤������!\n";
                   }
			   }
	      }
		}
	    if (preg_match("/(^[B|b]in)(\d).([R|r]estart)(;)/", $text,$drestart)) {  
		    if ($mqtt->connect(true, NULL, $username, $password)) {
	              $mqtt->publish("/temp", "Bin".$drestart[2]." restart", 0);
	              $mqtt->close();
            } else {
                   $text_reply = "\n�������ö�觤������!\n";
            }
        }
		
 /*   // ���ǹ�������� ����ǹ�����  subscribe data �� mqtt

		 if(!$mqtt->connect(true, NULL, $username, $password)) {
               	exit(1);
        }
        $topics['/temp'] = array("qos" => 0, "function" => "procmsg");
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
        //�ŧ���������������������������º��º��
		
        if($text_reply == ''){ $text_reply = how_control($text);  } //�͡�Ըա����觧ҹ
        if($text_reply == ''){ $text_reply = yes_no_message($text); }//�ͺ��Ѻ����¤����դ���� �����
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

function how_control($text)
{
   $check_order ='';
   $text_select = '';
   $order_command = "\n�����觧ҹ�к� ����������觵����ͤ�����ҹ��ҧ  \n 1. Status  \n 2. Bin1 on/off \n 3. Bin2 on/off \n 4. Close all  \n 5. Open all";
   $order_command = $order_command."\n\n***ConFig System**";
   $order_command = $order_command."\n1: bin[num],wifi,[ssid],[pass];";
   $order_command = $order_command."\n2: bin[num],line,[line token];";
   $order_command = $order_command."\n3: bin[num],setting,[Hrs],[min],[�C];";
   $order_command = $order_command."\n4: bin[num],blynk,[token],[server],[port];";
   $order_command = $order_command."\n5: bin[num],mqtt,[server],[user],[pass],[port];";
   $order_command = $order_command."\n6: bin[num] restart;";
   $text_select = $text;
   preg_match('/(�����)/', $text_select, $matches1, PREG_OFFSET_CAPTURE);
   preg_match('/(�Ը���)/', $text_select, $matches2, PREG_OFFSET_CAPTURE);
   preg_match('/(Command)/', $text_select, $matches3, PREG_OFFSET_CAPTURE);
   
  // print_r($matches);
   if($matches1[0][0]=="�����"){
	 
	 $check_order = '1';
     
   }
   elseif($matches2[0][0]=="�Ը���"){
         
		 $check_order = '1';
		    
   }
   elseif($matches3[0][0]=="Command"){
         
		 $check_order = '1';
     
   }
   if($check_order == '1'){
	    $text_reply = $order_command;
   }

   return $text_reply;

}
function yes_no_message($text)
{
     //��С�� Array �Ӥͺ
        $answeryes =array("���Ѻ","�������ҡѺ�����","��������","�������","�ʹ����ͺ��͡��Ѻ","��ҧ�ҡ����","������","�����","�������","�������","��ѹ���","���������");
		$answertrue =array("��ԧ��Ѻ","��ԧ �����","��������","�������","�ʹ����ͺ��͡��Ѻ","��ҧ�ҡ����","��ԧ����͹","������ͧ��ԧ","�������","�������","��ԧ�������","��ԧ�Ԩ��","����ԧ��");
     // �����ӵͺ
		
		$text_select = '';
		$check_order ='';
        //���Ҥӷ���ͧ��è���ͺ
        $text_select = $text;
        preg_match('/(�����)/', $text_select, $matches1, PREG_OFFSET_CAPTURE);
        preg_match('/(������)/', $text_select, $matches2, PREG_OFFSET_CAPTURE);
        preg_match('/(��ԧ���)/', $text_select, $matches3, PREG_OFFSET_CAPTURE);
		preg_match('/(��ԧ����)/', $text_select, $matches4, PREG_OFFSET_CAPTURE);
   
        // print_r($matches);
        if($matches1[0][0]=="�����"){
	        $k = array_rand($answeryes);
	        $check_order = '1';
     
        }
        elseif($matches2[0][0]=="������"){
            $k = array_rand($answeryes);
		    $check_order = '1';
		    
        }
        elseif($matches3[0][0]=="��ԧ���"){
            $y = array_rand($answertrue);
		    $check_order = '2';
     
        }
		elseif($matches4[0][0]=="��ԧ����"){
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
	          //��ͤ��� + ʵԡ����
		      //'messages' => [['type' => 'text', 'text' => $text],['type' => 'sticker', 'packageId' => '11539' , 'stickerId' => '52114123']]
			  'messages' => [['type' => 'text', 'text' => $text]]
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