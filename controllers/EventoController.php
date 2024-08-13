<?php 

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Ponente;
use Model\Categoria;
use Classes\Paginacion;

class EventoController {
    
    public static function index(Router $router) {
        
        if(!isAdmin()){
            header("Location: /login");
            exit();
        }
        
        $paginaActual = $_GET["page"];
        $paginaActual = filter_var($paginaActual,FILTER_VALIDATE_INT);
        if(!$paginaActual || $paginaActual < 1){
            header("Location: /admin/eventos?page=1");
            exit();
        }
        
        $registrosPorPagina = 10;
        $totalRegistros = Evento::total();
        $paginacion = new Paginacion($paginaActual,$registrosPorPagina,$totalRegistros);
        
        if($totalRegistros > 0) {
            if ($paginaActual > $paginacion->total_paginas()) {
                header("Location: /admin/eventos?page=1");
                exit();
            }
        }else{
            if ($paginaActual-1 > $paginacion->total_paginas()) {
                header("Location: /admin/eventos?page=1");
                exit();
            }
        }
        
        $eventos = Evento::paginar($registrosPorPagina,$paginacion->offset());
        
        foreach($eventos as $evento) {
            
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
            
        }
        
        $router->render('admin/eventos/index', [
            'titulo' => 'Eventos',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion()
        ]);
        
    }
    
    public static function crear(Router $router) {
        
        if(!isAdmin()){
            header("Location: /login");
            exit();
        }
        
        $alertas = [];
        
        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        $evento = new Evento;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(!isAdmin()){
                header("Location: /login");
                exit();
            }
            
            $evento->sincronizar($_POST);
            
            $alertas = $evento->validar();
            
            if(empty($alertas)){
                
                $resultado = $evento->guardar();
                
                if($resultado) {
                    
                    header("Location: /admin/eventos");
                    exit();
                    
                }
                
            }
            
        }
        
        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
        
    }
    
    public static function editar(Router $router) {
        
        if(!isAdmin()){
            header("Location: /login");
            exit();
        }
        
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if(!$id) {
            header("Location: /admin/eventos");
            exit();
        }
        
        //Obtener evento a editar
        $evento = Evento::find($id);
        if(!$evento){
            header("Location: /admin/eventos");
            exit();
        }
        
        $alertas = [];
        
        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(!isAdmin()){
                header("Location: /login");
                exit();
            }
            
            $evento->sincronizar($_POST);
            
            $alertas = $evento->validar();
            
            if(empty($alertas)){
                
                $resultado = $evento->guardar();
                
                if($resultado) {
                    
                    header("Location: /admin/eventos");
                    exit();
                    
                }
                
            }
            
        }
        
        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }
    
    public static function eliminar() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if(!isAdmin()){
                header("Location: /login");
                exit();
            }
            
            //Validar id
            $id = $_POST["id"];
            $id = filter_var($id,FILTER_VALIDATE_INT);
            
            if(!$id) {
                header("Location: /admin/eventos");
                exit();
            }
            
            //Obtener ponente a editar
            $evento = Evento::find($id);
            if(!isset($evento)){
                header("Location: /admin/eventos");
                exit();
            }
            
            $resultado = $evento->eliminar();
            if($resultado) {
                header("Location: /admin/eventos");
                exit();
            }
            
        }
    }
    
}