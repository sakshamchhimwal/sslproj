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
<style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Ubuntu:wght@400;500;700&display=swap');
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;   

}
html{
    scroll-behavior: smooth;
    background:black;
}
/* custom scroll bar */
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
    background: #888;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* all similar content styling codes */
section{
    padding: 100px 0;
}
.max-width{
    max-width: 1300px;
    padding: 0 80px;
    margin: auto;
}
.about, .services, .skills, .teams, .contact, footer{
    font-family: 'Poppins', sans-serif;
}
.about .about-content,
.services .serv-content,
.skills .skills-content,
.contact .contact-content{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}
section .title{
    position: relative;
    text-align: center;
    font-size: 40px;
    font-weight: 500;
    margin-bottom: 60px;
    padding-bottom: 20px;
    font-family: 'Ubuntu', sans-serif;
}
section .title::before{
    content: "";
    position: absolute;
    bottom: 0px;
    left: 50%;
    width: 180px;
    height: 3px;
    background: #111;
    transform: translateX(-50%);
}
section .title::after{
    position: absolute;
    bottom: -8px;
    left: 50%;
    font-size: 20px;
    color: crimson;
    padding: 0 5px;
    background: #fff;
    transform: translateX(-50%);
}
.loginGit{
    z-index: 1000;
    text-decoration:none;
    font-family: "Ubuntu";
    color: crimson;
    font-size: 35px;
    font-weight: 600;
    position: absolute;
    top: 3%;
    right: 4%;
}
    .navbar{
    width: 100%;
    z-index: 999;
    padding: 10px 0;
    background: black;
    font-family: 'Ubuntu', sans-serif;
    transition: all 0.3s ease;
}
.navbar.sticky{
    padding: 10px 0;
    background: crimson;
}
.navbar .max-width{
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.navbar .logo a{
    color: #fff;
    font-size: 35px;
    font-weight: 600;
}
.navbar .logo a span{
    color: crimson;
    transition: all 0.3s ease;
}
.navbar.sticky .logo a span{
    color: #fff;
}
.navbar .menu li{
    list-style: none;
    display: inline-block;
}
.navbar .menu li a{
    display: block;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    margin-left: 25px;
    transition: color 0.3s ease;
}
.navbar .menu li a:hover{
    color: crimson;
}
.navbar.sticky .menu li a:hover{
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
    $completeFile='<select name="gistSelect" style="padding: 5px;
    font-size: 20px;
    background: rgb(25, 24, 24);
    color:white;
    border: 2px solid crimson;
    border-radius: 7px;
    width:50%;">';
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
<nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Code<span>Space</span></a></div>

            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <div>
        <H1 style="
            color: white;
    padding: 10px;
    margin-left: 180px;
    margin-top: 100px;
    font-size: 50px;
    font-family: 'Ubuntu', sans-serif;">You,</H1>
        <h2 style="
       color: crimson;
    margin-left: 180px;
    font-size: 30px;
    font-family: 'Ubuntu', sans-serif;">
            Can edit an existing gist
        </h2>
    </div>
    <form method='get' action='codespaceEDIT.php' style="    margin: 100px;
    margin-left: 400px;">
    <?php echo $completeFile;?>
    <button type="submit" style="margin-left: 15px;
    padding:2px;
    padding-left: 10px;
    padding-right: 10px;
    font-size: 20px;
    border: 2px solid crimson;
    border-radius: 6px;
    background: crimson;">Edit</button>
</form>
<a href="shell.php" class="btn1"> Go Back </a>

</body>
<script>

           $(document).ready(function(){
    $(window).scroll(function(){
        // sticky navbar on scroll script
        if(this.scrollY > 20){
            $('.navbar').addClass("sticky");
        }else{
            $('.navbar').removeClass("sticky");
        }
        
        // scroll-up button show/hide script
        if(this.scrollY > 500){
            $('.scroll-up-btn').addClass("show");
        }else{
            $('.scroll-up-btn').removeClass("show");
        }
    })})
</script>
</html>