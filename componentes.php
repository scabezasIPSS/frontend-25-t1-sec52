<?php
function consumeEndpointWithBearer($_url, $_bearerToken, $_method = 'GET', $_data = [], $_headers = [])
{
    $ch = curl_init();
    // 1. Configurar URL
    curl_setopt($ch, CURLOPT_URL, $_url);
    // 2. Configurar encabezados comunes (Content-Type y Authorization)
    $requestHeaders = [
        'Content-Type: application/json', // Por defecto, asumiendo JSON
        'Authorization: Bearer ' . $_bearerToken,
    ];
    // Merge any additional custom headers
    foreach ($_headers as $name => $value) {
        $requestHeaders[] = "$name: $value";
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
    // 3. Configurar para devolver la respuesta
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // 4. Configurar para seguir redirecciones
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // 5. Configurar método HTTP y datos
    switch (strtoupper($_method)) {
        case 'GET':
            break;
        default:
            // GET es el método por defecto, no necesita configuraciones especiales aparte de la URL
            break;
    }
    // 6. Ejecutar la solicitud
    $response = curl_exec($ch);
    // 7. Obtener información de la solicitud (código HTTP, etc.)
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // 8. Manejo de errores de cURL
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return [
            'data' => null,
            'http_code' => 0, // Un código 0 puede indicar un error de cURL
            'error' => "Error de cURL: " . $error_msg
        ];
    }
    // 9. Cerrar la sesión cURL
    curl_close($ch);
    // 10. Decodificar la respuesta
    $decoded_response = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        // La respuesta es JSON válido
        return [
            'data' => $decoded_response,
            'http_code' => $http_code
        ];
    } else {
        // La respuesta no es JSON o hubo un error al decodificar
        return [
            'data' => $response, // Devolver la respuesta en texto plano
            'http_code' => $http_code
        ];
    }
}
?>
