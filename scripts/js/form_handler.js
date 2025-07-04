//Set an array of Ecuadorian states to display in the select element
var states = [
    "Guayas",
    "Manabi",
    "Pichincha",
    "Santa Elena",
    "Azuay",
    "Bolivar",
    "Tungurahua",
    "Imbabura",
    "Loja",
    "Esmeraldas",
    "Pastaza",
    "Chimborazo",
    "Cotopaxi",
    "Morona Santiago",
    "Napo",
    "Orellana"
];
//Event listener that loads the states to the select element
document.addEventListener("DOMContentLoaded", function() {
    var select = document.getElementById("inputState"); //Get the select element by id
    select.innerHTML = '<option selected>...</option>'; //Set the default option to "..."
        states.forEach(function(state) { //Loop through the states array
            var option = document.createElement("option"); //Create a new option element
            option.value = state; //Set the value of the option to the state
            option.text = state; //Set the text of the option to the state
            select.appendChild(option); //Add the option to the select element
        });
});
//Event listener for the submit button
document.getElementById("submitButton").addEventListener("click", function(event) {
    // Prevent default form submission to validate first
    event.preventDefault();
    //Check if there are empty inputs or invalid selects
    let emptyInput = false;
    let invalidSelect = false;
    document.querySelectorAll('input').forEach(input => {
        if (input.value.trim() === ""){ //Check if the input is empty
            emptyInput = true; //Set emptyInput to true
        }
    });
    document.querySelectorAll('select').forEach(select => {
        if (select.value === "..."){ //Check if the select is empty
            invalidSelect = true; //Set invalidSelect to true
        }
    })
    if (emptyInput || invalidSelect){ //Check if there are empty inputs or invalid selects
        alert("Existen campos vacios o invalidos!"); //Show an alert if there are empty inputs or invalid selects
        return;
    }
    
    document.querySelector('form').submit(); //Submit the form
});