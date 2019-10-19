<?php
$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'C37KqAyzCZVk/hEGnpkz2ztML1DbHJE7JQDC4l8+USFND54JAxPAA/TXHFiBl+utcYVRWj27bdl2wzdRxHC4LonEIHj96W2npcTLFdE3DlmB1OlkqhS5PSQDO2ngZQ4JUpyiPjt8sloCnNgJagz4DgdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '16f5d3687cdd2b8b7fd918380f84922a';
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);
$datas = file_get_contents('php://input');   // Get request content
$deCode = json_decode($datas, true);   // Decode JSON to Array
if ( sizeof($deCode['events']) > 0 ) {
    foreach ($deCode['events'] as $event) {
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];

		$messages = [];
	    $messages['replyToken'] = $replyToken;
	    $messages['messages'][0] = getFormatTextMessage("���� ������á�ͺ��");

        $data = [
            'replyToken' => $reply_token,
            // 'messages' => [['type' => 'text', 'text' => json_encode($deCode) ]]  Debug Detail message
               'messages' => [['type' => 'text', 'text' => $text ]]
            //'messages' => [['type' => 'text', 'text' => $text_reply ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        echo "Result: ".$send_result."\r\n";
		
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
?>