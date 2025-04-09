<?php
session_start();

require __DIR__ . '/../config/config.php';
require __DIR__ . '/../config/database.php';

require __DIR__ . '/../model/LibroModel.php';
require __DIR__ . '/../controller/LibroController.php';

// Obtener la URL y dividirla en partes
$url = $_GET['url'] ?? 'libro/listar';
$urlParts = explode('/', $url);

// Obtener acción e ID si existen
$controllerName = $urlParts[0];
$action = $urlParts[1] ?? 'listar';
$id = $urlParts[2] ?? null;

// Crear controlador
$controller = new LibroController($pdo);

// Enrutar acciones
switch ($action) {
    case 'listar':
        $controller->listar();
        break;
    case 'editar':
        $controller->cargarFormEditar($id);
        break;
    case 'actualizar':
        $controller->actualizar($_POST);
        break;
    case 'eliminarConfirmado':
        $controller->eliminarConfirmado($id);
        break;
    case 'crear':
        $controller->crearNuevoLibro($_POST);
        break;
    default:
        header('Location: index.php?url=libro/listar');
        exit;
}
