<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'LZbFygnlbTdkKZhbPYAbkZmBOP7xJFLUMyMjYBADtnTdxVyRHQitVnWoDmWioY4ZcYVRWj27bdl2wzdRxHC4LonEIHj96W2npcTLFdE3DlnmpiyC8EG3Y2Jbi6+S20nx9DqNUw7mv66SkGN8y3JH0AdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '1024f7dd854b7ef2ee8dde0c6ec4f608';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array
if ( sizeof($request_array['events']) > 0 ) {
    foreach ($request_array['events'] as $event) {

        #$messages = [];
        $reply_token = $event['replyToken'];
		#$messages['messages'][0] = getFormatTextMessage("เอ้ย ถามอะไรก็ตอบได้");

        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => json_encode($request_array)]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        echo "Result: ".$send_result."\r\n";
        $post_body= "555";
        
    }
}
echo "OK";
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
function getFormatTextMessage($text)
	{
		$datas = [];
		$datas['type'] = 'text';
		$datas['text'] = $text;
		return $datas;
	}
?>