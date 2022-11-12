<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" style="background:black;">

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
    code = code.split("\t").join("    ");
    document.cookie = "xcode = " + code;
    console.log(document.cookie);
}
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Ubuntu:wght@400;500;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;

}

html {
    scroll-behavior: smooth;
}



.max-width {
    max-width: 1300px;
    padding: 0 80px;
    margin: auto;
}

.navbar {
    width: 100%;
    z-index: 999;
    padding: 10px 0;
    background: black;
    font-family: 'Ubuntu', sans-serif;
    transition: all 0.3s ease;
}

.navbar.sticky {
    padding: 10px 0;
    background: crimson;
}

.navbar .max-width {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.navbar .logo a {
    color: #fff;
    font-size: 35px;
    font-weight: 600;
}

.navbar .logo a span {
    color: crimson;
    transition: all 0.3s ease;
}

.navbar.sticky .logo a span {
    color: #fff;
}

.navbar .menu li {
    list-style: none;
    display: inline-block;
}

.navbar .menu li a {
    display: block;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    margin-left: 25px;
    transition: color 0.3s ease;
}

.navbar .menu li a:hover {
    color: crimson;
}

.navbar.sticky .menu li a:hover {
    color: #fff;
}
.btn1{
    z-index: 1000;
    text-decoration:none;
    font-family: "Ubuntu";
    color: crimson;
    font-size: 20px;
    font-weight: 300;
    position: absolute;
    top: 4.3%;
    right: 10%;  
}
.btn1:hover{
    color: white;
}
</style>
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
        $code = '<pre style="margin: 100px;
        padding: 2px;"><textarea rows=40 cols=100 name="editCode" id="code"
        style="border: 2px solid crimson;
        border-radius: 6px;
        color: white;
        width:80%;
        resize: none;
        height:70%;
        background: rgb(25, 24, 24);
        font-size:20px">'.$code.'</textarea></pre>';
    }
?>

<body>
    <script src="../highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Code<span>Space</span></a></div>

            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <a href="../shell.php" class="btn1"> Go Back </a>
    <form method="get" action="../EditGist/insertEDITgist.php">
        <?php echo $code;?>
        <button type="submit" onClick=makeCooki() style="    margin-left: 30%;
    padding: 8px;
    color: white;
    background: crimson;
    border: 2px solid crimson;
    border-radius: 6px;
    width: 25%;
    font-size: 20px;">UPDATE</button>
        <form>

</body>
<script type="text/javascript">
document.addEventListener("keydown", keyPressed);

document.getElementById('code').addEventListener('keydown', function(e) {
    if (e.key == 'Tab') {
        e.preventDefault();
        var start = this.selectionStart;
        var end = this.selectionEnd;

        // set textarea value to: text before caret + tab + text after caret
        this.value = this.value.substring(0, start) +
            "\t" + this.value.substring(end);

        // put caret at right position again
        this.selectionStart =
            this.selectionEnd = start + 1;
    }
});
function keyPressed(e) {
    if (e["key"] === "Enter") {
        makeCooki();
    }
}
</script>

</html>