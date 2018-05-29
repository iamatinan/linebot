<?php
$access_token = 'ci/RGXXNeFz5TdqdmBdq4wDFLbtEXFozQtAvy5bGdvS+LDXDBUgoEd7ia3y5CPLjLyV3qPAVIH42wExJGIV9hYiSY2U/De9VTbYkrzA18mOw8L0TLwkhtgX2+kSZvSrIUEL5W9CMBNJRT/MYPobIbQdB04t89/1O/w1cDnyilFU=';
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
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
					// "text"
			];
			if($text == "HI"){

				$messages = [
				'type' => 'text',
				'text' => "hello"
			];
			}
			if($text == "รูป"){

				$messages = [
				'type' => 'text',
				'text' => "http://sand.96.lt/images/q.jpg"
			];
			}
			if($text == "ภาพ"){

				$messages = [
				'type' => 'image',
				'originalContentUrl' => "https://paaying.files.wordpress.com/2008/06/e0b881e0b8a5e0b989e0b8a7e0b8a2.jpg",
    				'previewImageUrl' => "https://paaying.files.wordpress.com/2008/06/e0b881e0b8a5e0b989e0b8a7e0b8a2.jpg"
			];
			}

			/*if($text == "image"){

				$messages = [
				$img_url = "http://sand.96.lt/images/q.jpg";
				$outputText = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);
				$response = $bot->replyMessage($event->getReplyToken(), $outputText);

			];
			}*/



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
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}
echo "OK";
