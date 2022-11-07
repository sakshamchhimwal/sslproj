<?php
    session_start();
    $code = htmlspecialchars($_COOKIE['xcode']);
    $code = str_replace("&quot;",'\"',str_replace("&#039;",'\'',htmlspecialchars(str_replace('\\join','\r\n',$code))));
    // print_r($_SESSION['editGistDetails']);
    $postField  ='{"files":{"'.$_SESSION['editGistDetails'][1].'":{"content":"'.$code.'"}}}';
    $accToken = $_SESSION['access_token'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/gists/'.$_SESSION['editGistDetails'][0]);
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
            // echo $postField;
            // echo '<br>';
            // echo 'Error:' . curl_error($ch);
            echo $http_code;
        }else{
            // // print_r($postField);
            // print_r(json_decode($result));
                        header("Location:shell.php");

        }
    curl_close($ch);
    
?>