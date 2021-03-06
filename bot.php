<?php
ini_set('always_populate_raw_post_data', '-1');
$access_token = '+ecG0yQsz6cEwRLzk1xVb8w6UxsfsuzBedcochChB3Qs1HSsbt2NPCmUgSUQmdozqr0Br0brofWZ/dG3+A/fKwY3y5w1S3E7vMzxkLn9yZn3wIWpAzy8+Z1kv+ke17cRUe8IpyNyFhhXYpT7/wRN5gdB04t89/1O/w1cDnyilFU=';
$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:lE4BKQBXEJwHZCU';

// Get POST body content
$content = file_get_contents('php://input');
echo $content;

// Parse JSON
$events = json_decode($content, true);

echo $events;

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			$replyText = 'ต้องการสอบถามเรื่องอะไรบ้างค่ะ';

			if ($text == 'กรมธรรม์') {
				$replyText = 'สอบถามกรมธรรม์';				
			}
			if ($text == 'สินไหม') {
				$replyText = 'สอบถามสินไหม';				
			}

			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $replyText
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";