El siguiente ejemplo de la lista ATDD es:

- **Al ingresar 3000 en cuenta con 100 el saldo es 3100**

Esto resuelve la ambigüedad que nos quedaba: las cantidades que se ingresan, se van acumulando.


Convertimos el ejemplo en un test. 

Hasta ahora, necesitábamos una cuenta vacía, virgen, y nos bastaba con *new Cuenta()*.

Ahora necesitamos una cuenta con saldo 100. Tenemos que pensar cómo hacer que una cuenta
tenga saldo 100. Volvemos a tener que tomar una decisión de diseño.

Varias opciones:
- Un nuevo método: setSaldo().
- Utilizar el método ingreso ya existente.
- Usar un parámetro en el constructor para indicar el saldo inicial.

Yo no me quiero complicar si no hay tests que me lo exijan. Así que me quedo con el 
método ingreso().

``` [php]


    public function testAlIngresar3000EnCuentaCon100ElSaldoEs3100()
    {
        $c = new Cuenta();
        $c->ingreso(100);
        $c->ingreso(3000);
        $this->assertEquals(3100, $c->getSaldo());
    }


```

Ejecutamos los test. Falla este último, perfecto. Paso 1 terminado.

Paso 2: Escribimos código para que no falle el test.



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
        $this->saldo += $cantidad;
    }
}

```

Ejecutamos los tests, y pasan. 

Además ya estamos tranquilos porque el código ahora es como nuestro sentido común 
decía que tenía que ser. 


A lo mejor hubieramos preferido la solución con setSaldo() o la del parámetro en 
el constructor. No pasa nada, Sería un código un poquito más grande, pero igualmente
robusto.



