<?php
    session_start();
    // $funcName = $_COOKIE['funcNames'];
    // $funcName = explode(",",$funcName);
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
    <svg xmlns="http://www.w3.org/2000/svg" width="400" height="1000" viewBox="0 0 400 1000">
        <rect width="100%" height="100%" fill="#000" />
    </svg>
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
            y: (sLine - conSline + 1) * 30 + (multiplier) * 400,
            height: hei,
            width: 240,
            fill: "gray",
            class: "for",
        },
    });
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "for";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: 80,
        y: (sLine - conSline + 1) * 30 + 10 + (multiplier) * 400
    });
}

function makeIf__Manual(sLine, eLine, conSline, multiplier) {
    let hei = getHeight(sLine, eLine, 50);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: 70,
            y: (sLine - conSline + 1) * 30 + (multiplier) * 400,
            height: hei,
            width: 260,
            fill: "green",
            class: "if",
        },
    });
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "if";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: 75,
        y: (sLine - conSline + 1) * 30 + 10 + (multiplier) * 400
    });
}

function makeElse__Manual(sLine, eLine, conSline, multiplier) {
    let hei = getHeight(sLine, eLine + 1, 50);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: 70,
            y: (sLine - conSline + 1) * 30 + (multiplier) * 400,
            height: hei,
            width: 260,
            fill: "blue",
            class: "else",
        },
    });
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = "else";
    svg.appendChild(txt);
    gsap.set(txt, {
        x: 75,
        y: (sLine - conSline + 1) * 30 + 10 + (multiplier) * 400
    });
}

function makeWhile__Manual(sLine, eLine, conSline, multiplier) {
    let hei = getHeight(sLine, eLine, 50);
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
        attr: {
            x: 75,
            y: (sLine - conSline + 1) * 30 + (multiplier) * 400,
            height: hei,
            width: 250,
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
        y: (sLine - conSline + 1) * 30 + 10 + (multiplier) * 400
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
                width: 150 / totalblock,
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
            width: 150 / totalblock,
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
            width: 150 / totalblock,
            height: 150 / totalblock,
            fill: "gray",
            class: "target",
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
            width: 150 / totalblock,
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
            width: 250,
            height: 400,
            fill: "red",
            class: "target",
        },
    });
    lastx += 0;
    lasty += 410;
    svg.appendChild(newRect);
    let txt = document.createElementNS(svgns, "text");
    txt.textContent = blockName;
    svg.appendChild(txt);
    gsap.set(txt, {
        x: lastx + 10,
        y: lasty - 400
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
</script>

</html>