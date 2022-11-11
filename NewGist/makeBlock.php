<?php
    session_start();
    $funcName = $_COOKIE['funcNames'];
    $funcName = explode(",",$funcName);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" />
    <title>Make Block</title>
</head>


<body>
    <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 400 400">
        <rect width="100%" height="100%" fill="#000" />
    </svg>
</body>


<script>
// targeting the svg itself
const svg = document.querySelector("svg");

// variable for the namspace
const svgns = "http://www.w3.org/2000/svg";
let lastx = 5;
let lasty = 5;

function makeBlock(blockName) {
    console.log("lastx:" +
        lastx);
    console.log("lasty:" +
        lasty);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: lastx,
            y: lasty,
            width: 100,
            height: 100,
            fill: "red",
            class: "target",
        },
    });
    lastx += 0;
    lasty += 110;
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = blockName;
    svg.appendChild(txt);
    gsap.set(txt, {
        x: lastx + 10,
        y: lasty - 100
    });
}
let funcList = decodeURIComponent(document.cookie).split(";")[0].slice(10, ).trim().split(",");
console.log(funcList);
for (let i = 0; i < funcList.length; i++) {
    console.log(funcList[i]);
    makeBlock(funcList[i]);
}
</script>

</html>