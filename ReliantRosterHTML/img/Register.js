//Registration JS Validation:
function validateRegistration(event) { //Functioin called by register.php class
    var form = event.target;
    var username = form['username'].value; //Pulling in the form table inputs values 
    var password = form['password'].value;
    var password2 = form['password2'].value;

    var spanElements = document.getElementsByClassName("error");
    for (var i = 0; i !== spanElements.length; i++) {
        spanElements[i].innerHTML = "";
    }

    var errors = new Object(); //Creating array to hold error values 
    //If/Else Statements:
    if (username === "") { //Checking if values are null set error message below 
        errors["username"] = "* Username cannot be empty\n";
    }
    if (password === "") {
        errors["password"] = "* Password cannot be empty\n";
    }
    if (password2 === "") {
        errors["password2"] = "* Password2 cannot be empty\n";
    }
    else if (password === password2) { //If passwords values mathc set error message below 
        errors["password2"] = "* Passwords must match\n"; 
    }
    //If Invalid:
    var valid = true;
    for (var index in errors) { //If there are errors 
        valid = false;
        var errorMessage = errors[index];
        var spanElement = document.getElementById(index + "Error"); //Output the errors messages to the users
        spanElement.innerHTML = errorMessage;
    }
    //If valid:
    if (!valid) {
        event.preventDefault();
    }
}

console.log("document loaded");
var registerForm = document.getElementById('registerForm'); //Allow the register form value access


