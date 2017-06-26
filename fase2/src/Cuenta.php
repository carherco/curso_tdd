<?php

class Cuenta {
    
    private $saldo;
    
    public function __construct() {
        $this->saldo = 0;
    }
    
    public function getSaldo() {
        return $this->saldo;
    }
    
    public function ingreso($cantidad){
        $esValida = $this->validarCantidadIngresada($cantidad);
        if($esValida){ 
            $this->saldo += $cantidad;
        } else {
            $this->saldo = 0;
        } 
    }
    
    private function validarCantidadIngresada($cantidad){
        if(round($cantidad, 2)!=$cantidad) {
            return false;
        }
        
        if($cantidad < 0) {
            return false;
        }
        
        if($cantidad > 6000.00){
            return false;
        } 
        
        return true;
    }
}
