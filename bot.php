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
			 'text' => $text
			];
			$reply["to"] = "U1355bc358b90258582531ecb6172dc95; 
			$reply["messages"][0] = $messages;
			putMessageLine($reply);

		}
	}
	
}
echo "OK";
?>
