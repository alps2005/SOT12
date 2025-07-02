<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir archivo de configuración
require_once 'config.php';

// Verificar que sea una petición GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

try {
    // Obtener parámetros opcionales
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $search = isset($_GET['search']) ? cleanInput($_GET['search']) : '';

    // Construir la consulta
    $sql = "SELECT id, name, email, phone, address, province, zipcode, 
                   primary_school, high_school, college, degree_title, 
                   job_position, experience, spouse, children_quantity, 
                   created_at, updated_at 
            FROM employees";
    
    $params = [];
    $types = "";
    
    // Agregar filtro de búsqueda si se proporciona
    if (!empty($search)) {
        $sql .= " WHERE name LIKE ? OR email LIKE ? OR job_position LIKE ?";
        $searchTerm = "%$search%";
        $params = [$searchTerm, $searchTerm, $searchTerm];
        $types = "sss";
    }
    
    // Agregar ordenamiento y límite
    $sql .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= "ii";
    
    // Preparar y ejecutar la consulta
    $stmt = $mysqli->prepare($sql);
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $employees = [];
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    
    // Obtener el total de registros
    $countSql = "SELECT COUNT(*) as total FROM employees";
    if (!empty($search)) {
        $countSql .= " WHERE name LIKE ? OR email LIKE ? OR job_position LIKE ?";
    }
    
    $countStmt = $mysqli->prepare($countSql);
    if (!empty($search)) {
        $countStmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    }
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $totalCount = $countResult->fetch_assoc()['total'];
    
    echo json_encode([
        'success' => true,
        'data' => $employees,
        'total' => $totalCount,
        'limit' => $limit,
        'offset' => $offset
    ]);
    
    $stmt->close();
    $countStmt->close();
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
} finally {
    closeConnection($mysqli);
}
?>