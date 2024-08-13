<?php

if($argc < 3) {
    echo "Uso: php make.php <tipo> <nombre> \n";
    exit();
}

$tipo = strtolower($argv[1]);
$nombre = $argv[2];

if($tipo !== 'c' && $tipo !== 'controller' && $tipo !== 'm' && $tipo !== 'model') {
    echo "\nTipo: " . $tipo . "\n";
    echo "Nombre: " . $nombre . "\n\n";
    echo "'c' o 'controller' para el controlador, \n'm' o 'model' para el modelo, \n'nombre' es el nombre que se le da al modelo o controlador.\n\n";
    exit();
}

switch($tipo):

    case 'controller':
    case 'c':

        $tipo = "Controlador";
        $contenido = "<?php \n\n";
        $contenido .= "namespace Controllers;\n\n";
        $contenido .= "use MVC\Router;\n\n";
        $contenido .= "class $nombre {\n\n";
        $contenido .= '    public static function index(Router $router) {'."\n\n";
        $contenido .= '        $router->render("", ['."\n\n";
        $contenido .= "        ]);\n\n";
        $contenido .= "    }\n\n";
        $contenido .= "}";
        $nombre = __DIR__ . "/controllers/$nombre.php";

        break;
    case 'model':
    case 'm':

        $tipo = "Modelo";
        $contenido = "<?php \n\n";
        $contenido .= "namespace Model;\n\n";
        $contenido .= "class " . ucfirst($nombre) . " extends ActiveRecord {\n\n";
        $contenido .= '    protected static $tabla = ' . "'" . strtolower($nombre) . "s';\n";
        $contenido .= '    protected static $columnasDB = ['."'id'".'];'."\n\n";
        $contenido .= '    public $id;'."\n\n";
        $contenido .= '    public function __construct( $args = [] )'."\n";
        $contenido .= '    {'."\n\n";
        $contenido .= '        $this->id = $args["id"] ?? null;'."\n\n";
        $contenido .= '    }'."\n\n";
        $contenido .= '}'."\n\n";

        $nombre = __DIR__ . "/models/".ucfirst($nombre).".php";

        break;

endswitch;

if(file_put_contents($nombre,$contenido)) {
    echo ("$tipo creado correctamente");
}else{
    echo ("Hubo algún error al crear el $tipo");
}