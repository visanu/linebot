<?php

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$text =  $event['message']['text'];
			$qry_str = "?data=".($text)."&event=".$content;
			$ch = curl_init();

			// Set query data here with the URL
			curl_setopt($ch, CURLOPT_URL, urlencode('http://notify.moomnee.com/line_bot/echo_message.php' . $qry_str)); 

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 3);
			$content = trim(curl_exec($ch));
			curl_close($ch);
			
			$messages = [
			 'type' => 'text',
			 'text' => "sssf sdfs กฟหดหฟ"
			];
			$reply["to"] = "U1355bc358b90258582531ecb6172dc95"; 
			$reply["messages"][0] = $messages;
			putMessageLine($reply);
			
			function putMessageLine($line_msg){
			    $ch = curl_init( 'https://api.line.me/v2/bot/message/push' );
			    # Setup request to send json via POST.
			    $authorization = "Authorization: Bearer PmDddl8WuDAkEfXMn31RRp51mGKnckP1eQ/FicaegAdtDn8+6lqTl/+X3wp1yuYUSGGFw4AcFM64SqRmLBOERVxDJUh3EEGNZb2lzLvGIwyhaJOpyiDwZijKDdiotKRGK7Chf5QR+F3+v4wPgocg6wdB04t89/1O/w1cDnyilFU=";
			    $payload = json_encode( $line_msg );
			    //print_r($payload);
			    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
			    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json',$authorization));
			    # Return response instead of printing.
			    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			    # Send request.
			    $result = curl_exec($ch);
			    curl_close($ch);
			    //print_r($result);
			}

		}
	}
	
}
echo "OK";
?>
