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

// Function to handle the form submission
async function handleFormSubmit(event) {
    event.preventDefault(); // Prevent the normal form submission
    
    // Create object with the employee data
    const employeeData = {
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
    };

    try {
        // Show loading indicator
        showLoading(true);
        
        // Send data to the server
        const response = await fetch('save_employee.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(employeeData)
        });

        const result = await response.json();

        if (result.success) {
            // Clear the form
            clearForm();
            
            // Show success message
            alert(`Empleado guardado exitosamente: ${result.employee_name}`);
            
            console.log('Empleado guardado con ID:', result.employee_id);
        } else {
            // Show error
            alert(`Error: ${result.message}`);
        }
        
    } catch (error) {
        console.error('Error al enviar datos:', error);
        alert('Error de conexión. Por favor, intenta nuevamente.');
    } finally {
        // Hide loading indicator
        showLoading(false);
    }
}

// Function to clear the form
function clearForm() {
    document.querySelectorAll('input').forEach(input => {
        input.value = "";
    });
    document.querySelectorAll('select').forEach(select => {
        select.value = "...";
    });
}

// Function to show/hide loading indicator
function showLoading(isLoading) {
    const submitButton = document.querySelector('button[type="submit"]');
    if (submitButton) {
        submitButton.disabled = isLoading;
        submitButton.textContent = isLoading ? 'Guardando...' : 'Enviar';
    }
}

// Function to validate the form before sending
function validateForm() {
    const name = document.getElementById("inputName").value.trim();
    const email = document.getElementById("inputEmail").value.trim();
    
    if (!name) {
        alert('El nombre es requerido');
        return false;
    }
    
    if (!email) {
        alert('El email es requerido');
        return false;
    }
    
    // Validar formato de email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Por favor, ingresa un email válido');
        return false;
    }
    
    return true;
}

// Assign the event listener to the form when the page loads
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('employeeForm'); // Asegúrate de que tu formulario tenga este ID
    
    if (form) {
        form.addEventListener('submit', function(event) {
            if (validateForm()) {
                handleFormSubmit(event);
            } else {
                event.preventDefault();
            }
        });
    }
});

// Additional function to get all employees (optional)
async function getAllEmployees() {
    try {
        const response = await fetch('get_employees.php');
        const employees = await response.json();
        return employees;
    } catch (error) {
        console.error('Error al obtener empleados:', error);
        return [];
    }
}