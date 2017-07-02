Seguimos.

Haremos los 3 tests que quedan rápidamente. No aportan nada didáctico nuevo.

- **Si ingreso 100.457 en una cuenta vacía, el saldo es de 0**
- **Si ingreso 6000.00 en una cuenta vacía, el saldo es de 6000.00**
- **Si ingreso 6000.01 en una cuenta vacía, el saldo es de 0**

Tests

``` [php]

    public function testIngresoCantidadMasDe2DecimalesNoEsValido(){
        $c = new Cuenta();
        $c->ingreso(100.457);
        $this->assertEquals(0, $c->getSaldo());
    }
    
    public function testIngresoMaximoEsDe6000(){
        $c = new Cuenta();
        $c->ingreso(6000);
        $this->assertEquals(6000, $c->getSaldo());
    }
    
    public function testIngresoMasDe6000NoEsValido(){
        $c = new Cuenta();
        $c->ingreso(6000.01);
        $this->assertEquals(0, $c->getSaldo());
    }

```


Código final


``` [php]
src/Cuenta.php

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

```

Paso 2, los tests pasan.

Paso 3. Refactorizar. La función ingreso() empieza a tener más líneas de control que 
de lo que realmente hace. Me pide refactorizarla. Voy a crear un método privado de validación

``` [php]
src/Cuenta.php

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

```

Vuelvo a ejecutar los tests. ¡¡¡Y pasan!!! Mi código hace exactamente lo mismo que antes.
TDD da una seguridad muy grande a la hora de afrontar cambios o refactorizaciones.