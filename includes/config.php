<?php
session_start();
print_r($_SESSION);

// Create constants for database connection
define('DB_TYPE', 'MySQLi');
define('DB_NAME', 'oauth');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'oauth');
define('DB_PASSWORD', 'oauth99');