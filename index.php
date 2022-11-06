
<?php 
session_start();
?>
<?php
// Include configuration file 
require_once 'config.php'; 
 
// Include and initialize user class 
require_once 'User.class.php'; 
$user = new User(); 
 
if(isset($accessToken)){ 
    // Get the user profile data from Github 
    $gitUser = $gitClient->getAuthenticatedUser($accessToken); 
     
    if(!empty($gitUser)){ 
        // Getting user profile details 
        $gitUserData = array(); 
        $gitUserData['oauth_uid'] = !empty($gitUser->id)?$gitUser->id:''; 
        $gitUserData['name'] = !empty($gitUser->name)?$gitUser->name:''; 
        $gitUserData['username'] = !empty($gitUser->login)?$gitUser->login:''; 
        $gitUserData['email'] = !empty($gitUser->email)?$gitUser->email:''; 
        $gitUserData['location'] = !empty($gitUser->location)?$gitUser->location:''; 
        $gitUserData['picture'] = !empty($gitUser->avatar_url)?$gitUser->avatar_url:''; 
        $gitUserData['link'] = !empty($gitUser->html_url)?$gitUser->html_url:''; 
         
        // Insert or update user data to the database 
        $gitUserData['oauth_provider'] = 'github'; 
        $userData = $user->checkUser($gitUserData); 
 
        // Storing user data    in the session 
        $_SESSION['userData'] = $userData; 
 
        // Render Github profile data 

        $output  = '<div class="total"><div class="Heading"><h2><h1 class="git">GitHub</h1> <h2 class="git2">Account Details</h2></h2></div>'; 
        $output .= '<div class="ac-data">'; 
        $output .= '<div class="wrapperxx"><div class="img1"><img src="'.$userData['picture'].'" height=200 width=200 class="profileimg" ></div><div  class="containerxx">'; 
        $output .= '<div class="box"><p><b>ID:</b> '.$userData['oauth_uid'].'</p></div>'; 
        $output .= '<div class="box"><p><b>Name:</b> '.$userData['name'].'</p></div>'; 
        $output .= '<div class="box"><p><b>Login Username:</b> '.$userData['username'].'</p></div>'; 
        $output .= '<div class="box"><p><b>Email:</b> '.$userData['email'].'</p></div>'; 
        $output .= '<div class="box"><p><b>Location:</b> '.$userData['location'].'</p></div></div></div>'; 
        $output .= '<div class="Shellstyle"><p><b>Profile Link:</b><button class="bottombtn"> <a href="'.$userData['link'].'" target="_blank">Click to visit</a></p></div>'; 
        $output .= '<div class="Shellstyle"><p>Proceed to Shell <button class="bottombtn"><a href="shell.php">Shell</a></p></button></div>'; 
        $output .= '<div class="Shellstyle"><p>Logout from Github<button class="bottombtn"> <a href="logout.php">LogOut</a></p></button></div></div>'; 
        $output .= '</div><div class="last-container">
        <ul>
            <li><a href="https://instagram.com/festeve360?igshid=YmMyMTA2M2Y=" target="_blank"><i
                        class="fa-brands fa-instagram all-icons"></i></a></li>
            <li><a href="mailto:shivesh.pandey0409@gmail.com" target="_blank"><i class="fa-solid fa-envelope all-icons"></i></a></li>
            <li><a href="https://www.twitter.com/festeve360" target="_blank"><i class="fa-brands fa-twitter-square all-icons"></i></a></li>
        </ul>
        <script src="tsparticles.engine.min.js"></script>
        <footer class="center">
            Copyright &copy;www.CodeSpace.com. All rights reserved
        </footer>
    </div>'; 
        $_SESSION['output'] = $output;
    }else{ 
        $output = '<h3 style="color:crimson">Something went wrong, please try again!</h3>'; 
        $_SESSION['output'] = $output;
    }  
}elseif(isset($_GET['code'])){ 
    // Verify the state matches the stored state 
    if(!$_GET['state'] || $_SESSION['state'] != $_GET['state']) { 
        header("Location: ".$_SERVER['PHP_SELF']); 
    } 
     
    // Exchange the auth code for a token 
    $accessToken = $gitClient->getAccessToken($_GET['state'], $_GET['code']); 
   
    $_SESSION['access_token'] = $accessToken; 
   
    // header('Location: ./'); 
}else{ 
    // Generate a random hash and store in the session for security 
    $_SESSION['state'] = hash('sha256', microtime(TRUE) . rand() . $_SERVER['REMOTE_ADDR']); 
     
    // Remove access token from the session 
    unset($_SESSION['access_token']); 
   
    // Get the URL to authorize 
    $authUrl = $gitClient->getAuthorizeURL($_SESSION['state']); 
     
    // Render Github login button 

    $output = '<a href="'.htmlspecialchars($authUrl).'"><div class="loginGit">Login</div></a>'; 
} 
?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Space</title>
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
img.profileimg{
    border-radius:100%;
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
.loginGit:hover{
    color: white;
}
/* navbar styling */
.navbar{
    position: fixed;
    width: 100%;
    z-index: 999;
    padding: 30px 0;
    font-family: 'Ubuntu', sans-serif;
    transition: all 0.3s ease;
}
.navbar.sticky{
    padding: 15px 0;
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

/* menu btn styling */
.menu-btn{
    color: #fff;
    font-size: 23px;
    cursor: pointer;
    display: none;
}
.scroll-up-btn{
    position: fixed;
    height: 45px;
    width: 42px;
    background: crimson;
    right: 30px;
    bottom: 10px;
    text-align: center;
    line-height: 45px;
    color: #fff;
    z-index: 9999;
    font-size: 30px;
    border-radius: 6px;
    border-bottom-width: 2px;
    cursor: pointer;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
}



/* home section styling */
.home{
    display: flex;
    background: url("images/banner.jpg") no-repeat center;
    height: 100vh;
    color: rgb(255, 255, 255);
    min-height: 500px;
    background-size: cover;
    background-attachment: fixed;
    font-family: 'Ubuntu', sans-serif;
}
.home .max-width{
  width: 100%;
  display: flex;
}
.home .max-width .row{
  margin-right: 0;
}
.home .home-content .text-1{
    font-size: 30px;
}
.home .home-content .text-1 span{
    color: crimson;
    font-weight: 500;
}
.home .home-content .text-2{
    font-size: 75px;
    font-weight: 600;
    margin-left: -3px;
}
.home .home-content .text-3{
    font-size: 40px;
    margin: 5px 0;
}
.home .home-content .text-3 span{
    color: crimson;
    font-weight: 500;
}
.home .home-content a{
    display: inline-block;
    background: crimson;
    color: #fff;
    font-size: 25px;
    padding: 12px 36px;
    margin-top: 20px;
    font-weight: 400;
    border-radius: 6px;
    border: 2px solid crimson;
    transition: all 0.3s ease;
}
.home .home-content a:hover{
    color: crimson;
    background: none;
}
.Heading{
    color: rgb(228, 76, 76);
    text-align: center;

    padding:5px;

}
.Shellstyle{
    color: crimson;
    text-align: center;
    margin-top: 5px;
    font-weight:100;
    font-size: 20px;
}
.bottombtn{
    margin-left:3px;
    padding: 2px;
    color: rgb(232, 159, 159);


}
.bottombtn:hover{
    color: crimson;
}
.img1{
    margin-left: 10%;
    border-radius: 10%;
}

.box{
    margin-left: 30%;
    margin-top: 5px;
    font-weight:50;
    margin-bottom: 5px;
}
.wrapperxx{
    display: flex;
    flex-direction: row;
    margin: auto;
    align-items: center;
    margin-left: auto;
    justify-content: center;
}
.containerxx{
    width:550px;
    color: crimson;
    font-size: 20px;

}
.total{
    /* background-color: rgb(205, 212, 219); */
    background: url("images/banner2.jpg") no-repeat center;
    height:75%;
}
footer {
    /* background: black; */
    color: white;
    padding: 9px 20px;

}

.last-container {
    background-color: rgb(27, 27, 27);

}

.last-container ul {
    display: flex;
    justify-content: center;
    align-items: center;
}

.all-icons {
    font-size: 2rem;
    padding: 5px 50px;
    filter: invert(50%);
    transition: .2s;
}

.all-icons:hover {
    font-size: 2.5rem;
    filter: invert(100%);
}
.center {
    text-align: center;
}
.git{
    font-size: 30px;
    color: black;
    font-weight: 150;
}
.git2{
    font-size:15px;
    font-weight: 700;

}

    </style>
    <body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Code<span>Space</span></a></div>
            <!-- <ul class="menu">
                <?php
                    echo '<li><a href="'.htmlspecialchars($authUrl).'" class="menu-btn">Log-in</a></li>';
                ?>
            </ul> -->
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">Hello, <span class="typing"></span> </div>
                <div class="text-2">Welcome to Coding space </div>
                <div class="text-3">Here you can <span class="typing1"></span> </div>
                
            </div>
        </div>
    </section>
    <div>
    <!-- Display login button / GitHub profile information -->
    <?php echo $output; ?>
    </div>
    
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
    });
    var typed = new Typed(".typing", {
        strings: ["Welcome to Code Space","Start You Journey Here"],
        typeSpeed: 100,
        backSpeed: 60,
        loop: true
    });

    var typed = new Typed(".typing1", {
        strings: ["Convert Ideas To Reality","Test Your Thoughts"],
        typeSpeed: 100,
        backSpeed: 62,
        loop: true
    });
    var typed = new Typed(".typing2", {
        strings: ["And Start Your Journey"],
        typeSpeed: 100,
        backSpeed: 73,
        loop: true
    });

 });
</script>
</html>