<?php 

namespace Classes;

class Paginacion {
    
    public $paginaActual;
    public $registrosPorPagina;
    public $totalRegistros;
    
    public function __construct($paginaActual = 1, $registrosPorPagina = 10, $totalRegistros = 0)
    {
        $this->paginaActual = (int) $paginaActual;
        $this->registrosPorPagina = (int) $registrosPorPagina;
        $this->totalRegistros = (int) $totalRegistros;
    }
    
    public function offset() {
        
        return $this->registrosPorPagina * ($this->paginaActual - 1);
        
    }
    
    public function total_paginas(){
        
        return ceil($this->totalRegistros / $this->registrosPorPagina);
        
    }
    
    public function pagina_anterior(){
        
        return ($this->paginaActual - 1 > 0) ? $this->paginaActual - 1 : false;
        
    }
    
    public function pagina_siguiente(){
        
        return ($this->paginaActual + 1 <= $this->total_paginas()) ? $this->paginaActual + 1 : false;
        
    }
    
    public function enlace_anterior(){
        
        $html = '';
        
        if($this->pagina_anterior()){
            
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->pagina_anterior()}\">&laquo; Anterior</a>";
            
        }
        
        return $html;
        
    }
    
    public function enlace_siguiente(){
        
        $html = '';
        
        if($this->pagina_siguiente()){
            
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->pagina_siguiente()}\">Siguiente &raquo;</a>";
            
        }
        
        return $html;
        
    }

    public function numeros_paginas() {

        $html = '';

        for ($i=1; $i <= $this->total_paginas(); $i++) { 

            if ($i === $this->paginaActual) {
                $html .= "<span class=\"paginacion__enlace paginacion__enlace--actual\">{$i} </span>";
            } else {
                $html .= "<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?page={$i}\">{$i}</a>";
            }
            
        }

        return $html;

    }
    
    public function paginacion(){
        
        $html = '';
        
        if($this->totalRegistros >= 1){
            
            $html .= '<div class="paginacion">';

            $html .= $this->enlace_anterior();

            $html .= $this->numeros_paginas();
            
            $html .= $this->enlace_siguiente();
            
            $html .= '</div>';
            
        }
        
        return $html;
        
    }
    
}