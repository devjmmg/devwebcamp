<?php 

namespace Controllers;

use Model\Ponente;

class APIPonenteController {

    public static function index() {

        if(!isAdmin()){
            header("Location: /login");
            exit();
        }

        $ponentes = Ponente::all('ASC');

        echo json_encode($ponentes);

    }

}