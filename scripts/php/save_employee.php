<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir archivo de configuración
require_once 'config.php';

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener datos JSON del cuerpo de la petición
$input = json_decode(file_get_contents('php://input'), true);

// Validar que se recibieron datos
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos válidos']);
    exit;
}

try {
    // Limpiar y validar datos
    $name = cleanInput($input['name'] ?? '');
    $email = cleanInput($input['email'] ?? '');
    $phone = cleanInput($input['phone'] ?? '');
    $address = cleanInput($input['address'] ?? '');
    $province = cleanInput($input['province'] ?? '');
    $zipcode = cleanInput($input['zipcode'] ?? '');
    $pSchool = cleanInput($input['pSchool'] ?? '');
    $hSchool = cleanInput($input['hSchool'] ?? '');
    $college = cleanInput($input['college'] ?? '');
    $degreeTitle = cleanInput($input['degreeTitle'] ?? '');
    $jobPosition = cleanInput($input['jobPosition'] ?? '');
    $experience = cleanInput($input['experience'] ?? '');
    $spouse = cleanInput($input['spouse'] ?? '');
    $childrenQ = intval($input['childrenQ'] ?? 0);

    // Validaciones básicas
    if (empty($name)) {
        throw new Exception('El nombre es requerido');
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Email válido es requerido');
    }

    // Verificar si el email ya existe
    $checkStmt = $mysqli->prepare("SELECT id FROM employees WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows > 0) {
        throw new Exception('El email ya está registrado');
    }
    $checkStmt->close();

    // Preparar la consulta de inserción
    $stmt = $mysqli->prepare("INSERT INTO employees (name, email, phone, address, province, zipcode, primary_school, high_school, college, degree_title, job_position, experience, spouse, children_quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssssssssssssi", $name, $email, $phone, $address, $province, $zipcode, $pSchool, $hSchool, $college, $degreeTitle, $jobPosition, $experience, $spouse, $childrenQ);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        $employeeId = $mysqli->insert_id;
        echo json_encode([
            'success' => true, 
            'message' => 'Empleado guardado exitosamente',
            'employee_id' => $employeeId,
            'employee_name' => $name
        ]);
    } else {
        throw new Exception('Error al guardar el empleado: ' . $stmt->error);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    closeConnection($mysqli);
}
?>