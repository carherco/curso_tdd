Hemos acabado con los tests de la especificaciones principal de la funcionalidad de ingreso.

Seguimos con el resto de especificaciones de dicha funcionalidad.

- Ingresos. 
    - (...)
    - No se pueden hacer ingresos negativos
        - **Al ingresar -100 en cuenta vacía, el saldo sigue siendo 0**
    - (...)


Convertimos el ejemplo en un test:

``` [php]

    public function testNoSePuedeIngresarCantidadNegativa(){
        $c = new Cuenta();
        $c->ingreso(-100);
        $this->assertEquals(0, $c->getSaldo());
    }

```

Los nombres de los tests, mejor la especificación que el ejemplo en sí.

El test falla. Paso 2, escribir el código:

``` [php]
src/Cuenta.php

    public function ingreso($cantidad){
        if($cantidad < 0){
            $this->saldo = 0;
        } else {
            $this->saldo += $cantidad;
        }
        
    }
}

```

Pasa los tests. Ese *$this->saldo = 0;* chirría, debería venir algún test para quitar 
esa ambigüedad, pero si echamos un vistazo, no lo hay. Deberíamos entonces avisar 
de que faltan ejemplos en las especificaciones para que sea del todo robusto.

¿Por que no lo programamos bien directamente (al fin y al cabo sabemos cómo debe ser) y nos olvidamos?

La respuesta es que si no tenemos una batería de test completa, en el futuro alguien puede hacer
cambios en el código, refactorizaciones, etc, y podría volver a introducir el *$this->saldo = 0;*, ejecutar 
los tests, ver que pasan todos, y dar por bueno ese código. Si aplicamos TDD hay que conseguir una
batería de tests que no dejen cabida a la ambigüedad. Esto se consigue con experienca, y sobretodo, sin 
programar más funcionalidad de la que pida cada test.

Voy a dejar este fallo como si no nos hubiéramos dado cuenta. En el futuro, en producción, 
el cliente lo detectará y tendremos un bug que corregir. Y lo corregiremos siguiendo la técnica TDD.


No observamos nada que refactorizar, seguimos con el resto de casos:



