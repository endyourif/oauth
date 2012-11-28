<?php
define("OAUTH_HOST", "http://oauth.endyourif.com");

//  Init the OAuthStore
$options = array(
    'consumer_key' => '91b962e21bd0c369154ba3eddc066a58050b64efd',
    'consumer_secret' => 'ac11ea9860363978615c9ad0e950d89a',
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
    $tokenResultParams = OAuthRequester::requestRequestToken($options['consumer_key'], 1);

    Header("Location: {$options['authorize_uri']}?oauth_token={$tokenResultParams['token']}");
} else {
    //  STEP 2:  Get an access token
    $oauthToken = $_GET["oauth_token"];

    // echo "oauth_verifier = '" . $oauthVerifier . "'<br/>";
    $tokenResultParams = $_GET;

    OAuthRequester::requestAccessToken($options['consumer_key'], $tokenResultParams['token'], 1, 'POST', $_GET);
}

/*$request = new OAuthRequester("", 'GET', $tokenResultParams);
$result = $request->doRequest(0);
if ($result['code'] == 200) {
    var_dump($result['body']);
}
else {
    echo 'Error';
}*/