<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cuenta
 *
 * @author carlos
 */
class Cuenta {
    
    private $saldo;
    
    public function __construct(){
        $this->saldo = 0;
    }
    
    public function getSaldo(){
        return $this->saldo;
    }
    
    public function ingreso($cantidad){
        $esValida = $this->validarCantidadIngresada($cantidad);
        
        if($esValida){
            $this->saldo += $cantidad;
        }  
    }
    
    private function validarCantidadIngresada($cantidad){
        if(round($cantidad, 2)!=$cantidad) {
            return false;
        }    
            
        if($cantidad < 0) {
            return false;
        }   
            
        if($cantidad > 6000) {
            return false;
        }
        
        return true;
    }
    
    
}
