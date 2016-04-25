(function(){
"use strict"
    var leftInput = document.getElementById('input_a').value;
    var rightInput = document.getElementById('input_b').value;
    var opInput = document.getElementById('input_op').value;
    var totalInput = "0";

    var clear = function (event) {
        rightInput = "";
        document.getElementById('input_b').value = rightInput;
        leftInput = "";
        document.getElementById('input_a').value = leftInput;
        opInput = "";
        document.getElementById('input_op').value = opInput;
    }

    var equal = function (event)  {
        switch (opInput){
            case "+":
                totalInput = parseFloat(leftInput) + parseFloat(rightInput);
                break; 
            case "-":
                totalInput = parseFloat(leftInput) - parseFloat(rightInput);
                break;
            case "*":        
                 totalInput = parseFloat(leftInput) * parseFloat(rightInput);
                break;
            case "/":
                totalInput = parseFloat(leftInput) / parseFloat(rightInput);
                break;
            case "sqrt":
                totalInput = Math.sqrt(leftInput);
                break;
            case "^":
                totalInput = Math.pow(leftInput, rightInput);
                break;
            case "binary":
                totalInput = parseInt(leftInput,10).toString(2);
                break;             
            case "toDecimal":
                totalInput = parseInt(leftInput,2).toString(10);
                break;
            case "toHex":
                totalInput = parseInt(leftInput).toString(16);
                break;
        }
            document.getElementById('input_a').value = totalInput;
            document.getElementById('input_op').value = "";
            document.getElementById('input_b').value = "";
            rightInput = "";
            leftInput = totalInput;
        
    }

    var header = function (event) {
        document.getElementById('main_header').innerHTML = "Algebraic!";
    }

    var inputFirst = function (event) {      
        if (opInput !== "") {
            rightInput = rightInput + this.value;
            document.getElementById('input_b').value = rightInput;
        } else {
            leftInput = leftInput + this.value;
            document.getElementById('input_a').value = leftInput;
        }
    }
            
    function toggle() {
        var ele = document.getElementById("toggleText");
        var text = document.getElementById("bmo_round_button");
            if(ele.style.display == "block") {
                ele.style.display = "none";
                text.innerHTML = "OFF";
            } else {
                ele.style.display = "block";
                text.innerHTML = "ON";
            }
    } 


    var operator = function(event) {
        opInput = this.value;
        document.getElementById('input_op').value = opInput;
    }

// ----------NUMBERS EVENT LISTENER--------

    var numButtons = document.getElementsByClassName('cal_buttons');

    for (var i = 0; i < numButtons.length; i++) {
        numButtons[i].addEventListener('click', inputFirst, false);
    }

// --------OPERATOR EVENT LISTENER

    var opButtons = document.getElementsByClassName('cal_buttons_op');

    for (var i = 0; i < opButtons.length; i++) {
        opButtons[i].addEventListener('click', operator, false);
    }

    
// -------- EVENT LISTENERS
    document.getElementById('bmo_round_button').addEventListener('click', toggle);
    document.getElementById('equalsSign').addEventListener('click', equal);
    document.getElementById('equalsSign').addEventListener('mouseover', header);
    document.getElementById('clear').addEventListener('click', clear);
    document.getElementById('binary').addEventListener('click', equal);
    document.getElementById('toDecimal').addEventListener('click', equal);
    document.getElementById('toHex').addEventListener('click', equal);


})();