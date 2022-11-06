<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shell</title>
</head>
<?php
    function getAllGists(){
        $apiBase= "https://api.github.com/gists";
        $accToken = $_SESSION['access_token'];
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$apiBase);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.github+json', 'Authorization: token '. $accToken)); 
        curl_setopt($curl, CURLOPT_USERAGENT, 'CodeSpace Gists'); 
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); 
        $api_response = curl_exec($curl); 
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);          
        if($http_code != 200){ 
            if (curl_errno($curl)) {  
                $error_msg = curl_error($curl);  
            }else{ 
                $error_msg = $api_response; 
            } 
            throw new Exception('Error '.$http_code.': '.$error_msg); 
        }else{ 
            return json_decode($api_response); 
        } 
    }
    $completeFile="";
    $i=0;
    foreach(getAllGists() as $gist){
        $existingGist="";
        foreach($gist->files as $filename){
            $i++;
            $existingGist.=$i.')';
            $existingGist .= $filename->filename;
            $existingGist.= '<br>';
            $codestr = htmlspecialchars(file_get_contents($filename->raw_url));
            $codestr = substr($codestr,0,250);
            $existingGist.= '<pre>'.$codestr.'</pre><a href="'.$filename->raw_url.'">...</a><br>';
        }
        $existingGist.= '<hr>';
        $completeFile.=$existingGist;
    }
    // echo  $_SESSION['access_token'];
?>
<body>
    <?php echo $completeFile;?>
    <a href="newGist.php">Create A New Gist</a>
    <a href="addToGist.php">Add To Existing Gist</a>
</body>
</html>