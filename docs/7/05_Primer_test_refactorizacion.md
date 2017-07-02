#Paso 3 del algoritmo: refactorización

En este paso a veces no hay nada que hacer, a veces sí. Depende del estado del 
código y también de la experiencia de los programadores para detectar necesidades 
de refactorización.

En la clase Cuenta no hay nada que refactorizar. Son las 3 líneas que el test 
necesita: el nombre de la clase, el nombre del método y que devuelva 0. Ya nos 
encontraremos situaciones en las que haya que refactorizar el código.


``` [php]
src/Cuenta.php

<?php

class Cuenta {

    public function getSaldo() {
        return 0;
    }
}

```

Y el test (no olvidemos que los test también se deben refactorizar) tampoco 
parece que se preste.

``` [php]
test/EjemploTDDTest.php

<?php
use PHPUnit\Framework\TestCase;
require_once 'src/Cuenta.php';

class EjemploTDDTest extends TestCase
{

    public function testAlCrearCuentaElSaldoEsCero()
    {
        $c = new Cuenta();
        $this->assertEquals(0, $c->getSaldo());
    }

}

```

Pero al crear el archivo y la clase EjemploTDDTest les puse ese nombre porque 
no tenía ni idea todavía de qué elementos iban a testear y cómo se iban a llamar 
dichos elementos. Ahora ya sé que este archivo va a contener tests sobre las 
funcionalidades de la clase *Cuenta* así que para seguir buenas prácticas relativas
a la organización de los test de mi aplicación, voy a cambiar el nombre de la clase 
por CuentaTest y por consiguiente, el nombre del archivo por CuentaTest.php

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

}

```

He refactorizado. Tengo que asegurarme de que no he roto nada. Vuelvo a ejecutar 
los tests.

> OK (1 test, 1 assertion)

Perfecto. Hemos acabado con el primer test. Pasemos al segundo.