<?php
$access_token = '+ecG0yQsz6cEwRLzk1xVb8w6UxsfsuzBedcochChB3Qs1HSsbt2NPCmUgSUQmdozqr0Br0brofWZ/dG3+A/fKwY3y5w1S3E7vMzxkLn9yZn3wIWpAzy8+Z1kv+ke17cRUe8IpyNyFhhXYpT7/wRN5gdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
โด