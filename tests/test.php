<?php
define("OAUTH_HOST", "http://oauth.endyourif.com");

//  Init the OAuthStore
$options = array(
    'consumer_key' => '2f692a9348ecda47c217407ef37b4aa1050b50c25',
    'consumer_secret' => 'c45c6f71f6ee48f3f49fff8ceb15c8a1',
    'server_uri' => OAUTH_HOST,
    'request_token_uri' => OAUTH_HOST + '/request_token.php',
    'authorize_uri' => OAUTH_HOST,
    'access_token_uri' => OAUTH_HOST
);

$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $options['request_token_uri']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('oauth_consumer_key' => $options['consumer_key']));

$results = curl_exec($ch);

curl_close($ch);

print_r($results);