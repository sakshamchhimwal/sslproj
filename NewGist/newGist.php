<?php
    session_start();
    if(!isset($_SESSION['access_token'])){
        header("Location:../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en" style="background:black">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Gist</title>
</head>
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

.formxx {

    margin-left: 30%;
    margin-top: 10%;
    width: 30%;
    padding: 30px;
    height: auto;
    border: 2px solid crimson;
    border-radius: 7px;
    background: rgb(25, 24, 24);
    color: white;
    font-family: 'Ubuntu', sans-serif;
    font-size: 25px;
}

.formxx:hover {
    background: crimson;
    transition: all 0.3s ease;
    transform: scale(1.05);
}

.inputxx {
    background: crimson;
}

.mgstbtn:hover {
    background: white;
}

.btn1 {
    z-index: 1000;
    text-decoration: none;
    font-family: "Ubuntu";
    color: crimson;
    font-size: 20px;
    font-weight: 300;
    position: absolute;
    top: 4.3%;
    right: 10%;
}

.btn1:hover {
    color: white;
}
</style>

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
            $newGistOutput='<div class="incomingxx" style="color: white;
            margin: 200px;
            margin-left: 250px;
            font-size: 50px;
            font-weight: 500;
            font-family: "Ubuntu", sans-serif;">
             <div class="text-1" style="
             color: white ">Your,<p style="
             color:crimson"> Gists is Created!!</p> </div>
        </div>';
            $newGistOutput .= '<div class="mgistxx" style="    justify-content: center;
            margin: 150px;
            margin-left: 250px;"><button class="mgistbtn" style="    padding: 10px;
            font-size: 20px;
            border: 2px solid red;
            border-radius: 7px;
            background: crimson;"><a href="./codespace.php" style="    padding: 10px;
            text-decoration: none;
            color: white;
            font-family: "Ubuntu", sans-serif;">Click Here To start coding</a></button></div>';
        }    
    }else{
        $newGistOutput.='<div class"gists-det">';
        $newGistOutput.='<form method="get" action="newGist.php" class="formxx">
        Keep Public<br />
        <select name="type" style="width: 20%;
        border: 2px solid crimson;
        border-radius: 6px;
        padding: 1px;">
        <br>
        <option>true</option>
        <option>false</option>
        </select>
        <br />
        <br>
        Desc Of Gist <br />
        <input type="text" class="iputxx" name="desc"
        style="    width: 80%;
        background: aliceblue;
        border-radius: 6px;
        border: 2px solid crimson;
        padding: 1px;"/>
        <br />
        <br>
        Name Of File <br />
        <input type="text" name="fname" style="    width: 80%;
        background: aliceblue;
        border-radius: 6px;
        border: 2px solid crimson;
        padding: 1px;"/>
        <br />
        <br>
        Extension Of File<br>
        <select name="ext"
        style="width: 20%;
        border: 2px solid crimson;
        border-radius: 6px;
        padding: 1px;">
            <option value=".py">.py</option>
        </select>
        <br>
        <br>
        <button type="submit" class="gbtn" style="    padding: 4px;
        border: 2px solid crimson;
        border-radius: 7px;
        background: aliceblue;
        margin-left: 33%;
        width: 25%;">Make</button>
        </form> </div>';
    }
?>

<body>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Gists<span>Details</span></a></div>

            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <a href="../shell.php" class="btn1"> Go To Gists </a>

    <?php echo $newGistOutput;?>
    <script>
    $(document).ready(function() {
        $(window).scroll(function() {
            // sticky navbar on scroll script
            if (this.scrollY > 20) {
                $('.navbar').addClass("sticky");
            } else {
                $('.navbar').removeClass("sticky");
            }

            // scroll-up button show/hide script
            if (this.scrollY > 500) {
                $('.scroll-up-btn').addClass("show");
            } else {
                $('.scroll-up-btn').removeClass("show");
            }
        })
        var typed = new Typed(".typing", {
            strings: ["Gists Is Created"],
            typeSpeed: 100,
            backSpeed: 60,
            loop: true
        });
    });
    </script>
</body>

</html>