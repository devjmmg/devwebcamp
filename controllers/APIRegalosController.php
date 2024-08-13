<?php 

namespace Controllers;

use Model\Regalo;
use Model\Registro;
use MVC\Router;

class APIRegalosController {
    
    public static function index() {
        
        if(!isAdmin()){
            header("Location: /login");
            exit();
        }
        
        $regalos = Regalo::all();
        if($regalos) {
            foreach ($regalos as $regalo) {
                $regalo->total = Registro::totalArray(['regalo_id' => $regalo->id,'paquete_id' => '1']);
            }
        }
        
        if(!$regalos) {
            echo json_encode([]);
            return;
        }
        
        echo json_encode(['regalos' => $regalos]);
        
    }
    
}