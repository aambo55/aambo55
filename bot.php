<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'C37KqAyzCZVk/hEGnpkz2ztML1DbHJE7JQDC4l8+USFND54JAxPAA/TXHFiBl+utcYVRWj27bdl2wzdRxHC4LonEIHj96W2npcTLFdE3DlmB1OlkqhS5PSQDO2ngZQ4JUpyiPjt8sloCnNgJagz4DgdB04t89/1O/w1cDnyilFU='; 
//$channelSecret = 'xxxxxxxxxxxxxxxxxxx';
$POST_HEADER = array('Content-Type: application/json; charset=UTF-8','cache-control: no-cache', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$datas = file_get_contents('php://input');   // Get request content
$deCode = json_decode($datas, true);   // Decode JSON to Array
$answer =array("ใช่ครับ","ใช่ๆเห็นมากับตาเลย","ไม่แน่ใจอะ","ไม่รู้ซิ","พอดีไม่ชอบเผือกครับ","ว่างมากเหรอ","ใช่แล้ว","ใช่เลย","มั่วแระ","แม่นแล้ว","หมันเลย","ใช่แล้วไงอะ");
if ( sizeof($deCode['events']) > 0 ) {
    foreach ($deCode['events'] as $event) {
        $reply_message = '';
        $replyToken = $event['replyToken'];
        $text = $event['message']['text'];

		$random_keys = array_rand($answer);

		$text_reply= iconv("tis-620","utf-8",$answer[$random_keys]); 
        $text = iconv("utf-8","tis-620",$text); 
        
       // $html = "ขี้เหร่ใช่ไหม";
        preg_match_all("/(ใช่ไหม)/", $text, $matches, PREG_SET_ORDER);

        foreach ($matches as $val) {
              $text = $val[0];
        }

       //print $text;

		if($text == "ใช่ไหม"){
           $text = $text_reply;

			$data = [
			   'replyToken' => $replyToken,
		     // 'messages' => [['type' => 'text', 'text' => json_encode($deCode) ]]  Debug Detail message
		       'messages' => [['type' => 'text', 'text' => $text ]]
            ];
            $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
            $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
            echo "Result: ".$send_result."\r\n";
		}

	//	else {

     //      $text = "fff";   
	//	}
    }
}
echo "OK <br>";

function send_reply_message($url, $post_header, $post_body)
{
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
?>