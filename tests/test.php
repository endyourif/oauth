<?php
define("OAUTH_HOST", "http://oauth.endyourif.com");

//  Init the OAuthStore
$options = array(
    'consumer_key' => '91b962e21bd0c369154ba3eddc066a58050b64efd',
    'consumer_secret' => 'ac11ea9860363978615c9ad0e950d89a',
    'server_uri' => OAUTH_HOST,
    'request_token_uri' => OAUTH_HOST . '/request_token.php',
    'authorize_uri' => OAUTH_HOST,
    'access_token_uri' => OAUTH_HOST
);

$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $options['request_token_uri']);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('oauth_consumer_key' => $options['consumer_key'], 'oauth_timestamp' => time())));

/*if(!$result = curl_exec($ch)) {
    trigger_error(curl_error($ch));
}*/
curl_close($ch);

//print_r($result);

include_once "../library/OAuthStore.php";
include_once "../library/OAuthRequester.php";

OAuthStore::instance("Session", $options);

// get a request token
$tokenResultParams = OAuthRequester::requestRequestToken($options['consumer_key'], 1);

print_r($tokenResultParams);