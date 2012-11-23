<?php
// Add a header indicating this is an OAuth server
header('X-XRDS-Location: http://' . $_SERVER['SERVER_NAME'] . '/services.xrds');

// Include the OAuth library code
require_once 'library/OAuthServer.php';
require_once 'library/OAuthStore.php';

// Include database class
require_once 'includes/database.php';
$database = new Database();

// Create a new instance of the OAuthStore
$store = OAuthStore::instance(DB_TYPE, array('conn' => $database->GetConnection()));

// Create a new instance of the OAuthServer
$server = new OAuthServer();