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
    $completeFile="<select name='gistSelect'>";
    foreach(getAllGists() as $gist){
        $link =explode('/',$gist->url);
        $link = end($link);
        $i = 1;
        foreach($gist->files as $filename){
            $existingGist='<option>';
            $existingGist .= $link.'/'.$filename->filename.'/'.$i;
            $existingGist.= '</option>';
            $completeFile.=$existingGist;
            $i++;
        }
    }
    $completeFile.='</select>';
    $_SESSION['isEdit']='true';
?>

<body>
    <form method='get' action='deleteGist.php'>
        <?php echo $completeFile;?>
        <button type="submit">Delete</submit>
    </form>
</body>

</html>