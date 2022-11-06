<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/pyodide/v0.21.3/full/pyodide.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSpace</title>
</head>
<body>
    <form action="insertgist.php" method="post">
      <pre>
        <textarea cols=80 rows=30 id="inputArea" name="code"></textarea>
    </pre>
      <button type="submit">Save As Gist</button>
      <pre>
        <div class="outputBox">
        </div>
    </pre>
    </form>
</body>
<script>
  
// Creating a cookie after the document is ready
let x=doucment.getElementById("inputArea").innerHTML;
x=x.split('\n');
console.log((x));
$(document).ready(function () {
    createCookie("gfg", "GeeksforGeeks", "10");
});
   
// Function to create the cookie
function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}
  
</script>
</html>