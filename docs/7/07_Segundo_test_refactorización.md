En este caso no vemos nada que refactorizar ni en el código ni en los tests. 

Los tests:


``` [php]
test/CuentaTest.php

<?php
use PHPUnit\Framework\TestCase;
require_once 'src/Cuenta.php';

class CuentaTest extends TestCase
{

    public function testAlCrearCuentaElSaldoEsCero()
    {
        $c = new Cuenta();
        $this->assertEquals(0, $c->getSaldo());
    }

    public function testAlIngresar100EnCuentaVaciaElSaldoEs100()
    {
        $c = new Cuenta();
        $c->ingreso(100);
        $this->assertEquals(100, $c->getSaldo());
    }

}

```



El código:

``` [php]
src/Cuenta.php

<?php

class Cuenta {

    private $saldo;

    public function getSaldo() {
        return $this->saldo;
    }

    public function ingreso($cantidad){
        $this->saldo = 100;
    }
}

```


Sigamos con el siguiente test.