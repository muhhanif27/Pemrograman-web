const display = document.querySelector("#display");
const buttons = document.querySelectorAll("button");


buttons.forEach((item) => {
  item.onclick = () => {
      if (item.id == "clear") {
          display.innerText = "";
      } else if (item.id == "backspace") {
          let string = display.innerText.toString();
          display.innerText = string.substr(0, string.length - 1);
      } else if (display.innerText != "" && item.id == "equal") {
          try {
              let expression = display.innerText
                  .replace(/(\d)(\()/g, "$1*(")
                  .replace(/(\))(\d)/g, "$1*$2")
                  .replace(/MOD/g, '%')
                  .replace(/\^/g, '**');;
              display.innerText = eval(expression.replace(/×/g, '*').replace(/÷/g, '/'));
          } catch (error) {
              display.innerText = "Error";
              setTimeout(() => (display.innerText = ""), 2000);
          }
      } else if (display.innerText == "" && item.id == "equal") {
          display.innerText = "No input";
          setTimeout(() => (display.innerText = ""), 2000);
      } else if (item.id == "exponentiation") {
          display.innerText += "^";
      } else if (item.id == "modulus") {
          display.innerText += "MOD";
      } else if (item.id == "percent") {
          let currentValue = parseFloat(display.innerText);
          if (!isNaN(currentValue)) {
              display.innerText = currentValue / 100;
          }
      } else if (item.id == "comma") {
          display.innerText += ".";
      } else {
          if (item.innerText === "(" && /\d$/.test(display.innerText)) {
              display.innerText += "(";
          } else if (item.innerText === ")" && /\d$/.test(display.innerText)) {
              display.innerText += ")";
          } else {
              display.innerText += item.innerText;
          }
      }
  };
});


const themeToggleBtn = document.querySelector("#toggle-switch");
const calculator = document.querySelector(".calculator");
const body = document.querySelector("body");

themeToggleBtn.addEventListener("change", () => {
    if (themeToggleBtn.checked) {
        calculator.classList.remove("dark");
        body.classList.remove("dark");
    } else {
        calculator.classList.add("dark");
        body.classList.add("dark");
    }
});

document.addEventListener("DOMContentLoaded", () => {
  calculator.classList.add("dark");
  body.classList.add("dark");
});
