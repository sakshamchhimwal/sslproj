<?php
    session_start();
    if(!isset($_SESSION['access_token'])){
        header("Location:../index.php");
    }
?>

<?php
    $accToken = $_SESSION['access_token'];
    // $gistLink = explode('/',$_SESSION['newGistData']->url);
    // $gistId=end($gistLink);
    if(isset($accToken)){
        // echo $_COOKIE['codeDetail'];
        $code = explode(",",$_COOKIE['codeDetail']);
        $len = strlen($code[0]);
        $code = substr($code[0],9,$len-1);
        echo $code;
        $gistId = $_SESSION['newGistData']->url;
        $gistId = explode("/",$gistId)[4];
        // echo $gistId;
        $code = str_replace('\\join','\r\n',$code);
        $code = str_replace('\"','&#34;',$code);
        $code = str_replace('\'','&#38;',$code);
        $code = str_replace(':','&#58;',$code);

        echo $code;
        $postField  ='{"description":"'.$_SESSION['gistDetails']['desc'].'","files":{"'.$_SESSION['gistDetails']['fname'].'":{"content":'.$code.'}}}';
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
        curl_close($ch);
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
            echo $http_code;
            // print_r($postField);
            // print_r(json_decode($result)); 
            header("Location:../shell.php");

        }
        
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