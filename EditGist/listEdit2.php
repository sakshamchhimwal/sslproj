<?php
    session_start();
    if(!isset($_SESSION['access_token'])){
        header("Location:../index.php");
    }
?>
<?php

$code = htmlspecialchars($_COOKIE['xcode']);
$code = str_replace("&quot;", '\"', str_replace("&#039;", '\'', htmlspecialchars(str_replace('\\join', '\r\n', $code))));
$postField = '{"files":{"' . $_SESSION['editGistDetails'][1] . '":{"content":"' . $code . '"}}}';
$accToken = $_SESSION['access_token'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/gists/' . $_SESSION['editGistDetails'][0]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Accept: application/vnd.github+json';
$headers[] = 'Authorization: Bearer ' . $accToken;
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_USERAGENT, 'CodeSpace Gists');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postField);
$result = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($http_code != 200) {
    echo $http_code;
} else {
    $redLoc = '../shell.php';
    header("Location:" . $redLoc);

}
curl_close($ch);

?>