<?php
// api/controllers/chat.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

ini_set('display_errors', 0);
error_reporting(E_ALL);

session_start();

require_once '../models/database.php';
require_once '../models/Gemini.php';

$geminiApiKey = 'AIzaSyBPGzbz-5JzjamO77bahz8lOVzbjkUCW9U';

// PRIMERO: Inicializar DB
$database = new Database();
$pdo = $database->getConnection();

if (!$pdo) {
    http_response_code(500);
    die(json_encode(['success' => false, 'message' => 'Error DB']));
}

// VALIDACIÓN SIMPLIFICADA
$authValid = false;

// Opción 1: Sesión PHP existente
if (isset($_SESSION['user_id']) && isset($_SESSION['rol'])) {
    $authValid = true;
    error_log("Auth: Sesión PHP válida");
}

// Opción 2: Token del header
if (!$authValid) {
    $headers = function_exists('getallheaders') ? getallheaders() : [];
    
    // Alternativa para servidores sin getallheaders
    if (empty($headers)) {
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $header = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))));
                $headers[$header] = $value;
            }
        }
    }
    
    if (isset($headers['Authorization'])) {
        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $decoded = base64_decode($token, true);
        
        if ($decoded) {
            $userData = json_decode($decoded, true);
            
            if ($userData && isset($userData['username'], $userData['rol'])) {
                $_SESSION['user_id'] = $userData['id_usuario'] ?? $userData['username'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['nombre_completo'] = $userData['nombre_completo'] ?? $userData['username'];
                $_SESSION['rol'] = $userData['rol'];
                $authValid = true;
                error_log("Auth: Token válido para " . $userData['username']);
            }
        }
    }
}

if (!$authValid) {
    http_response_code(401);
    die(json_encode(['success' => false, 'message' => 'No autorizado']));
}

if (!in_array($_SESSION['rol'], ['admin', 'tecnico', 'usuario'])) {
    http_response_code(403);
    die(json_encode(['success' => false, 'message' => 'Sin permisos']));
}

// MANEJO DE REQUESTS
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    
    if (empty($input['message'])) {
        http_response_code(400);
        die(json_encode(['success' => false, 'message' => 'Mensaje vacío']));
    }
    
    try {
        // AHORA SÍ: Instanciar Gemini con $pdo
        $gemini = new Gemini($geminiApiKey, $pdo);
        
        // Contexto básico
        $context = [
            'user' => [
                'nombre' => $_SESSION['nombre_completo'] ?? $_SESSION['username'],
                'rol' => $_SESSION['rol']
            ]
        ];
        
        $response = $gemini->askTechnicalSupport($input['message'], $context);
        
        echo json_encode([
            'success' => $response['success'],
            'reply' => $response['message'] ?? 'Sin respuesta',
            'message' => !$response['success'] ? $response['message'] : null
        ]);
        
    } catch (Exception $e) {
        error_log("Error chat: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error procesando mensaje']);
    }
    
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>