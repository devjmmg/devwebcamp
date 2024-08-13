<?php 

namespace Controllers;

use Model\EventoHorario;

class APIEventoController {

    public static function index() {

        if(!isAdmin()){
            header("Location: /login");
            exit();
        }

        $categoria_id = $_GET["categoria_id"] ?? '';
        $dia_id = $_GET["dia_id"] ?? '';

        $categoria_id = filter_var($categoria_id,FILTER_VALIDATE_INT);
        $dia_id = filter_var($dia_id,FILTER_VALIDATE_INT);

        if(!$categoria_id || !$dia_id) {
            echo json_encode([]);
        }

        $eventos = EventoHorario::whereArray(['categoria_id' => $categoria_id,'dia_id' => $dia_id]) ?? [];
        
        echo json_encode($eventos);

    }

}