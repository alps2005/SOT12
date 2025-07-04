<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $pschool = $_POST["pschool"];
    $hschool = $_POST["hschool"];
    $college = $_POST["college"];
    $degree = $_POST["degree"];
    $job = $_POST["job"];
    $experience = $_POST["experience"];
    $spouse = $_POST["spouse"];
    $children = $_POST["children"];

    #Database connection
    $conn = new mysqli('localhost', 'root', '', 'employees_db');
    if ($conn -> connect_error){
        die("Connection failed: ".$conn -> connect_error);
    }else{
        $stmt = $conn -> prepare("INSERT INTO Employees(emp_name, emp_email, emp_phone, emp_address, emp_state, emp_zipcode, emp_pschool, emp_hschool, emp_college, emp_degree, emp_jobposition, emp_experience, emp_spouse, emp_childrenq) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt -> bind_param('sssssssssssssi', $name, $email, $phone, $address, $state, $zip, $pschool, $hschool, $college, $degree, $job, $experience, $spouse, $children);
            
            if ($stmt -> execute()) {
                echo "<script>
                    alert('Empleado agregado exitosamente');
                    window.location.href = '../../html/insert_page.html';
                </script>";
            } else {
                echo "<script>
                    alert('Error al agregar empleado: " . $stmt->error . "');
                    window.location.href = '../../html/insert_page.html';
                </script>";
            }
            $stmt -> close();
        } else {
            echo "<script>
                alert('Error en la preparacion de la consulta: " . $conn->error . "');
                window.location.href = '../../html/insert_page.html';
            </script>";
        }
        $conn -> close();
    }
?>