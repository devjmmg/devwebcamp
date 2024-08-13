<?php 

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonenteController {
    
    public static function index(Router $router) {
        
        if(!isAdmin()){
            header("Location: /login");
            exit();
        }
        
        $paginaActual = $_GET["page"];
        $paginaActual = filter_var($paginaActual,FILTER_VALIDATE_INT);
        if(!$paginaActual || $paginaActual < 1 ){
            header("Location: /admin/ponentes?page=1");
            exit();
        }
        
        $registrosPorPagina = 10;
        $totalRegistros = Ponente::total();
        
        $paginacion = new Paginacion($paginaActual,$registrosPorPagina,$totalRegistros);

        if($totalRegistros > 0) {
            if ($paginaActual > $paginacion->total_paginas()) {
                header("Location: /admin/ponentes?page=1");
                exit();
            }
        }else{
            if ($paginaActual-1 > $paginacion->total_paginas()) {
                header("Location: /admin/ponentes?page=1");
                exit();
            }
        }
        
        $ponentes = Ponente::paginar($registrosPorPagina,$paginacion->offset());
        
        
        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencistas',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
        
    }
    
    public static function crear(Router $router) {
        
        if(!isAdmin()){
            header("Location: /login");
            exit();
        }
        
        $alertas = [];
        $ponente = new Ponente;
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if(!isAdmin()){
                header("Location: /login");
                exit();
            }
            
            //Leer imagen
            if(!empty($_FILES["imagen"]['tmp_name'])) {
                $carpetaImagenes = "../public/img/speakers/";
                
                if(!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes,0777,true);
                }
                
                $img_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png',80);
                $img_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp',80);
                
                $nombreImagen = md5(uniqid(rand(),true));
                
                $_POST["imagen"] = $nombreImagen;
                
            }
            
            $_POST['redes'] = json_encode( $_POST['redes'],JSON_UNESCAPED_SLASHES);
            
            $ponente-> sincronizar($_POST);
            
            $alertas = $ponente->validar();
            
            if(empty($alertas)) {
                
                $img_png->save($carpetaImagenes.$nombreImagen.".png");
                $img_webp->save($carpetaImagenes.$nombreImagen.".webp");
                
                $resultado = $ponente->guardar();
                
                if($resultado) {
                    header("Location: /admin/ponentes");
                    exit();
                }
                
            }
            
        }
        
        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
        
    }
    
    public static function editar(Router $router) {
        
        if(!isAdmin()){
            header("Location: /login");
            exit();
        }
        
        $alertas = [];
        
        //Validar id
        $id = $_GET["id"];
        $id = filter_var($id,FILTER_VALIDATE_INT);
        
        if(!$id) {
            header("Location: /admin/ponentes");
            exit();
        }
        
        //Obtener ponente a editar
        $ponente = Ponente::find($id);
        if(!$ponente){
            header("Location: /admin/ponentes");
            exit();
        }
        
        $ponente->imagen_actual = $ponente->imagen;
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if(!isAdmin()){
                header("Location: /login");
                exit();
            }
            
            //Leer imagen
            if(!empty($_FILES["imagen"]['tmp_name'])) {
                $carpetaImagenes = "../public/img/speakers/";
                
                if(!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes,0777,true);
                }
                
                $img_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png',80);
                $img_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp',80);
                
                $nombreImagen = md5(uniqid(rand(),true));
                
                $_POST["imagen"] = $nombreImagen;
                
            }else{
                
                $_POST["imagen"] = $ponente->imagen_actual;
                
            }
            
            $_POST["redes"] = json_encode($_POST["redes"],JSON_UNESCAPED_SLASHES);
            
            $ponente->sincronizar($_POST);
            
            $alertas = $ponente->validar();
            
            if(empty($alertas)){
                
                if(isset($nombreImagen)) {
                    
                    $img_png->save($carpetaImagenes.$nombreImagen.".png");
                    $img_webp->save($carpetaImagenes.$nombreImagen.".webp");
                    
                }
                
                $resultado = $ponente->guardar();
                
                if($resultado) {
                    header("Location: /admin/ponentes");
                    exit();
                }
                
            }
            
        }
        
        $router->render('admin/ponentes/editar', [
            'titulo' => 'Editar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
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
                header("Location: /admin/ponentes");
                exit();
            }
            
            //Obtener ponente a editar
            $ponente = Ponente::find($id);
            if(!isset($ponente)){
                header("Location: /admin/ponentes");
                exit();
            }
            
            $resultado = $ponente->eliminar();
            if($resultado) {
                header("Location: /admin/ponentes");
                exit();
            }
            
        }
    }
}