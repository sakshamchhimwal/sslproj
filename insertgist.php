<?php
    session_start();
    $accToken = $_SESSION['access_token'];
    $gistLink = explode('/',$_SESSION['newGistData']->url);
    $gistId=end($gistLink);
    if(isset($accToken) && isset($_COOKIE['xcode'])){
        $code = $_COOKIE['xcode'];
        $code = str_replace('\\join','\r\n',$code);
        $code = str_replace('\\tabspace','    ',$code);
        $code = htmlspecialchars($code);
        $postField  ='{"description":"'.$_SESSION['gistDetails']['desc'].'","files":{"'.$_SESSION['gistDetails']['fname'].'":{"content":"'.$code.'"}}}';
        echo '<pre>'.$code.'</pre>';
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
            echo $accToken;
            echo '<br>';
            echo $gistId;
            echo '<br>';
            echo $postField;
            echo '<br>';
            echo 'Error:' . curl_error($ch);
            echo $http_code;
        }else{
            // print_r($postField);
            // print_r(json_decode($result)); 
            header("Location:shell.php");

        }
        curl_close($ch);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>
<script>
console.log(document.cookie);
</script>

</html>