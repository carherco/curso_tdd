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
        if(round($cantidad, 2)!=$cantidad){
            $this->saldo = 0;
        }elseif($cantidad < 0){
            $this->saldo = 0;
        }elseif($cantidad > 6000.00){
            $this->saldo = 0;
        } else {
            $this->saldo += $cantidad;
        }
        
    }
}
