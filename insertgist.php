<?php
    session_start();
    $accToken = $_SESSION['access_token'];
    $gistLink = explode('/',$_SESSION['newGistData']->url);
    $gistId=end($gistLink);
    if(isset($accToken)){
        $code = explode(' ',$_POST['code']);
        print_r($code);
        $postField  ='{"description":"'.$_SESSION['gistDetails']['desc'].'","files":{"'.$_SESSION['gistDetails']['fname'].'":{"content":"check"}}}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/gists/'.$gistId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        $headers = array();
        $headers[] = 'Accept: application/vnd.github+json';
        $headers[] = 'Authorization: Bearer '.$accToken;
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERAGENT, 'CodeSpace Gists'); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postField);
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code!=200) {
            // echo $accToken;
            // echo '<br>';
            // echo $gistId;
            // echo '<br>';
            
            // echo 'Error:' . curl_error($ch);
            // echo $http_code;
        }else{
            // echo $postField;
            // print_r(json_decode($result));
        }
        curl_close($ch);
    }
?>