<?php
$access_token = 'PmDddl8WuDAkEfXMn31RRp51mGKnckP1eQ/FicaegAdtDn8+6lqTl/+X3wp1yuYUSGGFw4AcFM64SqRmLBOERVxDJUh3EEGNZb2lzLvGIwyhaJOpyiDwZijKDdiotKRGK7Chf5QR+F3+v4wPgocg6wdB04t89/1O/w1cDnyilFU=';

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
			$text = $event['message']['text'];
			$qry_str = "?data=".urlencode($text)."&event=".$content;
			$ch = curl_init();

			// Set query data here with the URL
			curl_setopt($ch, CURLOPT_URL, 'http://notify.moomnee.com/line_bot/echo_message.php' . $qry_str); 

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 3);
			$content = trim(curl_exec($ch));
			curl_close($ch);

		}
	}
}
echo "OK";
?>