window.onload = function() {
    var createRosterForm = document.getElementById('createRosterForm');
    if (createRosterForm !== null) {
        createRosterForm.addEventListener('submit', validateRosterForm); //Called when creating roster form is submitted 
    }
    var editRosterForm = document.getElementById('editRosterForm');
    if (editRosterForm !== null) {
        editRosterForm.addEventListener('submit', validateRosterForm); //Called when editing roster form is submitted 
    }
    var editRosterBtn = document.getElementById('editRosterBtn');
    if (editRosterBtn !== null) {
        editRosterBtn.addEventListener('click', displayEditRosterForm); //Called when edit button is pressed on single roster 
    }
    var deleteRosterBtn = document.getElementById('deleteRosterBtn');
    if (deleteRosterBtn !== null) {
        deleteRosterBtn.addEventListener('click', deleteRosterBtnPressed); //Called when multiple rosters are selected to be deleted 
    }
    var deleteRosterBtn1 = document.getElementById('deleteSelectedRosters'); //Called when multiple rosters are selected to be deleted 
    if (deleteRosterBtn1 !== null) {
        deleteRosterBtn1.addEventListener('click', deleteRosterBtnPressed);
    }
    // define an event listener for any '.deleteRoster' links
    var deleteLinks = document.getElementsByClassName('deleteRoster'); //Called when delete roster button is pressed 
    for (var i = 0; i !== deleteLinks.length; i++) {
        var link = deleteLinks[i];
        link.addEventListener("click", deleteLink);
    }
    var rosterForm = document.getElementById('rosterForm');
    if (rosterForm !== null) {
        rosterForm.addEventListener('submit', deleteSelectedRosters); //Called when multiple rosters are selected to be deleted 
    }
    function displayEditRosterForm(event) {
        var button = event.target;
        document.location.href = "editRosterForm.php?id=" + button.dataset.rosterID; //Display editRosterForm with the values of the roster selected 
    }
    //Code To Prompt User With Delete Message:
    function deleteRosterBtnPressed(event) {
        var button = event.target;
        if (confirm(" Are you sure you want to delete this Roster?")) {
            document.location.href = "deleteRoster.php?id=" + button.dataset.rosterID; //Show prompt to screen go deleteRoster.php 
        }
    }
    //-------------------------------
    function validateRosterForm(event) {
        var form = event.target; //Get values from create and edit rosters forms
        var title = form['title'].value;
        var monday = form['monday'].value;
        var monday2 = form['monday2'].value;
        var tuesday = form['tuesday'].value;
        var tuesday2 = form['tuesday2'].value;
        var wednesday = form['wednesday'].value;
        var wednesday2 = form['wednesday2'].value;
        var thursday = form['thursday'].value;
        var thursday2 = form['thursday2'].value;
        var friday = form['friday'].value;
        var friday2 = form['friday2'].value;
        var saturday = form['saturday'].value;
        var saturday2 = form['saturday2'].value;
        var sunday = form['sunday'].value;
        var sunday2 = form['sunday2'].value;
        var employeeID = form['employeeID'].value;
        var spanElements = document.getElementsByClassName("error");
        for (var i = 0; i !== spanElements.length; i++) {
            spanElements[i].innerHTML = "";
        }
        var errors = new Object(); //Create error array to hold error messages 
        /* TITLE START */
        if (title === "") { //Checking if values below are null, if are create error message for each field 
            errors["title"] = "Title cannot be empty\n";
        }
        /* TITLE END */

        /* DISCRIPTION END */

        /* MONDAY START */
        if (monday === "" || monday2 === "") {
            errors["monday"] = "Monday cannot be empty.\n";
        }
        if (monday === "OFF" && monday2 !== "OFF") { //Checking if values are incorrect for the time values
            errors["monday"] = "Incorrect times.\n";
        }
        if (monday !== "OFF" && monday2 === "OFF") {
            errors["monday"] = "Incorrect times.\n";
        }
        /* MONDAY END */

        /* TUESDAY START */
        if (tuesday === "" || tuesday2 === "") {
            errors["tuesday"] = "Tuesday cannot be empty.\n";
        }
        if (tuesday === "OFF" && tuesday2 !== "OFF") {
            errors["tuesday"] = "Incorrect times.\n";
        }
        if (tuesday !== "OFF" && tuesday2 === "OFF") {
            errors["tuesday"] = "Incorrect times.\n";
        }
        /* TUESDAY END */

        /* WEDNESDAY START */
        if (wednesday === "" || wednesday2 === "") {
            errors["wednesday"] = "Wednesday cannot be empty.\n";
        }
        if (wednesday === "OFF" && wednesday2 !== "OFF") {
            errors["wednesday"] = "Incorrect times.\n";
        }
        if (wednesday !== "OFF" && wednesday2 === "OFF") {
            errors["wednesday"] = "Incorrect times.\n";
        }
        /* WEDNESDAY END */

        /* THURSDAY START */
        if (thursday === "" || thursday2 === "") {
            errors["thursday"] = "Thursday cannot be empty.\n";
        }
        if (thursday === "OFF" && thursday2 !== "OFF") {
            errors["thursday"] = "Incorrect times.\n";
        }
        if (thursday !== "OFF" && thursday2 === "OFF") {
            errors["thursday"] = "Incorrect times.\n";
        }
        /* THURSDAY END */

        /* FRIDAY START */
        if (friday === "" || friday2 === "") {
            errors["friday"] = "Friday cannot be empty.\n";
        }
        if (friday === "OFF" && friday2 !== "OFF") {
            errors["friday"] = "Incorrect times.\n";
        }
        if (friday !== "OFF" && friday2 === "OFF") {
            errors["friday"] = "Incorrect times.\n";
        }
        /* FRIDAY END */

        /* SATURDAY START */
        if (saturday === "" || saturday2 === "") {
            errors["saturday"] = "Saturday cannot be empty.\n";
        }
        if (saturday === "OFF" && saturday2 !== "OFF") {
            errors["saturday"] = "Incorrect times.\n";
        }
        if (saturday !== "OFF" && saturday2 === "OFF") {
            errors["saturday"] = "Incorrect times.\n";
        }
        /* SATURDAY END */

        /* SUNDAY START */
        if (sunday === "" || sunday2 === "") {
            errors["sunday"] = "Sunday cannot be empty.\n";
        }
        if (sunday === "OFF" && sunday2 !== "OFF") {
            errors["sunday"] = "Incorrect times.\n";
        }
        if (sunday !== "OFF" && sunday2 === "OFF") {
            errors["sunday"] = "Incorrect times.\n";
        }
        /* SUNDAY END */
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
        if (!confirm("Are you sure you want to delete this Roster?")) { //Ask if user wishes to continue deleting rosters 
            event.preventDefault();
        }
    }
    //Code To Validate Delete Selected Link:
    function deleteSelectedRosters(event) {
        var selected = false;
        var deleteCheckBoxes = document.getElementsByClassName("deleteRosters"); //Deletes rosters if the assigned checkbox is clicked for them 
        for (var i = 0; i !== deleteCheckBoxes.length; i++) {
            var cb = deleteCheckBoxes[i];
            if (cb.checked) {
                selected = true;
            }
        }
        if (!selected || !confirm("* Are you sure you want to delete this Roster?")) { //Ask if user wishes to continue deleting rosters 
            event.preventDefault();
        }
    }
};