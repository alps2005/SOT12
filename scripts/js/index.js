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
document.getElementById("submitButton").addEventListener("click", function() {
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
    //If there is no empty stuff add them to the employees array
    var employees = [{
        name: document.getElementById("inputName").value,
        email: document.getElementById("inputEmail").value,
        phone: document.getElementById("inputPhone").value,
        address: document.getElementById("inputAddress").value,
        province: document.getElementById("inputState").value,
        zipcode: document.getElementById("inputZip").value,
        pSchool: document.getElementById("inputPSchool").value,
        hSchool: document.getElementById("inputHSchool").value,
        college: document.getElementById("inputCollege").value,
        degreeTitle: document.getElementById("inputDegreeTitle").value,
        jobPosition: document.getElementById("inputJobPosition").value,
        experience: document.getElementById("inputExperience").value,
        spouse: document.getElementById("inputSpouse").value,
        childrenQ: document.getElementById("inputChildrenQ").value
    }]
    for (var i = 0; i < employees.length; i++){
        console.log(employees[i]);
    };
    //Clear the form for each input and select
    document.querySelectorAll('input').forEach(input => {
        input.value = "";
    });
    document.querySelectorAll('select').forEach(select => {
        select.value = "...";
    });
    //Alert to confirm the employee was added successfully
    alert(`Nuevo empleado agregado: ${employees[0].name}`);
});