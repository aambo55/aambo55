<?php
                 
		$data = [
			   'replyToken' => $replyToken,
		      //'messages' => [['type' => 'text', 'text' => json_encode($deCode) ]]  //Debug Detail message
		       'messages' => [['type' => 'text', 'text' => $text],['type' => 'sticker', 'packageId' => '1' , 'stickerId' => '131']]
        ];
/*
		Array ( [replyToken] => 
           [messages] => Array ( 
                         [0] => Array ( 
                                [type] => text 
                                [text] => ���ҷ�駡ѹ� )
                         [1] => Array ( 
                                [type] => sticker
                                [packageId] => 1
                                [stickerId] => 131 ) ) ) 


	    Array ( [replyToken] => 
            [messages] => Array (
                                                   [0] => Array ( 
                                                                     [type] => text 
                                                                     [text] => ���ҷ�駡ѹ� ) ) ) 

*/		
		$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
       // $arrayPostData['messages'][1]['type'] = "sticker";
      //  $arrayPostData['messages'][1]['packageId'] = "1";
      //  $arrayPostData['messages'][1]['stickerId'] = "131";

print_r($data);
?>