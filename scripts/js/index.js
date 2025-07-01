var employees = [{
    name: "",
    email: "",
    phone: "",
    address: "",
    pSchool: "",
    hSchool: "",
    college: "",
}];

var provinces = [
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

document.addEventListener("DOMContentLoaded", function() {
    var select = document.getElementById("inputState");
    select.innerHTML = '<option selected>...</option>';
    provinces.forEach(function(province) {
        var option = document.createElement("option");
        option.value = province;
        option.text = province;
        select.appendChild(option);
    });
});