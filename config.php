<?php 
// Database configuration 
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'githubOauth'); 
define('DB_USER_TBL', 'users'); 
 
// GitHub API configuration 
define('CLIENT_ID', '950c5b31e14fc568c4d8'); 
define('CLIENT_SECRET', '597430d73e8e843d146492b553dfd0d5f0ea25ba'); 
define('REDIRECT_URL', 'http://localhost/sslproj/index.php'); 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Include Github client library 
require_once 'src/Github_OAuth_Client.php'; 
 
// Initialize Github OAuth client class 
$gitClient = new Github_OAuth_Client(array( 
    'client_id' => CLIENT_ID, 
    'client_secret' => CLIENT_SECRET, 
    'redirect_uri' => REDIRECT_URL 
)); 
 
// Try to get the access token 
if(isset($_SESSION['access_token'])){ 
    $accessToken = $_SESSION['access_token']; 
}