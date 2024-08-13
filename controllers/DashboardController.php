<?php 

namespace Controllers;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardController {

    public static function index(Router $router) {

        if(!isAdmin()){
            header("Location: /login");
            exit();
        }

        $registros = Registro::get(5);

        foreach($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
        }

        //Calcular los ingresos
        $virtuales = Registro::total('paquete_id',2);
        $presenciales = Registro::total('paquete_id',1);

        $ingresos = ($virtuales * 2000) + ($presenciales * 3000);

        //Obtener eventos con mas y menos lugares disponibles
        $min = Evento::ordenarLimite('disponibles','ASC',5);
        $max = Evento::ordenarLimite('disponibles','DESC',5);


        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de administración',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'min' => $min,
            'max' => $max
        ]);

    }

}