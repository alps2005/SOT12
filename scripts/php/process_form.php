<?php
    #Get data from the form using the 'POST' method
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

    #Database connection: use your own credentials
    $conn = new mysqli('localhost', 'root', '', 'employees_db');
    if ($conn -> connect_error){
        die("Connection failed: ".$conn -> connect_error); #A message is sent if the connection fails
    }else{
        #Prepare the query to insert the data into the database
        $stmt = $conn -> prepare("INSERT INTO Employees(emp_name, emp_email, emp_phone, emp_address, emp_state, emp_zipcode, emp_pschool, emp_hschool, emp_college, emp_degree, emp_jobposition, emp_experience, emp_spouse, emp_childrenq) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        #If the query is prepared
        if ($stmt) {
            #Bind the parameters to the query; s fro string and i for integer, the order of the parameters is the same as the order of the placeholders in the query
            $stmt -> bind_param('sssssssssssssi', $name, $email, $phone, $address, $state, $zip, $pschool, $hschool, $college, $degree, $job, $experience, $spouse, $children);
            #Execute the query and leace a confirmation message if the data is inserted successfully
            if ($stmt -> execute()) {
                echo "<script>
                    alert('Empleado agregado exitosamente');
                    window.location.href = '../../html/insert_page.html';
                </script>";
            } else {
                #If the query does not execute, a message is sent with the error
                echo "<script>
                    alert('Error al agregar empleado: " . $stmt->error . "');
                    window.location.href = '../../html/insert_page.html';
                </script>";
            }
            #Close the statement
            $stmt -> close();
        } else { #If the query is not prepared, a message is sent with the error
            echo "<script>
                alert('Error en la preparacion de la consulta: " . $conn->error . "');
                window.location.href = '../../html/insert_page.html';
            </script>";
        }
        $conn -> close(); #Close the connection to the database
    }
?>