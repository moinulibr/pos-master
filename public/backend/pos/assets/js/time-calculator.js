
jQuery('body').on('click', function (e) {
    if (!jQuery('.dropdown.mega-dropdown').is(e.target) 
        && jQuery('.dropdown.mega-dropdown').has(e.target).length === 0 
        && jQuery('.open').has(e.target).length === 0
    ) {
      jQuery('.dropdown.mega-dropdown').removeClass('open');
      jQuery('#id2').attr('aria-expanded', 'false');
      jQuery('.calu').removeClass('show');
    }
  });
  "use strict";
  jQuery('.dropdown.mega-dropdown .topbar-item').on('click', function (event) {
    jQuery(this).parent().toggleClass('open');
     jQuery('#id2').attr('aria-expanded', 'true');
     jQuery('.calu').addClass('show');
  });
  
  

// Custom for pacejs
paceOptions = {
    elements: true
  };
  var input = document.getElementById('input'), // input/output button
    number = document.querySelectorAll('.numbers div'), // number buttons
    operator = document.querySelectorAll('.operators div'), // operator buttons
    result = document.getElementById('result'), // equal button
    clear = document.getElementById('clear'), // clear button
    resultDisplayed = false; // flag to keep an eye on what output is displayed
  
  // adding click handlers to number buttons
  for (var i = 0; i < number.length; i++) {
    number[i].addEventListener("click", function(e) {
  
      // storing current input string and its last character in variables - used later
      var currentString = input.innerHTML;
      var lastChar = currentString[currentString.length - 1];
  
      // if result is not diplayed, just keep adding
      if (resultDisplayed === false) {
        input.innerHTML += e.target.innerHTML;
      } else if (resultDisplayed === true && lastChar === "+" || lastChar === "-" || lastChar === "×" || lastChar === "÷") {
        // if result is currently displayed and user pressed an operator
        // we need to keep on adding to the string for next operation
        resultDisplayed = false;
        input.innerHTML += e.target.innerHTML;
      } else {
        // if result is currently displayed and user pressed a number
        // we need clear the input string and add the new input to start the new opration
        resultDisplayed = false;
        input.innerHTML = "";
        input.innerHTML += e.target.innerHTML;
      }
  
    });
  }
  
  // adding click handlers to number buttons
  for (var i = 0; i < operator.length; i++) {
    operator[i].addEventListener("click", function(e) {
  
      // storing current input string and its last character in variables - used later
      var currentString = input.innerHTML;
      var lastChar = currentString[currentString.length - 1];
  
      // if last character entered is an operator, replace it with the currently pressed one
      if (lastChar === "+" || lastChar === "-" || lastChar === "×" || lastChar === "÷") {
        var newString = currentString.substring(0, currentString.length - 1) + e.target.innerHTML;
        input.innerHTML = newString;
      } else if (currentString.length == 0) {
        // if first key pressed is an opearator, don't do anything
      } else {
        // else just add the operator pressed to the input
        input.innerHTML += e.target.innerHTML;
      }
  
    });
  }
  
  // on click of 'equal' button
  result.addEventListener("click", function() {
  
    // this is the string that we will be processing eg. -10+26+33-56*34/23
    var inputString = input.innerHTML;
  
    // forming an array of numbers. eg for above string it will be: numbers = ["10", "26", "33", "56", "34", "23"]
    var numbers = inputString.split(/\+|\-|\×|\÷/g);
  
    // forming an array of operators. for above string it will be: operators = ["+", "+", "-", "*", "/"]
    // first we replace all the numbers and dot with empty string and then split
    var operators = inputString.replace(/[0-9]|\./g, "").split("");
  
    // now we are looping through the array and doing one operation at a time.
    // first divide, then multiply, then subtraction and then addition
    // as we move we are alterning the original numbers and operators array
    // the final element remaining in the array will be the output
  
    var divide = operators.indexOf("÷");
    while (divide != -1) {
      numbers.splice(divide, 2, numbers[divide] / numbers[divide + 1]);
      operators.splice(divide, 1);
      divide = operators.indexOf("÷");
    }
  
    var multiply = operators.indexOf("×");
    while (multiply != -1) {
      numbers.splice(multiply, 2, numbers[multiply] * numbers[multiply + 1]);
      operators.splice(multiply, 1);
      multiply = operators.indexOf("×");
    }
  
    var subtract = operators.indexOf("-");
    while (subtract != -1) {
      numbers.splice(subtract, 2, numbers[subtract] - numbers[subtract + 1]);
      operators.splice(subtract, 1);
      subtract = operators.indexOf("-");
    }
  
    var add = operators.indexOf("+");
    while (add != -1) {
      // using parseFloat is necessary, otherwise it will result in string concatenation :)
      numbers.splice(add, 2, parseFloat(numbers[add]) + parseFloat(numbers[add + 1]));
      operators.splice(add, 1);
      add = operators.indexOf("+");
    }
  
    input.innerHTML = numbers[0]; // displaying the output
  
    resultDisplayed = true; // turning flag if result is displayed
  });
  
  // clearing the input on press of clear
  clear.addEventListener("click", function() {
    input.innerHTML = "";
  })



  jQuery(document).ready(function() {
    // Create two variables with names of months and days of the week in the array
    var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
    var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
    
    // Create an object newDate()
    var newDate = new Date();
    //console.log(newDate.toLocaleString('en-US', { hour: 'numeric', hour12: true }));
    // Retrieve the current date from the Date object
    newDate.setDate(newDate.getDate());
    // At the output of the day, date, month and year    
    jQuery('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());
    

    setInterval( function() {
        // Create an object newDate () and extract the second of the current time
        var seconds = new Date().getSeconds();
        // Add a leading zero to the value of seconds
        jQuery("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
        },1000);
        
    setInterval( function() {
        // Create an object newDate () and extract the minutes of the current time
        var minutes = new Date().getMinutes();
        // Add a leading zero to the minutes
        jQuery("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
        },1000);
        
    setInterval( function() {
        // Create an object newDate () and extract the clock from the current time
        //var hours = new Date.getHours();
        // Add a leading zero to the value of hours
        var hours = formatAMPM();
        jQuery("#hours").html(( hours < 10 ? "0" : "" ) + hours);
      }, 1000);
        
    }); 

    function formatAMPM() {
      var hours   = new Date().getHours();
      var minutes = new Date().getMinutes();
      var ampm = hours >= 12 ? 'pm' : 'am';
      hours = hours % 12;
      hours = hours ? hours : 12; // the hour '0' should be '12'
      minutes = minutes < 10 ? '0'+minutes : minutes;
      //var strTime = hours + ':' + minutes + ' ' + ampm;
      var strTime = hours;
      return strTime;
    }
    //console.log(formatAMPM(new Date));
    //var asiaDhaka = new Date().toLocaleString([], { timeZone: "Asia/Dhaka" });