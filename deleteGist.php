<?php
    session_start();
    $accToken = $_SESSION['access_token'];
    $ch = curl_init();
    $gistId = explode('/',$_GET['gistSelect'])[0];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/gists/'.$gistId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_USERAGENT, 'CodeSpace Gists'); 
    $headers = array();
    $headers[] = 'Accept: application/vnd.github+json';
    $headers[] = 'Authorization: Bearer '.$_SESSION['access_token'];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code!=204) {
            // echo $accToken;
            // echo '<br>';
            // echo $gistId;
            // echo '<br>';
            // echo $postField;
            // echo '<br>';
            // echo 'Error:' . curl_error($ch);
            echo $http_code;
        }else{
            // print_r($postField);
            echo "Delete Successful";
            header("Location:shell.php");
        }
    curl_close($ch);
    
?>