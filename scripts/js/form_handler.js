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
    var select = document.getElementById("inputState");
    select.innerHTML = '<option selected>...</option>';
        states.forEach(function(state) {
            var option = document.createElement("option");
            option.value = state;
            option.text = state;
            select.appendChild(option);
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
        if (input.value.trim() === ""){
            emptyInput = true;
        }
    });
    document.querySelectorAll('select').forEach(select => {
        if (select.value === "..."){
            invalidSelect = true;
        }
    })
    if (emptyInput || invalidSelect){
        alert("Existen campos vacios o invalidos!");
        return;
    }
    
    // If validation passes, submit the form
    document.querySelector('form').submit();
});