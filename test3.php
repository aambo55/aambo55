<?php
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
       // $arrayPostData['messages'][1]['type'] = "sticker";
      //  $arrayPostData['messages'][1]['packageId'] = "1";
      //  $arrayPostData['messages'][1]['stickerId'] = "131";

print_r($arrayPostData);
?>