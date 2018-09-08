<?php
$access_token = 'PmDddl8WuDAkEfXMn31RRp51mGKnckP1eQ/FicaegAdtDn8+6lqTl/+X3wp1yuYUSGGFw4AcFM64SqRmLBOERVxDJUh3EEGNZb2lzLvGIwyhaJOpyiDwZijKDdiotKRGK7Chf5QR+F3+v4wPgocg6wdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;