<?php 

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Ponente;
use Model\Categoria;

class PaginasController {
    
    public static function index(Router $router) {

        $events = Evento::ordenar('hora_id','ASC');
        
        $eventos = [];

        foreach ($events as $event) {
            
            //Añade dinamicamente nuevos valores al objeto de event cruzando su información con lo que tiene
            $event->categoria = Categoria::find($event->categoria_id);
            $event->dia = Dia::find($event->dia_id);
            $event->hora = Hora::find($event->hora_id);
            $event->ponente = Ponente::find($event->ponente_id);
            
            if( $event->categoria_id === "1" && $event->dia_id === "1" ) {
                $eventos['c_viernes'][] = $event;
            }
            
            if( $event->categoria_id === "1" && $event->dia_id === "2" ) {
                $eventos['c_sabado'][] = $event;
            }
            
            if( $event->categoria_id === "2" && $event->dia_id === "1" ) {
                $eventos['w_viernes'][] = $event;
            }
            
            if( $event->categoria_id === "2" && $event->dia_id === "2" ) {
                $eventos['w_sabado'][] = $event;
            }
            
        }

        $totalPonentes = Ponente::total();
        $totalConferencias = Evento::total('categoria_id',1);
        $totalWorkshops = Evento::total('categoria_id',2);

        //Obtener los ponentes
        $ponentes = Ponente::all();
        
        $router->render("paginas/index", [
            'titulo' => "Inicio",
            'eventos' => $eventos,
            'totalPonentes' => $totalPonentes,
            'totalConferencias' => $totalConferencias,
            'totalWorkshops' => $totalWorkshops,
            'ponentes' => $ponentes
        ]);
        
    }
    
    public static function evento(Router $router) {
        
        $router->render("paginas/devwebcamp", [
            'titulo' => "Sobre DevWebCamp"
        ]);
        
    }
    
    public static function paquetes(Router $router) {
        
        $router->render("paginas/paquetes", [
            'titulo' => "Paquetes DevWebCamp"
        ]);
        
    }
    
    public static function conferencias(Router $router) {
        
        $events = Evento::ordenar('hora_id','ASC');
        
        $eventos = [];

        foreach ($events as $event) {
            
            //Añade dinamicamente nuevos valores al objeto de event cruzando su información con lo que tiene
            $event->categoria = Categoria::find($event->categoria_id);
            $event->dia = Dia::find($event->dia_id);
            $event->hora = Hora::find($event->hora_id);
            $event->ponente = Ponente::find($event->ponente_id);
            
            if( $event->categoria_id === "1" && $event->dia_id === "1" ) {
                $eventos['c_viernes'][] = $event;
            }
            
            if( $event->categoria_id === "1" && $event->dia_id === "2" ) {
                $eventos['c_sabado'][] = $event;
            }
            
            if( $event->categoria_id === "2" && $event->dia_id === "1" ) {
                $eventos['w_viernes'][] = $event;
            }
            
            if( $event->categoria_id === "2" && $event->dia_id === "2" ) {
                $eventos['w_sabado'][] = $event;
            }
            
        }
        
        $router->render("paginas/conferencias", [
            'titulo' => "Workshops & Conferencias",
            'eventos' => $eventos
        ]);
        
    }

    public static function error_pagina(Router $router) {

        $router->render("paginas/error_pagina", [
            'titulo' => "¡Ops! Página no encontrada"
        ]);

    }
    
}