<?php 

namespace Controllers;

use MVC\Router;
use Model\Registro;
use Classes\Paginacion;
use Model\Paquete;
use Model\Regalo;
use Model\Usuario;

class RegistradoController {
    
    public static function index(Router $router) {
        
        if(!isAdmin()){
            header("Location: /login");
            exit();
        }
        
        $paginaActual = $_GET["page"];
        $paginaActual = filter_var($paginaActual,FILTER_VALIDATE_INT);
        if(!$paginaActual || $paginaActual < 1 ){
            header("Location: /admin/registrados?page=1");
            exit();
        }
        
        $registrosPorPagina = 10;
        $totalRegistros = Registro::total();
        
        $paginacion = new Paginacion($paginaActual,$registrosPorPagina,$totalRegistros);
        
        if($totalRegistros > 0) {
            if ($paginaActual > $paginacion->total_paginas()) {
                header("Location: /admin/registrados?page=1");
                exit();
            }
        }else{
            if ($paginaActual-1 > $paginacion->total_paginas()) {
                header("Location: /admin/registrados?page=1");
                exit();
            }
        }
        
        $registrados = Registro::paginar($registrosPorPagina,$paginacion->offset());
        foreach($registrados as $registro){
            $registro->paquete = Paquete::find($registro->paquete_id);
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->regalo = Regalo::find($registro->regalo_id);
        }
        
        $router->render('admin/registrados/index', [
            'titulo' => 'Registrados',
            'registrados' => $registrados,
            'paginacion' => $paginacion->paginacion()
        ]);
        
    }
    
}