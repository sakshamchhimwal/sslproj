document.addEventListener("keydown", keyPressed);
function keyPressed(e) {
  if (e["key"] === "Enter") {
    let code = document.getElementById("inputArea")["value"];
    code = code.split("\n").join("\\");
    console.log(code);
  }
}
