<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en"  style="background:black">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shell</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://kit.fontawesome.com/5d50a14114.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tsparticles/2.5.1/tsparticles.min.js" integrity="sha512-+YPbXItNhUCZR3fn5KeWPtJrXuoqRYQ4Gd1rIjEFG+h8UJYekebhOMh84vv7q+Y1sy5kdIIVtfftehCiigriMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="phone.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    </head>
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
.menu-btn{
    color: #fff;
    font-size: 23px;
    cursor: pointer;
    display: none;
}
.btn1{
    z-index: 1000;
    text-decoration:none;
    font-family: "Ubuntu";
    color: crimson;
    font-size: 15px;
    font-weight: 200;
    position: absolute;
    top: 4.3%;
    right: 5%;  
}
.btn1:hover{
    color: white;
}
.btn2{
    z-index: 1000;
    text-decoration:none;
    font-family: "Ubuntu";
    color: crimson;
    font-size: 15px;
    font-weight: 200;
    position: absolute;
    top: 4.3%;
    right: 27%; 
}
.btn2:hover{
    color: white;
}
.shellxx {
    border: 2px solid crimson;
    font-family: 'Ubuntu', sans-serif;
    border-radius: 7px;
    width: 600px;
    padding: 25px;
    margin-top: 5px;
    margin-bottom: 5px;
    color: white;
    background: rgb(25, 24, 24);
    border-radius: 2px solid crimson;
}
.shellxx:hover{
    background:crimson;
    transition: all 0.3s ease;
    transform: scale(1.05);
}
.read{
    color:blue;
}
.contentxx{
    background:rgb(25, 24, 24);
}
</style>
<body>
<nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Gis<span>ts</span></a></div>

            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

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
    $completeFile="<div class='wrapper' style='
    display: grid;
    grid-template-columns: auto;
    row-gap: 20px;
    justify-content: center;
    justify-items: start;
    background: black;
'>";
    $i=0;
    foreach(getAllGists() as $gist){
        $existingGist="";
        foreach($gist->files as $filename){
            
            $existingGist='<div class="shellxx">';
            $i++;
            // $existingGist.=$i.')';//idhar laga
            $existingGist .= '<h3>'.$filename->filename.'</h3><br>';
            $existingGist.= '<br>';//idhar laga
            $codestr = htmlspecialchars(file_get_contents($filename->raw_url));
            $codestr = substr($codestr,0,250);
            $existingGist.= '<pre>'.$codestr.'</pre><a href="'.$filename->raw_url.'"><div class="read">...</div></a><br>';//idhar laga
            $existingGist.="</div>";
        }
        $completeFile.=$existingGist;
    }
    $completeFile.="</div>";
    // echo  $_SESSION['access_token'];
?>
            <?php echo $completeFile;?>
    <a href="newGist.php" class="btn1">Create A New Gist</a>
    <a href="listEditGist.php" class="btn2">Add To Existing Gist</a>
    <a href="deleteListGist.php">Delete A Gist</a>

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
    })});
</body>
</script>
</html>