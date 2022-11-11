<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" style="background: black;">

<head>
    <script src="https://cdn.jsdelivr.net/pyodide/v0.21.3/full/pyodide.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSpace</title>
    <script>
    function makeCooki() {
      let code = document.getElementById("inputArea")["value"];
      code = code.split("\n").join("\\join");
      document.cookie = "xcode = " + code;
      console.log(document.cookie);
    }
    </script>
    <script type="module" src="./block_script.js"></script>
    <script>import * from "./block_script.js"</script>

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
section {
    padding: 100px 0;
}

.max-width {
    max-width: 1300px;
    padding: 0 80px;
    margin: auto;
}

.about,
.services,
.skills,
.teams,
.contact,
footer {
    font-family: 'Poppins', sans-serif;
}

.about .about-content,
.services .serv-content,
.skills .skills-content,
.contact .contact-content {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}

section .title {
    position: relative;
    text-align: center;
    font-size: 40px;
    font-weight: 500;
    margin-bottom: 60px;
    padding-bottom: 20px;
    font-family: 'Ubuntu', sans-serif;
}

section .title::before {
    content: "";
    position: absolute;
    bottom: 0px;
    left: 50%;
    width: 180px;
    height: 3px;
    background: #111;
    transform: translateX(-50%);
}

section .title::after {
    position: absolute;
    bottom: -8px;
    left: 50%;
    font-size: 20px;
    color: crimson;
    padding: 0 5px;
    background: #fff;
    transform: translateX(-50%);
}

.loginGit {
    z-index: 1000;
    text-decoration: none;
    font-family: "Ubuntu";
    color: crimson;
    font-size: 35px;
    font-weight: 600;
    position: absolute;
    top: 3%;
    right: 4%;
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
</style>

<body>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Code<span>Space</span></a></div>

            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <form action="../NewGist/insertgist.php" method="post">
        <pre style="margin: 100px;
    padding: 2px;">
        <textarea cols=80 rows=30 id="inputArea" name="code" style="border: 2px solid crimson;
    border-radius: 6px;
    color: white;
    width:80%;
    resize: none;
    background: rgb(25, 24, 24);

}"></textarea>
    </pre>
        <button type="submit" style="    margin-left: 30%;
    padding: 8px;
    color: white;
    background: crimson;
    border: 2px solid crimson;
    border-radius: 6px;
    width: 25%;
    font-size: 20px;" id="subbut" onClick=makeCooki()>Save As Gist</button>
        <pre>
        <div class="outputBox">
        </div>
    </pre>
    </form>
</body>
<script>
// $(document).ready(function() {
//     $(window).scroll(function() {
//         // sticky navbar on scroll script
//         if (this.scrollY > 20) {
//             $('.navbar').addClass("sticky");
//         } else {
//             $('.navbar').removeClass("sticky");
//         }

//         // scroll-up button show/hide script
//         if (this.scrollY > 500) {
//             $('.scroll-up-btn').addClass("show");
//         } else {
//             $('.scroll-up-btn').removeClass("show");
//         }
//     })
// })
document.addEventListener("keydown", keyPressed);

document.getElementById('inputArea').addEventListener('keydown', function(e)
  {
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
  }
);

// import {StripCode, TabCounter, checkIfInCode, checkForInCode, checkElseInCode, checkDefInCode, checkWhileInCode, get_function_name} from

function keyPressed(e) {
  if (e["key"] === "Enter") {
    let codee = document.getElementById("inputArea")["value"];
    let code = document.getElementById("inputArea")["value"];
    let strip_code = StripCode(code);
    let tab_array = TabCounter(code);
    let if_dict = checkIfInCode(strip_code, tab_array, 0);
    let for_list = checkForInCode(strip_code, tab_array, 0);
    let else_array = checkElseInCode(strip_code, tab_array, 0);
    let fun_dict = checkDefInCode(strip_code, tab_array, 0);
    let while_array = checkWhileInCode(strip_code, tab_array, 0);
    func_name_array = get_function_name(strip_code, fun_dict);
    console.log(code);
    console.log("hi");
    console.log(strip_code);
    console.log(if_dict);
    console.log(for_list);
    console.log(else_array);
    console.log(fun_dict);
    console.log(while_array);
    // console.log(func_name_array);
    codee = codee.split("\n").join("\\join");
    document.cookie = "xcode = " + codee + ";SameSite=None; Secure";
    console.log(document.cookie);

  }
}
</script>

</html>