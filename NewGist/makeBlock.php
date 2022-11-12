<?php
    session_start();
    // $funcName = $_COOKIE['funcNames'];
    // $funcName = explode(",",$funcName);
?>
<!DOCTYPE html>
<html lang="en" style="background: black;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="styles.css" /> -->
    <title>Make Block</title>
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
body {
  background-color: #353232;
  font-family: "Source Sans Pro", sans-serif;
  display: flex;
  height: 100vh;
  overflow: hidden;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

svg {
  border-radius: 0px;
  border-color: black;
  border-width: 2px;
}


text {
  font-family: monospace;
  font-size: 20px;
  fill: white;
}
</style>

<body style="background:black ;">
<nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Code<span>Space</span></a></div>

            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <a href="../shell.php" class="btn1"> Go Back </a>

    <svg xmlns="http://www.w3.org/2000/svg" width="1000" height="1000" viewBox="0 0 1000 1000">
        <rect width="100%" height="100%" fill="#000"/>
    </svg>
    <button onClick="window.print()" style="    margin-left: 20%;
    margin-right: 20%;
    padding: 5px;
    color: white;
    background: crimson;
    border: 2px solid crimson;
    border-radius: 6px;
    width: 7%;
    font-size: 15px;
    margin-bottom: 10px">Print</button>
</body>


<script>
// targeting the svg itself
const svg = document.querySelector("svg");
console.log(decodeURIComponent(document.cookie));
const myJsonObj = JSON.parse(decodeURIComponent(document.cookie).split(";")[0].slice(11, ));

// variable for the namspace
const svgns = "http://www.w3.org/2000/svg";
let lastx = 75;
let lasty = 5;
// const myJsonObj = JSON.parse(decodeURIComponent(document.cookie).split(";")[0].slice(11, ));
console.log(myJsonObj);
let funcList = myJsonObj['funcNames'].split(",");
let defList = myJsonObj['defLocs'].split(",");
let ifList = myJsonObj['ifLocs'].split(",");
let elseList = myJsonObj['elseLocs'].split(",");
let forList = myJsonObj['for_list'].split(",");
let whileList = myJsonObj['while_array'].split(",");

function getHeight(sLine, eLine, conValue) {
    return (eLine - sLine) * conValue;
}

function getYcords(sLines, conSLine, conValue) {
    return (sLine - conSline) * conValue;
}

function makeFor__Manual(sLine, eLine, conSline, multiplier) {
    let hei = getHeight(sLine, eLine, 50);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: 80,
            rx:8,
            ry:8,
            y: (sLine - conSline + 1) * 30 + (multiplier) * 445,
            height: hei,
            width: 470,
            class: "for",
            style: "fill:gray;stroke:black;stroke-width:2;"
        },
    });
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "for";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: 80,
        y: (sLine - conSline + 1) * 32 + 20 + (multiplier) * 445
    });
}

function makeIf__Manual(sLine, eLine, conSline, multiplier) {
    let hei = getHeight(sLine, eLine, 50);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: 70,
            y: (sLine - conSline + 1) * 30 + (multiplier) * 445,
            rx:8,
            ry:8,
            height: hei,
            width: 520,
            fill: "green",
            class: "if",
            style: "fill:green;stroke:black;stroke-width:2;"
        },
    });
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "if";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: 75,
        y: (sLine - conSline + 1) * 30 + 20 + (multiplier) * 445,
    });
}

function makeElse__Manual(sLine, eLine, conSline, multiplier) {
    let hei = getHeight(sLine, eLine + 1, 50);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: 70,
            y: (sLine - conSline + 1) * 30 + (multiplier) * 445,
            height: hei,
            rx:8,
            ry:8,
            width: 530,
            fill: "blue",
            class: "else",
            style: "fill:blue;stroke:black;stroke-width:2;"
        },
    });
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "else";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: 75,
        y: (sLine - conSline + 1) * 30 + 20 + (multiplier) * 445
    });
}

function makeWhile__Manual(sLine, eLine, conSline, multiplier) {
    let hei = getHeight(sLine, eLine, 50);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: 75,
            y: (sLine - conSline + 1) * 30 + (multiplier) * 445,
            height: hei,
            width: 500,
            fill: "yellow",
            class: "while",
        },
    });
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "while";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: 75,
        y: (sLine - conSline + 1) * 30 + 20 + (multiplier) * 445
    });
}

function makeIf(totalblock, numberOfIfBlocks, originalx, originaly) {
    let clonex = originalx;
    let cloney = originaly;
    for (let i = 0; i < numberOfIfBlocks; i++) {
        let newRect2 = document.createElementNS(svgns, "rect");
        gsap.set(newRect2, {
            attr: {
                x: clonex,
                y: cloney,
                width: 300 / totalblock,
                height: 150 / totalblock,
                fill: "green",
                class: "target",
            },
        });
        svg.appendChild(newRect2);
        let txt = document.createElementNS(svgns, "text");
        txt.textContent = "if";
        svg.appendChild(txt);
        gsap.set(txt, {
            x: clonex + 10,
            y: cloney + 12
        });
        clonex += (90 / totalblock) + 30;
        cloney += 0;
    }
    return clonex;
}

function makeElse(totalblock, originalx, originaly) {
    let clonex = originalx;
    let cloney = originaly;
    let newRect2 = document.createElementNS(svgns, "rect");
    gsap.set(newRect2, {
        attr: {
            x: clonex,
            y: cloney,
            width: 300 / totalblock,
            height: 150 / totalblock,
            fill: "blue",
            class: "target",
        },
    });
    svg.appendChild(newRect2);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "else";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: clonex + 10,
        y: cloney + 12
    });
    clonex += (90 / totalblock) + 30;
    cloney += 0;
    return clonex;
}

function makeFor(totalblock, originalx, originaly) {
    let clonex = originalx;
    let cloney = originaly;
    let newRect2 = document.createElementNS(svgns, "rect");
    gsap.set(newRect2, {
        attr: {
            x: clonex,
            y: cloney,
            rx:10,
            ry:10,
            width: 300 / totalblock,
            height: 150 / totalblock,
            class: "target",
            style: "fill:red;stroke:black;stroke-width:5;"
        },
    });
    svg.appendChild(newRect2);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "for";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: clonex + 10,
        y: cloney + 12
    });
    clonex += (90 / totalblock) + 30;
    cloney += 0;

    return clonex;
}

function makeWhile(totalblock, originalx, originaly) {
    let clonex = originalx;
    let cloney = originaly;
    let newRect2 = document.createElementNS(svgns, "rect");
    gsap.set(newRect2, {
        attr: {
            x: clonex,
            y: cloney,
            width: 300 / totalblock,
            height: 150 / totalblock,
            fill: "cyan",
            class: "target",
        },
    });
    svg.appendChild(newRect2);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "while";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: clonex + 10,
        y: cloney + 12
    });
    clonex += (90 / totalblock) + 30;
    cloney += 0;
    return clonex;
}

function makeBlock(blockName, start, end, multi) {
    console.log("lastx:" +
        lastx);
    console.log("lasty:" +
        lasty);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: lastx,
            y: lasty,
            rx:6,
            ry:6,
            width: 500,
            height: 400,
            margin: 5,
            class: "target",
            style: "fill:crimson;stroke:black;stroke-width:0;"
        },
    });
    lastx += 0;
    lasty += 425;
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = blockName;
    svg.appendChild(txt);
    gsap.set(txt, {
        x: lastx + 10,
        y: lasty - 410
    });
    let originalx = lastx + 3;
    let originaly = lasty - 195;
    let x = [];
    for (let i = 0; i < ifList.length / 2; i++) {
        const element = parseInt(ifList[i]);
        const elementx = parseInt(ifList[i + (ifList.length) / 2]);
        if (element > start && element - 1 < end) {
            x.push([element, elementx, 'if']);
        }
    }
    for (let i = 0; i < elseList.length; i += 2) {
        const element = parseInt(elseList[i]);
        const elementx = parseInt(elseList[i + 1]);

        if (element > start && elementx < end) {
            x.push([element, elementx, 'else']);
        }
    }
    for (let i = 0; i < forList.length; i += 2) {
        const element = parseInt(forList[i]);
        const elementx = parseInt(forList[i + 1]);
        if (element > start && elementx < end) {
            x.push([element, elementx, 'for']);
        }
    }
    for (let i = 0; i < whileList.length; i += 2) {
        const element = parseInt(whileList[i]);
        const elementx = parseInt(whileList[i + 1]);

        if (element > start && elementx < end) {
            x.push([element, elementx, 'while']);
        }
    }
    x = x.sort(sortFn);

    function sortFn(a, b) {
        if (a[0] === b[0]) {
            return 0;
        } else {
            return (a[0] < b[0]) ? -1 : 1;
        }
    }
    console.log(x);
    let conSline;
    if (x.length != 0) {
        conSline = x[0][0];
    }
    console.log(conSline);
    for (let i = 0; i < x.length; i++) {
        const element = x[i];
        if (element[2] == "for") {
            makeFor__Manual(element[0], element[1], conSline, multi);
            // originaly += (150 / x.length);
        }
        if (element[2] == "if") {
            makeIf__Manual(element[0], element[1], conSline, multi);
            // let noOfIf = 1;
            // while (i != x.length && x[i + 1][1] == "if") {
            //     noOfIf++;
            //     i++;
            // }
            // makeIf(x.length, noOfIf, originalx, originaly);
            // originaly += (150 / x.length);
        }
        if (element[2] == "while") {
            makeWhile__Manual(element[0], element[1], conSline, multi);
            // makeWhile(x.length, originalx, originaly);
            // originaly += 15;
        }
        if (element[2] == "else") {
            makeElse__Manual(element[0], element[1], conSline, multi);
            // makeElse(x.length, originalx, originaly);
            // originaly += 15;
        }

    }
}

function detectFuncInFor() {

}
console.log(decodeURIComponent(document.cookie).split(";"));
console.log("Func-> " + funcList);
console.log("def-> " + defList);
console.log("if-> " + ifList);
console.log("else-> " + elseList);
console.log("for-> " + forList);
for (let k = 0, j = 0; k < funcList.length; k++, j += 2) {
    console.log(funcList[k]);
    makeBlock(funcList[k], parseInt(defList[j]), parseInt(defList[j + 1]), k);
}

function printwin(){
    window.print();
}


</script>

</html>