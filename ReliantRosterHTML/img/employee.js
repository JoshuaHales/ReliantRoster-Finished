window.onload = function () {
    var createEmployeeForm = document.getElementById('createEmployeeForm'); 
    if (createEmployeeForm !== null) {
        createEmployeeForm.addEventListener('submit', validateEmployeeForm); //Called when creating employee form is submitted 
    }
    var editEmployeeForm = document.getElementById('editEmployeeForm1');
    if (editEmployeeForm !== null) {
        editEmployeeForm.addEventListener('submit', validateEmployeeForm); //Called when editing employee form is submitted 
    }
    var editEmployeeBtn = document.getElementById('editEmployeeBtn');
    if (editEmployeeBtn !== null) {
        editEmployeeBtn.addEventListener('click', displayEditEmployeeForm); //Called when edit button is pressed on single employee 
    }
    var deleteEmployeeBtn1 = document.getElementById('deleteSelectedEmployees');
    if (deleteEmployeeBtn1 !== null) {
        deleteEmployeeBtn1.addEventListener('click', deleteEmoloyeeBtnPressed); //Called when multiple employees are selected to be deleted 
    }
    // define an event listener for any '.deleteRoster' links
    var deleteLinks = document.getElementsByClassName('deleteEmployee');
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink); //Called when delete employee button is pressed 
    }
    var employeeForm = document.getElementById('employeeForm');
    if (employeeForm !== null) {
        employeeForm.addEventListener('submit', deleteSelectedEmployees); //Called when multiple employees are selected to be deleted 
    }
    function displayEditEmployeeForm(event) {
        var button = event.target;
        document.location.href = "editEmployeeForm.php?id=" + button.dataset.employeeID; //Display editEmployeeForm with the values of the employee selected 
    }
    //Code To Prompt User With Delete Message:
    function deleteEmoloyeeBtnPressed(event) {
        var button = event.target;
        if (confirm(" Are you sure you want to delete this Employee?")) {
            document.location.href = "deleteEmployee.php?id=" + button.dataset.employeeID; //Show prompt to screen go deleteEmployee.php 
        }
    }
    //-------------------------------
    function validateEmployeeForm(event) {
        var form = event.target; //Get values from create and edit employee forms
        var name = form['name'].value;        
        var email = form['email'].value;
        var username = form['username'].value;
        var password = form['password'].value;
        var spanElements = document.getElementsByClassName("error"); 
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }
        var errors = new Object(); //Create error array to hold error messages 
        /* NAME START */
        if (name === "") { //Checking if values below are null, if are create error message for each field 
            errors["name"] = "* Name cannot be empty\n";
        }
        /* NAME END */
        
        /* EMAIL START */
        if (email === "") {
            errors["email"] = "* Email cannot be empty\n";
        }
        if(email !== '' && email.indexOf('@') === -1)
        {
          errors["email"] = "* Incorrect email format\n";
        }
        /* EMAIL END */
   
        /* USERNAME START */
        if (username === "") {
            errors["username"] = "* Username cannot be empty\n";
        }
        /* USERNAME END */
        
        /* PASSWORD START */
        if (password === "") {
            errors["password"] = "* Password cannot be empty\n"; 
        }
        /* PASSWROD END */
        
        var valid = true;
        for (var index in errors) { //If there is error messages display messages to user 
            valid = false;
            var errorMessage = errors[index];
            var spanElement = document.getElementById(index + "Error");
            console.log(spanElements);
            console.log(spanElement);
            spanElement.innerHTML = errorMessage;
        }
        if (!valid || !confirm("Is the form data correct?")) { //If values are ok primp prompt message to user 
            event.preventDefault();
        }
    }
    //Code To Validate Delete Link:
    function deleteLink(event) {
        if (!confirm("Are you sure you want to delete this Employee?")) { //Ask if user wishes to continue deleting employees 
            event.preventDefault();
        }
    }
    //Code To Validate Delete Selected Link:
    function deleteSelectedEmployees(event) {
        var selected = false;
        var deleteCheckBoxes = document.getElementsByClassName("deleteEmployees"); //Deletes employee if the assigned checkbox is clicked for them 
        for (var i = 0; i !== deleteCheckBoxes.length; i++) {
            var cb = deleteCheckBoxes[i];
            if (cb.checked) { //Set the checkbox values 
                selected = true;
            }
        }
        if (!selected || !confirm("* Are you sure you want to delete this Employee?")) { //Ask if user wishes to continue deleting employees 
            event.preventDefault();
        }
    }
};