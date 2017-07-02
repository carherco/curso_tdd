
Ya tenemos un test que falla. Ahora toca el paso 2 del algoritmo: escribir un código que haga que el 
test no falle. Concretamente, el mínimo código necesario para que el test no falle.

EL primer impulso es empezar a programar según tenemos en nuestra cabeza (gracias 
a nuestra experiencia) cómo tiene que ser la clase Cuenta, con sus getters y sus 
setters, propiedades, constructor, métodos... y seguro que al terminar, el test pasa.

Pero no es eso lo que dice TDD. El código debe estar guiado por el test. Así que 
volvamos a ejecutar el test y veamos lo que dice:

> Fatal error: Class 'Cuenta' not found

El test necesita que exista una clase Cuenta, así que vamos a crearla. Ahora toca 
pensar dónde crear esa clase. Si usamos algún framework de desarrollo (symfony, 
laravel...) pues ya nos viene definida la estructura del proyecto y dónde va cada 
archivo. Como yo no estoy utilizando ningún framework de desarrollo, tendré que 
tomar ahora una decisión de estructura de archivos, al menos para ubicar la clase 
Cuenta.

Crearé por ejemplo un directorio *src* y podré ahí un archivo *Cuenta.php* con 
la clase *Cuenta*.




``` [php]
src/Cuenta.php

<?php

class Cuenta {

}

```


Y la importo (require) en mi test:


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

Volvemos a ejecutar el test:

> Fatal error: Call to undefined method Cuenta::getSaldo()

Ahora el test nos dice que falta un método getSaldo() en la clase Cuenta. Manos a la obra.

``` [php]
src/Cuenta.php

<?php

class Cuenta {

    public function getSaldo() {
        
    }
}

```

Ejecutemos ahora el test:

> Failed asserting that null is identical to 0.

Arreglemoslo, no con un código super completo, y super funcional, sino, recordemos, 
con **el mínimo código necesario para que el test pase**.

``` [php]
src/Cuenta.php

<?php

class Cuenta {

    public function getSaldo() {
        return 0;
    }
}

```

Volvemos a ejecutar el test...

> OK (1 test, 1 assertion)

Y pasa. Hemos acabado el segundo paso del algoritmo.

Este es otro de los *chips*, que tenemos que cambiar para aplicar TDD. No pensar 
en soluciones fantásticas super funcionales... Nos limitamos a hacer lo que hay 
que hacer, y nada más, aunque parezca sin sentido y erróneo.

Si el código final debe ser otro, vendrán más tests que nos harán, poco a poco 
llegar a esa solución final y con sentido. Y si no vienen tests que nos hagan 
cambiar este código y nos sigue pareciendo que no vale, hay dos posibilidades:

- O bien no hemos definido suficientes tests para cubrir la especificación completamente y sin ambigüedades.
- O bien todavía no hemos cambiado el chip y no somos capaces de entregar un código que haga únicamente lo que tiene que hacer y no más.


Toca el paso 3. Refactorización.