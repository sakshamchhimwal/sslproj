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
    <script>
      function makeCooki(){
    let code = document.getElementById("inputArea")["value"];
    code = code.split("\n").join("\\join");
    document.cookie = "xcode = "+code;
    console.log(document.cookie);}

  </script>
</head>
<body>
    <form action="insertgist.php" method="post">
      <pre>
        <textarea cols=80 rows=30 id="inputArea" name="code"></textarea>
    </pre>
      <button type="submit" id="subbut" onClick=makeCooki()>Save As Gist</button>
      <pre>
        <div class="outputBox">
        </div>
    </pre>
    </form>
</body>
<script>
  document.addEventListener("keydown", keyPressed);
function keyPressed(e) {
  if (e["key"] === "Enter") {
    let code = document.getElementById("inputArea")["value"];
    code = code.split("\n").join("\\join");
    document.cookie = "xcode = "+code;
    console.log(document.cookie);
  }
}  
</script>
</html>