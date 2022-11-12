<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Your Code</title>
    <style>
pre code.hljs{display:block;overflow-x:auto;padding:1em}code.hljs{padding:3px 5px}.hljs{color:#a9b7c6;background:#282b2e}.hljs-bullet,.hljs-literal,.hljs-number,.hljs-symbol{color:#6897bb}.hljs-deletion,.hljs-keyword,.hljs-selector-tag{color:#cc7832}.hljs-link,.hljs-template-variable,.hljs-variable{color:#629755}.hljs-comment,.hljs-quote{color:grey}.hljs-meta{color:#bbb529}.hljs-addition,.hljs-attribute,.hljs-string{color:#6a8759}.hljs-section,.hljs-title,.hljs-type{color:#ffc66d}.hljs-name,.hljs-selector-class,.hljs-selector-id{color:#e8bf6a}.hljs-emphasis{font-style:italic}.hljs-strong{font-weight:700}
    </style>
    <script>
    function toogleTheme(value){
        let stysht = document.getElementsByName('link');
        stysht.href = value;
    }
    </script>
</head>

<body>
    <script src="../highlight.min.js"></script>
    <script>hljs.highlightAll();</script>

    <?php
      $fname = $_GET['link'] ;
      $content = htmlspecialchars(file_get_contents($fname));
      echo "<div><pre><code class='language-python' id='codeBox__'>".$content."</code></pre></div>";
      echo "<div><button onclick='copyText_()'>Copy</button></div>";
      echo '<input type="button" value="Print this page" onClick="window.print()"></br>';
      echo '<a href="'.$fname.'" target="_blank">For RAW</a>'  ;
    ?>

    <script>
            ele = document.getElementById("codeBox__").textContent;
            function copyText_() {
                navigator.clipboard.writeText(ele);
            }
    </script>

</body>
</html>
