<?php

$routes = [
    'libro/listar' => 'LibroController::listar',
    'libro/crear' => 'LibroController::crearNuevoLibro',
    'libro/editar' => 'LibroController::editar',
    'libro/actualizar' => 'LibroController::actualizar',
    'libro/eliminar' => 'LibroController::eliminar',
];

// Función para manejar la ruta actual
function handleRoute($url) {
    global $routes;

    // Verificar si la ruta existe
    if (array_key_exists($url, $routes)) {
        list($controller, $method) = explode('::', $routes[$url]);
        
        // Crear una instancia del controlador
        //$controllerInstance = new $controller($pdo); // Asegúrate de pasar el objeto PDO si es necesario
   //     return $controllerInstance->$method();
    } else {
        // Manejar ruta no encontrada
        http_response_code(404);
        echo "404 Not Found";
    }
}
?>