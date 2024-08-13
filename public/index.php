<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\EventoController;
use Controllers\RegaloController;
use Controllers\PaginasController;
use Controllers\PonenteController;
use Controllers\RegistroController;
use Controllers\APIEventoController;
use Controllers\DashboardController;
use Controllers\APIPonenteController;
use Controllers\APIRegalosController;
use Controllers\RegistradoController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/restablecer', [AuthController::class, 'restablecer']);
$router->post('/restablecer', [AuthController::class, 'restablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

//Area de administración
$router->get('/admin/dashboard',[DashboardController::class,'index']);

$router->get('/admin/ponentes',[PonenteController::class,'index']);
$router->get('/admin/ponentes/crear',[PonenteController::class,'crear']);
$router->post('/admin/ponentes/crear',[PonenteController::class,'crear']);
$router->get('/admin/ponentes/editar',[PonenteController::class,'editar']);
$router->post('/admin/ponentes/editar',[PonenteController::class,'editar']);
$router->post('/admin/ponentes/eliminar',[PonenteController::class,'eliminar']);

$router->get('/admin/eventos',[EventoController::class,'index']);
$router->get('/admin/eventos/crear',[EventoController::class,'crear']);
$router->post('/admin/eventos/crear',[EventoController::class,'crear']);
$router->get('/admin/eventos/editar',[EventoController::class,'editar']);
$router->post('/admin/eventos/editar',[EventoController::class,'editar']);
$router->post('/admin/eventos/eliminar',[EventoController::class,'eliminar']);

$router->get('/api/eventos-horario',[APIEventoController::class,'index']);
$router->get('/api/ponentes',[APIPonenteController::class,'index']);
$router->get('/api/regalos',[APIRegalosController::class,'index']);

$router->get('/admin/registrados',[RegistradoController::class,'index']);

$router->get('/admin/regalos',[RegaloController::class,'index']);

//Páginas controller (Área Publica)
$router->get('/',[PaginasController::class,'index']);
$router->get('/devwebcamp',[PaginasController::class,'evento']);
$router->get('/paquetes',[PaginasController::class,'paquetes']);
$router->get('/workshops-conferencias',[PaginasController::class,'conferencias']);

//Registro de usuarios
$router->get('/finalizar-registro',[RegistroController::class,'crear']);
$router->post('/finalizar-registro/gratis',[RegistroController::class,'gratis']);
$router->post('/finalizar-registro/presencial',[RegistroController::class,'presencial']);
$router->post('/finalizar-registro/virtual',[RegistroController::class,'virtual']);
$router->get('/finalizar-registro/conferencias',[RegistroController::class,'conferencias']);
$router->post('/finalizar-registro/conferencias',[RegistroController::class,'conferencias']);

//Boleto
$router->get('/boleto',[RegistroController::class,'boleto']);

//Página 404
$router->get('/404',[PaginasController::class,'error_pagina']);


$router->comprobarRutas();