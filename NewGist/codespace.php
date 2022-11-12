<?php
session_start();
    if(!isset($_SESSION['access_token'])){
        header("Location:../index.php");
    }
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
        code = code.split("\t").join("    ");
        // document.cookie = "ycode = " + code + ";SameSite=None; Secure";
        console.log(document.cookie);
    }
    </script>


</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Ubuntu:wght@400;500;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    color: white;
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

.btn1 {
    z-index: 1000;
    text-decoration: none;
    font-family: "Ubuntu";
    color: crimson;
    font-size: 20px;
    font-weight: 300;
    position: absolute;
    top: 4.3%;
    right: 10%;
}

.btn1:hover {
    color: white;
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
    <a href="../shell.php" class="btn1"> Go To Shell </a>
    <form action="../NewGist/insertgist.php" method="post">
        <pre style="margin: 100px;
    padding: 2px;">
        <textarea cols=80 rows=30 id="inputArea" name="code" style="border: 2px solid crimson;
    border-radius: 6px;
    color: white;
    width:80%;
    resize: none;
    background: rgb(25, 24, 24);

}">
<?php 
    // if(isset($_COOKIE['codeDetail'])){
    //     // shell_exec($code.' > run.py');
    //     // echo shell_exec('python run.py');
    //     $code = explode(",",$_COOKIE['codeDetail']);
    //     $code = $code[9];
    //     $code = explode('"',$code)[3];
    //     $code = explode('\\n',$code);
    //     foreach($code as $ee){
    //         echo $ee;
    //         echo '\n';
    //     }
    // }
?>
</textarea>
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
<<<<<<< Updated upstream
    <pre id="output"
        style="margin-left: 30%; font-size: 20px; border: 2px solid crimson; width: 25%; padding: 10px;"></pre><br>
=======

    <pre id="output" style="margin-left: 30%;
font-size: 20px;
border: 2px solid crimson;
width: 25%;
padding: 10px;">

</pre><br>
>>>>>>> Stashed changes
    <br>

    <button onClick=runCode() style="   margin-left:30%;
    margin-top: 10px;
    padding: 8px;
    color: white;
    background: crimson;
    border: 2px solid crimson;
    border-radius: 6px;
    width: 20%;
    font-size: 20px;">Execute</button>

    <br>
    <br>
    <a href="makeBlock.php" target="_blank" style=" margin-left:30.5%;
    margin-top: 10px;
    
    padding: 8px;
    color: white;
    background: crimson;
    border: 2px solid crimson;
    border-radius: 6px;
    width: 25%;
    font-size: 20px;
    margin-bottom: 10px" target="_blank">Make GUI</button></a>

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

document.getElementById('inputArea').addEventListener('keydown', function(e) {
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
});


/**
 * @param {String} code - Python Code
 * @return the array of stripped code blocks
 */
function StripCode(code) {
    let strippedCode = code.split("\n");
    return strippedCode;
}

/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @return the no. of tabs count before start of the code
 */
function TabCount(iterable_array) {
    let tab_count_array = [];
    for (const line of iterable_array) {
        if (line === "") {
            tab_count_array.push(0);
        } else {
            let count = 0;
            for (var i = 0; i < line.length; i++) {
                if (line.charAt(i) === " ") {
                    count++;
                } else if (line.charAt(i) === '\t') {
                    count = count + 4;
                } else if (line.charAt(i) === "#") {
                    count = count + 1000000;
                    break;
                } else {
                    break;
                }
            }
            tab_count_array.push(count);
        }
    }
    return tab_count_array;
}

/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @return the no. of tabs count in a single line
 */
function TabCounter(iterable_array) {
    let tab_count_array = [];
    for (const line of iterable_array) {
        if (line === "") {
            tab_count_array.push(0);
        } else {
            var count = 0;
            var index = 0;
            while (line.charAt(index++) === "\t") {
                count++;
            }
            tab_count_array.push(count);
        }
    }
    return tab_count_array;
}

/**
 * @param {Stirg}line - the code if in which we need to check if 'if' is present
 * @return {bool} - 'True/False
 */
function check_if(line) {
    //console.log("hi");
    if (line.includes("#", 0)) {
        if (line.indexOf("#") < line.indexOf("if")) {
            return false;
        }
    }
    return (line.includes("if ", 0) || line.includes("if(", 0));
}

/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {Array Object}tab_array - the returned object of TabCounter
 * @param {Int}start_index - the index from which we require to start
 * @return the pair of start and end index of if
 */
function checkIfInCode(iterable_array, tab_array, start_index) {
    let if_dict = [
        [],
        []
    ]
    for (var i = start_index; i < iterable_array.length; i++) {
        if (check_if(iterable_array[i])) {
            if_dict[0].push(i);
            for (var j = i + 1; j < iterable_array.length; j++) {
                if (tab_array[j] <= tab_array[i]) {
                    if_dict[1].push(j);
                    break
                }
            }
        }
    }
    return if_dict;
}

/**
 * @param {Stirg}line - the code if in which we need to check if 'for' is present
 * @return {boolParam}
 */
function check_for(line) {
    if (line.includes("#", 0)) {
        if (line.indexOf("#") < line.indexOf("for")) {
            return false;
        }
    }
    return line.includes("for", 0);
}

/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {Array Object}tab_array - the returned object of TabCounter
 * @param {Int}start_index - the index from which we require to start
 * @return the pair of start and end index of for
 */
function checkForInCode(iterable_array, tab_array, start_index) {
    let for_pair_array = [];
    for (var i = start_index; i < iterable_array.length; i++) {
        if (check_for(iterable_array[i])) {
            for_pair_array.push(i);
            for (var j = i + 1; j < iterable_array.length; j++) {
                if (tab_array[j] <= tab_array[i]) {
                    for_pair_array.push(j - 1);
                    break
                }
            }
        }
    }
    return for_pair_array;
}

/**
 * @param {Stirg}line - the code if in which we need to check if 'else' is present
 * @return {boolParam}
 */
function check_else(line) {
    if (line.includes("#", 0)) {
        if (line.indexOf("#") < line.indexOf("else")) {
            return false;
        }
    }
    return line.includes("else", 0);
}

/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {Array Object}tab_array - the returned object of TabCounter
 * @param {Int}start_index - the index from which we require to start
 * @return the pair of start and end index of else
 */
function checkElseInCode(iterable_array, tab_array, start_index) {
    let else_pair_array = [];
    for (var i = start_index; i < iterable_array.length; i++) {
        if (check_else(iterable_array[i])) {
            else_pair_array.push(i);
            for (var j = i + 1; j < iterable_array.length; j++) {
                if (tab_array[j] <= tab_array[i]) {
                    else_pair_array.push(j - 1);
                    break
                }
            }
        }
    }
    return else_pair_array;
}

/**
 * @param {Stirg}line - the code if in which we need to check if 'while' is present
 * @return {boolParam}
 */
function check_while(line) {
    if (line.includes("#", 0)) {
        if (line.indexOf("#") < line.indexOf("while")) {
            return false;
        }
    }
    return (line.includes("while ", 0) || line.includes("while ", 0));
}

/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {Array Object}tab_array - the returned object of TabCounter
 * @param {Int}start_index - the index from which we require to start
 * @return the pair of start and end index of while
 */
function checkWhileInCode(iterable_array, tab_array, start_index) {
    let while_pair_array = [];
    for (var i = start_index; i < iterable_array.length; i++) {
        if (check_while(iterable_array[i])) {
            while_pair_array.push(i);
            for (var j = i + 1; j < iterable_array.length; j++) {
                if (tab_array[j] <= tab_array[i]) {
                    while_pair_array.push(j - 1);
                    break
                }
            }
        }
    }
    return while_pair_array;
}

/**
 * @NOTE : Do not use this one, made for another type if if_array input
 * @param {ArrayObject} if_count_array - expects the if_count_array
 * @returns its processed version
 */
function __Process_if_array(if_count_array) {
    if_processed_count = [];
    pos_array = []
    for (var i = 0; i < if_count_array.length - 1; i++) {
        if (if_count_array[i][1] === if_count_array[i + 1][0]) {
            pos_array.push(i);
        }
    }
    console.log(pos_array);
    for (var i = 0; i < if_count_array.length; i++) {
        if (pos_array.indexOf(i) === -1) {
            if_processed_count.push(if_count_array[i][0]);
            if_processed_count.push(if_count_array[i][1]);
        } else {
            if_processed_count.push(if_count_array[i][0]);
            while (pos_array.indexOf(++i) != -1) {
                console.log("Hi")
            }; // i++ was a mistake
            console.log(if_processed_count);
            if_processed_count.push(if_count_array[i][1]);
        }
    }
    return if_processed_count;
}

/**
 * @param : {ArrayObject} if_count_array - expects the if_count_array
 * @returns the processed version off iff array
 */
function Process_if_array(if_count_array) {
    let if_processed_count = [];
    let pos_array = [];
    for (var i = 0; i < if_count_array[0].length - 1; i++) {
        if (if_count_array[1][i] === if_count_array[0][i + 1]) {
            pos_array.push(i);
        }
    }
    console.log(pos_array);
    for (var i = 0; i < if_count_array.length; i++) {
        if (pos_array.indexOf(i) === -1) {
            if_processed_count.push(if_count_array[0][i]);
            if_processed_count.push(if_count_array[1][i]);
        } else {
            if_processed_count.push(if_count_array[0][i]);
            while (pos_array.indexOf(++i) != -1) {
                console.log("Hii")
            }; // i++ was a mistake
            if_processed_count.push(if_count_array[1][i]);
        }
    }
    return if_processed_count;
}

/**
 * @param {Code} code_text which requires all the operation
 * @return the control flow of program
 */
function GetFlowOfProgram(Code) {
    code_lines = StripCode(Code);
    initial_tab_count = TabCount(code_lines);
    if_array = checkIfInCode(code_lines, initial_tab_count, 0);
    for_array = checkForInCode(code_lines, initial_tab_count, 0);
    while_array = checkWhileInCode(code_lines, initial_tab_count, 0);
}

/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {Array Object}tab_array - the returned object of TabCounter
 * @param {Int}start_index - the index from which we require to start
 * @return the pair of start and end index of def
 */
function checkDefInCode(iterable_array, tab_array, start_index) {
    let def_dict = [
        [],
        []
    ]
    for (var i = start_index; i < iterable_array.length; i++) {
        if (check_def(iterable_array[i])) {
            def_dict[0].push(i);
            for (var j = i + 1; j < iterable_array.length; j++) {
                if (tab_array[j] <= tab_array[i]) {
                    def_dict[1].push(j);
                    break
                }
            }
        }
    }
    return def_dict;
}


/**
 * @param {Stirg}line - the code if in which we need to check if 'def' is present
 * @return {boolParam}
 */
function check_def(line) {
    if (line.includes("#", 0)) {
        if (line.indexOf("#") < line.indexOf("def")) {
            return false;
        }
    }
    return line.includes("def ", 0);
}


/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {Dict Object}def_dict - the def initial and ending pointa giiven
 * @return {Array Object} - the names of function with index corresponding to the def_dict
 */
function get_function_name(iterable_array, def_dict) {
    let func_names = [];
    for (var i = 0; i < def_dict[0].length; i++) {
        let line = iterable_array[def_dict[0][i]];
        line = line.trimStart();
        let space_pos = line.indexOf(" ");
        let brac_pos = line.indexOf("(");
        let func_name_part = line.slice(space_pos + 1, brac_pos);
        func_name_part = func_name_part.trim();
        func_names.push(func_name_part);
    }
    return func_names;
}


/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {Dict Object}def_dict - the def initial and ending pointa given
 * @param {Int} func_index - the index of the function woy need parameter of
 * @return the function paramms of the given function
 */
function get_func_parameter(iterable_array, def_dict, func_index) {
    if (func_index >= def_dict[0].length) return null;
    let name = iterable_array[def_dict[0][func_index]];
    first_brac_pos = name.indexOf("(");
    last_brac_pos = name.lastIndexOf(")");
    let params = name.slice(first_brac_pos + 1, last_brac_pos);
    let param_array = params.split(",");
    return param_array;
}

/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {Dict Object}def_dict - the def initial and ending pointa given
 * @return {Int} the nu,mber of parameter of each function
 */
function get_func_parameter_count(iterable_array, def_dict) {
    param_count = []
    for (var i = 0; i < def_dict[0].length; i++) {
        let line = iterable_array[def_dict[0][func_index]];
        first_brac_pos = name.indexOf("(");
        last_brac_pos = name.lastIndexOf(")");
        var flag = false;
        for (var j = first_brac_pos + 1; j < last_brac_pos; j++) {
            if (line.charAt(j) != " " || line.chatAt(j) !== "") {
                param_count.push((line.split(",")).length);
                flag = true;
                break;
            }
        }
        if (!flag) {
            param_count.push(0)
        };
    }
}


/**
 * @param {Array Object}iterable_array - intended for the returned object of StripCode
 * @param {if Object}def_dict - the def initial and ending pointa given of the if
 * @return {Array Object} - the names of function with index corresponding to the def_dict
 */
function get_if_condition(iterable_array, if_dict) {
    let if_conditions = [];
    for (var i = 0; i < if_dict[0].length; i++) {
        let line = iterable_array[if_dict[0][i]];
        line = line.trimStart();
        let space_pos = line.indexOf("(");
        let brac_pos = line.indexOf(")");
        let func_name_part = line.slice(space_pos + 1, brac_pos);
        func_name_part = func_name_part.trim();
        if_conditions.push(func_name_part);
    }
    return if_conditions;
}


/**
 * @param {Array_Object} The returned object of the StripCode
 * @param {Array_object} the for array positions
 * @returns NaN if range is not present else the number of iterations are returned
 */
function get_range_for(iterable_array, for_array) {
    let range_list = [];
    for (var i = 0; i < for_array.length; i = i + 2) {
        let line = iterable_array[for_array[i]];
        line = line.trimStart();
        let range_pos = line.indexOf("range(");
        //console.log(range_pos);
        if (range_pos === -1) {
            range_list.push(NaN);
        } else {
            range_pos = range_pos + 6;
            line = line.slice(range_pos);
            let back_pos = line.indexOf(")");
            line = line.slice(0, back_pos);
            line_arr = line.split(",");
            //console.log(line_arr);
            let line_arr_length = line_arr.length;
            if (line_arr_length === 1) {
                let num = Number.parseInt(line_arr[0]);
                range_list.push(num);
            } else if (line_arr_length === 2) {
                let num1 = Number.parseInt(line_arr[0]);
                let num2 = Number.parseInt(line_arr[1]);
                range_list.push(num2 - num1);
            } else if (line_arr_length === 3) {
                let num1 = Number.parseInt(line_arr[0]);
                let num2 = Number.parseInt(line_arr[1]);
                let num3 = Number.parseInt(line_arr[2]);
                let diff = Math.abs(num2 - num1);
                range_list.push(Math.floor(diff / Math.abs(num3)));
            }
        }
        return range_list;
    }
}


function keyPressed(e) {
    if (e["key"] === "Enter") {
        let codee = document.getElementById("inputArea")["value"];
        let code = document.getElementById("inputArea")["value"];
        let codexns = document.getElementById("inputArea")["value"];
        let strip_code = StripCode(code);
        let tab_array = TabCount(strip_code);
        //console.log(tab_array);
        let if_dict = checkIfInCode(strip_code, tab_array, 0);
        let for_list = checkForInCode(strip_code, tab_array, 0);
        let else_array = checkElseInCode(strip_code, tab_array, 0);
        let fun_dict = checkDefInCode(strip_code, tab_array, 0);
        let while_array = checkWhileInCode(strip_code, tab_array, 0);
        let func_name_array = get_function_name(strip_code, fun_dict);
        // console.log(code);
        // console.log("hi");
        // console.log(strip_code);
        // console.log(if_dict);
        // console.log(for_list);
        // console.log(else_array);
        // console.log(fun_dict);
        // console.log(while_array);
        // store = (store, true);
        // setcookie("funcName", store);
        fun_dict = fun_dict.toString();
        func_name_array = func_name_array.toString();
        if_dict = if_dict.toString();
        else_array = else_array.toString();
        forLoc = for_list.toString();
        whileLoc = while_array.toString();
        // cookies.set('funcNames', JSON.strinfigy(func_name_array));
        // cookies.set('defLocs', JSON.strinfigy(fun_dict));
        // cookies.set('ifLocs', JSON.strinfigy(if_dict));
        // cookies.set('elseLocs', JSON.strinfigy(else_array));
        // cookies.set('for_list', JSON.strinfigy(for_list));
        // cookies.set('while_array', JSON.strinfigy(while_array));
        // document.cookie = "funcNames = " + func_name_array +
        //     ";defLocs = " + fun_dict + ";ifLocs = " + if_dict +
        //     ";elseLocs = " + else_array + ";for_list = " + for_list +
        //     ";while_array = " + while_array + ";SameSite=None; Secure";
        // document.cookie = "defLocs = " + fun_dict + ";SameSite=None; Secure";
        // document.cookie = "ifLocs = " + if_dict + ";SameSite=None; Secure";
        // document.cookie = "elseLocs = " + else_array + ";SameSite=None; Secure";
        // document.cookie = "for_list = " + for_list + ";SameSite=None; Secure";
        // document.cookie = "while_array = " + while_array + ";SameSite=None; Secure";
        // setCookie("funcNames", SON.strinfigy(func_name_array), 365);
        codee = codee.split("\r\n").join("\\join");
        codee = codee.split("\t").join("    ");
        // document.cookie = "xcode = " + codee + ";SameSite=None; Secure";
        myJsonObj = {
            xcode: codee,
            funcNames: func_name_array,
            defLocs: fun_dict,
            ifLocs: if_dict,
            elseLocs: else_array,
            for_list: forLoc,
            while_array: whileLoc,
            codexyz: codexns
        }
        // console.log("check cooki");
        // console.log(JSON.stringify(myJsonObj));
        document.cookie = "codeDetail = " + JSON.stringify(myJsonObj) + ";SameSite=None; Secure";
        // document.cookie = "ycode = " + codee + ";SameSite=None; Secure";
        console.log(document.cookie);
        // console.log(document.cookie.split(";"));
    }
}

async function runCode() {
    let codexns = document.getElementById("inputArea")["value"];
    let pyodide = await loadPyodide();
    let result = pyodide.runPython(codexns);
    document.getElementById('output').innerHTML += result + "<br>";
}
</script>

</html>