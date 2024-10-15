<?php
//Define la constante BASE_PATH con la ruta del directorio actual
define('BASE_PATH', __DIR__);

// Cargar el controlador
require_once BASE_PATH . '/controllers/UserController.php';

// Llamar al método que muestra el formulario
$controller = new UserController();
$controller->showForm();
