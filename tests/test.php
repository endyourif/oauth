<?php
require_once "../library/OAuthStore.php";
require_once "../library/OAuthRequester.php";

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
// Note: do not use "Session" storage in production. Prefer a database
// storage, such as MySQL.
OAuthStore::instance("Session", $options);

//  STEP 1:  If we do not have an OAuth token yet, go get one
if (empty($_GET["oauth_token"]))
{
    $getAuthTokenParams = array('scope' => OAUTH_HOST, 'xoauth_displayname' => 'Oauth test');

    // get a request token
    $tokenResultParams = OAuthRequester::requestRequestToken($options['consumer_key'], 0, $getAuthTokenParams);

    print_r($tokenResultParams);
}