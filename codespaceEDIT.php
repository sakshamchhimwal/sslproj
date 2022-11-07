<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSpace</title>
</head>
<script type="text/javascript">
function makeCooki() {
    let code = document.getElementById("code")['value'];
    code = code.split("\n").join("\\join");
    document.cookie = "xcode = " + code;
    console.log(document.cookie);
}
</script>
<?php
    if (isset($_GET['gistSelect'])) {
        $gist = explode('/',$_GET['gistSelect']);
        $_SESSION['editGistDetails'] = $gist;
        $gistId = $gist[0];
        $gistName = $gist[1];
        $apiBase= "https://api.github.com/gists/".$gistId;
        $accToken = $_SESSION['access_token'];
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$apiBase);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.github+json', 'Authorization: token '. $accToken)); 
        curl_setopt($curl, CURLOPT_USERAGENT, 'CodeSpace Gists'); 
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); 
        $api_response = curl_exec($curl);
        
        $code = htmlspecialchars_decode(file_get_contents(json_decode($api_response)->files->$gistName->raw_url));
        $code = '<pre><textarea rows=40 cols=100 name="editCode" id="code">'.$code.'</textarea></pre>';
    }
?>

<body>
    <form method="get" action="insertEDITgist.php">
        <?php echo $code;?>
        <button type="submit" onClick=makeCooki()>UPDATE</button>
        <form>
</body>
<script type="text/javascript">
document.addEventListener("keydown", keyPressed);

function keyPressed(e) {
    if (e["key"] === "Enter") {
        makeCooki();
    }
}
</script>

</html>