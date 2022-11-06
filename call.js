document.addEventListener("keydown", keyPressed);
async function callPyodide(code) {
  let pyodide = await loadPyodide();
  console.log(pyodide.runPython(code));
}
function keyPressed(e) {
  if (e["key"] === "Enter") {
    code = document.getElementById("inputArea")["value"];
  }
}
