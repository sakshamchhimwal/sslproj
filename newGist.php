<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Gist</title>
</head>

<?php
    $newGistOutput="";
    
    $gistDetails=array("desc"=>"","type"=>"","fname"=>"","content"=>"");
    if (isset($_GET['fname'])) {
        // if($_GET['type']==="true"){
        //     $_GET['type']=true;
        // }else{
        //     $_GET['type']=false;
        // }
        $headContent = "#Gist Created By ".$_SESSION['userData']['name']."At ".time();
        $gistDetails=array("desc"=>$_GET['desc'],"type"=>$_GET['type'],"fname"=>$_GET['fname'].$_GET['ext'],"content"=>$headContent);
    }
    $_SESSION['gistDetails']=$gistDetails;
    if($_SESSION['gistDetails']['fname']!=""){
        $apiBase= "https://api.github.com/gists";
        $accToken = $_SESSION['access_token'];
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$apiBase);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/vnd.github+json'.
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: token '.$accToken
        ));
        $postField  ='{"description":"'.$gistDetails['desc'].'","public":'.$gistDetails['type'].',"files":{"'.$gistDetails['fname'].'":{"content":"'.$gistDetails['content'].'"}}}';
        curl_setopt($curl,CURLOPT_POSTFIELDS,$postField);
        curl_setopt($curl, CURLOPT_USERAGENT, 'CodeSpace Gists'); 
        $api_response = curl_exec($curl); 
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
        if($http_code != 201){ 
            if (curl_errno($curl)) {  
                $error_msg = curl_error($curl);  
            }else{ 
                $error_msg = $api_response; 
            } 
            throw new Exception('Error '.$http_code.': '.$error_msg); 
        }else{ 
            $_SESSION['newGistData'] = json_decode($api_response); 
            $newGistOutput = '<a href="codeboard.php">Click Here To start coding</a>';
        }    
    }else{
        $newGistOutput.='<form method="get" action="newGist.php">
        Keep Public<br />
        <select name="type">
        <option>true</option>
        <option>false</option>
        </select>
        <br />
        Desc Of Gist <br />
        <input type="text" name="desc"/>
        <br />
        Name Of File <br />
        <input type="text" name="fname"/>
        <br />
        Extension Of File<br>
        <select name="ext">
            <option value=".py">.py</option>
        </select>
        <br>
        <button type="submit">Make</button>
        </form>';
    }
?>

<body>
    <?php echo $newGistOutput;?>
</body>
</html>