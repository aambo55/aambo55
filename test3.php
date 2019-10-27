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
						       [text] => ) 
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




//default values of temperatures
char tempMin[3] = "18";
char tempMax[3] = "30";
float f_tempMin;
float f_tempMax;


float h = 0;
float t = 0;

f_tempMin = atof(tempMin);
f_tempMax = atof(tempMax);
    Serial.println("second location of f_tempMin and f_tempMax");
    Serial.println(f_tempMin);
    Serial.println(f_tempMax);
  }

}

void loop(void)
{

  int acquireresult;

  //read twice as the first result is cached from last time. suggested by @chaeplin
  delay(2000);
  DHT.acquireAndWait(100);
  delay(2000);
  acquireresult = DHT.acquireAndWait(100);

  if ( acquireresult == 0 ) {
    t = DHT.getCelsius();
    Serial.println(t);
    h = DHT.getHumidity();
    Serial.println(h);


    //----------------Buzzer Function--------
    Serial.println("second location of f_tempMin and f_tempMax");
    Serial.println(f_tempMin);
    Serial.println(f_tempMax);
    if (t < f_tempMin || t > f_tempMax)
    {
      Serial.println("Buzzer Öttü");
      for (int i = 0; i < 1; i++) {
        digitalWrite(buzzer, HIGH);
        Serial.println("BUZZ");
        delay(2000);
        digitalWrite(buzzer, LOW);
        delay(1000);
      }
    }
    //----------------------------------------
    Serial.println("DONE");
  } else {
    t = h = 0;
    Serial.println("Failed");

  }

?>