function main(){let e=StripCode(text);console.log(e);let n=TabCounter(e);console.log(n),n=TabCount(e),console.log(n),if_pair_array=checkIfInCode(e,n,0),console.log(if_pair_array),for_pair_array=checkForInCode(e,n,0),
console.log(for_pair_array),while_pair_array=checkWhileInCode(e,n,0),console.log(while_pair_array),if_processed_count=Process_if_array(if_pair_array),console.log(if_processed_count)}
let text="for i in range(9):\n        if i == 0:\n            print('I is zero')\n        elif i%2==0:\n            print('I is even')\n        elif i%3 ==  0:\n            print(\"Hiii\")\n        else:\n            print('I is Odd')\n"
;function StripCode(e){return e.split("\n")}function TabCount(e){let n=[];for(const o of e)if(""===o)n.push(0);else{let e=0;for(var r=0;r<o.length;r++){if("\t"!==o.charAt(r)){if("#"===o.charAt(r)){e+=1e6;break}break}e++}n.push(e)}return n}
function TabCounter(e){let n=[];for(const i of e)if(""===i)n.push(0);else{for(var r=0,o=0;"\t"===i.charAt(o++);)r++;n.push(r)}return n}function check_if(e){
return!(e.includes("#",0)&&e.indexOf("#")<e.indexOf("if"))&&(e.includes("if ",0)||e.includes("if(",0))}function checkIfInCode(e,n,r){let o=[[],[]];for(var i=r;i<e.length;i++)if(check_if(e[i])){o[0].push(i)
;for(var t=i+1;t<e.length;t++)if(n[t]<=n[i]){o[1].push(t);break}}return o}function check_for(e){return!(e.includes("#",0)&&e.indexOf("#")<e.indexOf("for"))&&e.includes("for",0)}function checkForInCode(e,n,r){let o=[]
;for(var i=r;i<e.length;i++)if(check_for(e[i])){o.push(i);for(var t=i+1;t<e.length;t++)if(n[t]<=n[i]){o.push(t);break}}return o}function check_else(e){return!(e.includes("#",0)&&e.indexOf("#")<e.indexOf("else"))&&e.includes("else",0)}
function checkElseInCode(e,n,r){let o=[];for(var i=r;i<e.length;i++)if(check_else(e[i])){o.push(i);for(var t=i+1;t<e.length;t++)if(n[t]<=n[i]){o.push(t);break}}return o}function check_while(e){
return!(e.includes("#",0)&&e.indexOf("#")<e.indexOf("while"))&&(e.includes("while ",0)||e.includes("while ",0))}function checkWhileInCode(e,n,r){let o=[];for(var i=r;i<e.length;i++)if(check_while(e[i])){o.push(i)
;for(var t=i+1;t<e.length;t++)if(n[t]<=n[i]){o.push(t);break}}return o}function __Process_if_array(e){if_processed_count=[],pos_array=[];for(var n=0;n<e.length-1;n++)e[n][1]===e[n+1][0]&&pos_array.push(n);console.log(pos_array)
;for(n=0;n<e.length;n++)if(-1===pos_array.indexOf(n))if_processed_count.push(e[n][0]),if_processed_count.push(e[n][1]);else{for(if_processed_count.push(e[n][0]);-1!=pos_array.indexOf(++n);)console.log("Hi");console.log(if_processed_count),
if_processed_count.push(e[n][1])}return if_processed_count}function Process_if_array(e){let n=[],r=[];for(var o=0;o<e[0].length-1;o++)e[1][o]===e[0][o+1]&&r.push(o);console.log(r);for(o=0;o<e.length;o++)if(-1===r.indexOf(o))n.push(e[0][o]),
n.push(e[1][o]);else{for(n.push(e[0][o]);-1!=r.indexOf(++o);)console.log("Hii");n.push(e[1][o])}return n}function GetFlowOfProgram(e){code_lines=StripCode(e),initial_tab_count=TabCount(code_lines),
if_array=checkIfInCode(code_lines,initial_tab_count,0),for_array=checkForInCode(code_lines,initial_tab_count,0),while_array=checkWhileInCode(code_lines,initial_tab_count,0)}function checkIfInCode(e,n,r){let o=[[],[]]
;for(var i=r;i<e.length;i++)if(check_if(e[i])){o[0].push(i);for(var t=i+1;t<e.length;t++)if(n[t]<=n[i]){o[1].push(t);break}}return o}function check_def(e){return!(e.includes("#",0)&&e.indexOf("#")<e.indexOf("def"))&&e.includes("def ",0)}
function get_function_name(e,n){let r=[];for(var o=0;o<n[0].length;o++){let i=e[n[0][o].indexOf(" ")],t=e[n[0][o].indexOf("(")],c=e[0][o].slice(i+1,t);c=c.trim(),r.push(c)}return r}function get_func_parameter(e,n,r){
if(r>=n[0].length)return null;let o=e[n[0][r]];return first_brac_pos=o.indexOf("("),last_brac_pos=o.lastIndexOf(")"),o.slice(first_brac_pos+1,last_brac_pos).split(",")}function _get_func_parameter_count(e,n){param_count=[]
;for(var r=0;r<n[0].length;r++){let r=e[n[0][func_index]];first_brac_pos=name.indexOf("("),last_brac_pos=name.lastIndexOf(")");for(var o=!1,i=first_brac_pos+1;i<last_brac_pos;i++)if(" "!=r.charAt(i)||""!==r.chatAt(i)){
param_count.push(r.split(",").length),o=!0;break}o||param_count.push(0)}}
