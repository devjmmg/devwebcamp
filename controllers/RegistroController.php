<?php 

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\EventosRegistros;
use Model\Regalo;

class RegistroController {
    
    public static function crear(Router $router) {
        
        $router->render("registro/crear", [
            'titulo' => 'Finalizar registro'
        ]);
        
    }
    
    public static function gratis() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if(!isAuth()) {
                header("Location: /login");
                exit();
            }
            
            $registro = Registro::whereArray(['usuario_id' => $_SESSION["id"], 'paquete_id' => '3']);
            if($registro) {
                header("Location: /boleto?id=" . urlencode($registro[0]->token));
                exit();
            }
            
            $token = substr(md5( uniqid( rand(), true ) ) , 0,8);
            
            $args = [
                
                'paquete_id' => 3,
                'pago_id' => substr(md5( uniqid( rand(), true ) ), 0, 17),
                'token' => $token,
                'usuario_id' => $_SESSION["id"]
                
            ];
            
            $registro = new Registro($args);
            $resultado = $registro->guardar();
            
            if($resultado){
                header("Location: /boleto?id=" . urlencode($registro->token));
                exit();
                
            }
            
        }
        
    }
    
    public static function presencial() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if(!isAuth()) {
                header("Location: /login");
                exit();
            }
            
            $registro = Registro::whereArray(['usuario_id' => $_SESSION["id"], 'paquete_id' => '1']);
            if($registro[0]) {

                $evento_registro = EventosRegistros::where('registro_id', $registro[0]->id);
                if($evento_registro) {
                    header("Location: /boleto?id=" . urlencode($registro[0]->token));
                    exit();
                }else{
                    header("Location: /finalizar-registro/conferencias");
                    exit();
                }

            }
            
            
            
            $token = substr(md5( uniqid( rand(), true ) ) , 0,8);
            
            $args = [
                
                'paquete_id' => 1,
                'pago_id' => substr(md5( uniqid( rand(), true ) ), 0, 17),
                'token' => $token,
                'usuario_id' => $_SESSION["id"]
                
            ];
            
            $registro = new Registro($args);
            $resultado = $registro->guardar();
            if($resultado){
                
                //header("Location: /boleto?id=" . urlencode($registro->token));
                header("Location: /finalizar-registro/conferencias");
                exit();
                
            }
            
        }
        
    }
    
    public static function virtual() {
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if(!isAuth()) {
                header("Location: /login");
                exit();
            }
            
            $registro = Registro::whereArray(['usuario_id' => $_SESSION["id"], 'paquete_id' => '2']);
            if($registro[0]) {
                header("Location: /boleto?id=" . urlencode($registro[0]->token));
                exit();
            }
            
            $token = substr(md5( uniqid( rand(), true ) ) , 0,8);
            
            $args = [
                
                'paquete_id' => 2,
                'pago_id' => substr(md5( uniqid( rand(), true ) ), 0, 17),
                'token' => $token,
                'usuario_id' => $_SESSION["id"]
                
            ];
            
            $registro = new Registro($args);
            $resultado = $registro->guardar();
            if($resultado){
                header("Location: /boleto?id=" . urlencode($registro->token));
                exit();
                
            }
            
        }
        
    }
    
    public static function boleto(Router $router) {
        
        $token = $_GET["id"];
        if(!$token) {
            header("Location: /login");
        }
        
        $registro = Registro::where('token',$token);
        if(!$registro) {
            header("Location: /login");
        }
        
        $registro->paquete = Paquete::find($registro->paquete_id);
        $registro->usuario = Usuario::find($registro->usuario_id);
        
        $router->render("registro/boleto", [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
        
    }
    
    public static function conferencias(Router $router) {
        
        if(!isAuth()) {
            header("Location: /login");
            exit();
        }
        
        $registro = Registro::whereArray(['usuario_id' => $_SESSION['id'], 'paquete_id' => 1]);
        if(!$registro[0]) {
            header("Location: /");
            exit();
        }
        
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
        
        $regalos = Regalo::all('ASC');
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if(!isAuth()) {
                header("Location: /login");
                exit();
            }

            $eventos = explode(',',$_POST["eventosId"]);
            if(empty($eventos)) {
                echo json_encode(['resultado' => false]);
                return;
            }
            
            $registro = Registro::whereArray(['usuario_id' => $_SESSION['id'], 'paquete_id' => 1]);
            if(!isset($registro[0])){
                echo json_encode(['resultado' => false]);
                return;
            }

            $eventos_array = [];

            //Validar la disponibilidad de los eventos seleccionados
            foreach($eventos as $evento_id) {
                $evento = Evento::find($evento_id);
                if(!isset($evento) || $evento->disponibles === '0'){
                    echo json_encode(['resultado' => false]);
                    return;
                }
                $eventos_array[] = $evento;
            }

            
            //En caso de que pase la validación restar los lugares
            foreach($eventos_array as $evento) {
                $evento->disponibles -= 1;
                $evento->guardar();

                $datos = [
                    'evento_id' => $evento->id,
                    'registro_id' => $registro[0]->id
                ];

                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }

            $registro[0]->regalo_id = $_POST["regaloId"];
            $resultado = $registro[0]->guardar();

            if($resultado){
                echo json_encode(['resultado' => true,'token' => $registro[0]->token]);
            }else{
                echo json_encode(['resultado' => false]);
            }
            return;
            
        }
        
        $router->render("registro/conferencias",[
            'titulo' => 'Elige Workshop y Conferencias',
            'eventos' => $eventos,
            'regalos' => $regalos
            
        ]);
        
    }
    
}