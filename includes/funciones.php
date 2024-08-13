<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function paginaActual($path) {
    
    return str_contains(strtok($_SERVER["REQUEST_URI"], "?") ?? "/",$path);
    
}

function isAuth() : bool {
    
    if(!isset($_SESSION)) {
        session_start();
    }
    
    return isset($_SESSION["nombre"]) && !empty($_SESSION);
    
}

function isAdmin() : bool {
    
    if(!isset($_SESSION)) {
        session_start();
    }
    
    return isset($_SESSION["admin"]) && !empty($_SESSION["admin"]);
    
}

function aos_efectos(): string {
    
    $animaciones = ['fade-up','fade-down','fade-left','fade-right','flip-left','flip-right','zoom-in','zoom-in-up','zoom-in-down','zoom-out'];
    
    $animacion = array_rand($animaciones,1);

    return " data-aos=\"{$animaciones[$animacion]}\" ";
    
}