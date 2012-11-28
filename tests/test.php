<?php
define("OAUTH_HOST", "http://oauth.endyourif.com");

$user_id = 1;
//  Init the OAuthStore
$options = array(
    'consumer_key' => '1c0dbb96c1cfc198ea58c82d7974a248050b65871',
    'consumer_secret' => '8f14da56bbbb46ac9c507e587318222e',
    'server_uri' => OAUTH_HOST,
    'request_token_uri' => OAUTH_HOST . '/request_token.php',
    'authorize_uri' => OAUTH_HOST . '/login.php',
    'access_token_uri' => OAUTH_HOST . '/access_token.php'
);

include_once "../library/OAuthStore.php";
include_once "../library/OAuthRequester.php";

OAuthStore::instance("Session", $options);

if (empty($_GET["oauth_token"])) {
    // get a request token
    $tokenResultParams = OAuthRequester::requestRequestToken($options['consumer_key'], $user_id);

    Header("Location: {$options['authorize_uri']}?oauth_token={$tokenResultParams['token']}&oauth_callback=" . urlencode("http://{$_SERVER['SERVER_NAME']}/tests/test.php"));
} else {
    //  STEP 2:  Get an access token
    $oauthToken = $_GET["oauth_token"];

    // echo "oauth_verifier = '" . $oauthVerifier . "'<br/>";
    $tokenResultParams = $_GET;

    OAuthRequester::requestAccessToken($options['consumer_key'], $tokenResultParams['oauth_token'], $user_id, 'POST', $_GET);
}

/*$request = new OAuthRequester("", 'GET', $tokenResultParams);
$result = $request->doRequest(0);
if ($result['code'] == 200) {
    var_dump($result['body']);
}
else {
    echo 'Error';
}*/