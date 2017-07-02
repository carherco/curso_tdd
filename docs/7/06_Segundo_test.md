#Segundo Test

Vayamos con el segundo test. Si recordamos el listado de ejemplos que tenemos que convertir en tests

- Creación de cuentas. 
    - Las cuentas siempre se crean con saldo 0. Hay que hacer algún ingreso después si se quiere tener saldo:
        - **Al crear cuenta el saldo es cero**

- Ingresos. 
    - Suman la cantidad ingresada al saldo. 
    - No hay comisiones ni nada por el estilo.
        - **Al ingresar 100 en cuenta vacía el saldo es 100**
        - **Al ingresar 3000 en cuenta vacía el saldo es 3000**
        - **Al ingresar 3000 en cuenta con 100 el saldo es 3100**
    - No se pueden hacer ingresos negativos
        - **Al ingresar -100 en cuenta vacía, el saldo sigue siendo 0**
    - Los ingresos admiten un máximo de 2 decimales de precisión
        - **Si ingreso 100.45 en una cuenta vacía, el saldo es de 100.45**
        - **Si ingreso 100.457 en una cuenta vacía, el saldo es de 0**
    - La cantidad máxima que se puede ingresar es de 6000
        - **Si ingreso 6000.00 en una cuenta vacía, el saldo es de 6000.00**
        - **Si ingreso 6000.01 en una cuenta vacía, el saldo es de 0**

- Retiradas.
    - Restan la cantidad ingresada al saldo. 
    - No hay comisiones ni nada por el estilo.
        - **Al retirar 100 en cuenta con 500 el saldo es 400**
    - No se puede retirar una cantidad mayor a la del saldo disponible
        - **Si retiro 500 en cuenta con 200 no ocurre nada y el saldo sigue siendo 200**
    - No se pueden retirar cantidades negativas
        - **Si retiro -100 en cuenta con 500 no ocurre nada y el saldo sigue siendo 500**
    - Las cantidades admiten un máximo de 2 decimales de precisión
        - **Al retirar 100.45 en cuenta con 500 el saldo es 399.55**
        - **Al retirar 100.457 en cuenta con 500 con 500 no ocurre nada y el saldo sigue siendo 500**
    - La cantidad máxima que se puede retirar es de 6000
        - **Si retiro 6000.00 en una cuenta con 7000, el saldo es de 1000**
        - **Si retiro 6000.01 en una cuenta con 7000, no ocurre nada y el saldo sigue siendo 7000**
    
- Transferencias
    - **Al hacer una transferencia de 100 desde una cuenta con 500 a una con 50, en la 
primera cuenta el saldo se quedará en 400 y en la segunda se quedará en 150.**
    - No se pueden transferir cantidades negativas
        - **Al hacer una transferencia de -100 desde una cuenta con 500 a una con 50, los saldos se quedan en 500 y 50 respectivamente**
    - El límite de cantidad transferida es de 3000:
        - **Al hacer una transferencia de 3000 desde una cuenta con 3500 a una con 50, en la 
primera cuenta el saldo se quedará en 500 y en la segunda se quedará en 3050.**
        - **Al hacer una transferencia de 3000.01 desde una cuenta con 3500 a una con 50, en la 
primera cuenta el saldo se quedará en 3500 y en la segunda se quedará en 50.**

##Escribiendo el test

Vemos que hemos no quedan más tests de la primera funcionalidad: *creación de una cuenta*, 
Así que pasamos a la segunda (*Funcionalidad de ingreso*) y cogemos el primer ejemplo: 
*Al ingresar 100 en cuenta vacía el saldo es 100*.

Convertimos el ejemplo en un test:

``` [php]


    public function testAlIngresar100EnCuentaVaciaElSaldoEs100()
    {
        $c = new Cuenta();
        $c->ingreso(100);
        $this->assertEquals(100, $c->getSaldo());
    }


```

He tenido que tomar otra decisión de diseño. Los ingresos se harán mediante un método
*ingreso()* de la clase *Cuenta*, pasando la cantidad como parámetro.

Ejecuto LOS tests, TODOS.

El primero pasa, lógicamente, pero el segundo falla:

> Fatal error: Call to undefined method Cuenta::ingreso()

A veces pasa que escribimos un test nuevo, que debe fallar y no falla. Esto tiene
alguna de estas tres posibles causas:

- O bien nos hemos equivocado escribiendo el test. Pensamos que está testeando una cosa pero está 
testeando otra cosa totalmente diferente (cosas del copy-paste, o se nos ha olvidado el assert, 
o un bug en el test, que le puede pasar a cualquiera).
- O bien el nuevo test no aporta ninguna funcionalidad nueva, con lo que es un test innecesario.
- O bien, al programar el código que debía pasar los test anteriores, hemos programado más código y más 
funcionalidades de las necesarias.

Sea como sea, el fallo es nuestro y debemos identificarlo para proseguir correctamente:

- Reescribiendo el test.
- Descartando el test actual y pasando al siguiente.
- Dejando el test como está, el código como está y pasando al siguiente test.

Como en nuestro caso el test falla, pasamos al segundo paso del algoritmo. Escribir el código para que el test pase.


##Escribiendo el código

Tenemos este test

``` [php]


    public function testAlIngresar100EnCuentaVaciaElSaldoEs100()
    {
        $c = new Cuenta();
        $c->ingreso(100);
        $this->assertEquals(100, $c->getSaldo());
    }


```

Con este fallo

> Fatal error: Call to undefined method Cuenta::ingreso()


Escribamos el mínimo código necesario para que el test pase, sin romper los anteriores, claro.

Creo un método ingreso con un parámetro, porque me lo pide el test. Y siendo muy 
descuidado y muy torpe, hago que getSaldo devuelva 100 para que mi test pase

``` [php]
src/Cuenta.php

<?php

class Cuenta {

    public function getSaldo() {
        return 100;
    }

    public function ingreso($cantidad){
        
    }
}

```


Ejecuto, y me encuento la sorpresa de que al programar mi funcionalidad he roto 
otras. No es realmente una pérdida de tiempo por torpeza, o por desconocimiento 
(es posible que yo acabe de retomar un trabajo que dejó otro programador). Sea 
como sea, todos los test que acaban de fallar revelan las dependencias o relaciones 
de mi ejemplo con otros ejemplos.

La funcionalidad *Al ingresar 100 en cuenta vacía el saldo es 100* está ligada con 
*Al crear cuenta el saldo es cero* de forma que ahora tengo en la cabeza más pistas 
para escribir un código que pase todos los tests.

Según los tests el método getSaldo() si se llama después de llamar a ingreso(), 
devuelve una cosa, pero si se llama a getSaldo() sin haber llamado previamente a 
ingreso() devuelve otra. Así que necesito algún tipo de "memoria/indicador" en la 
clase, como un atributo.


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
        $this->saldo = 100;
    }
}

```

El método getSaldo() ya es exactamente como hubieramos programado desde el principio, 
pero ese *$this->saldo = 100;*, es horroroso, está mal. Pues no, está perfecto. Ejecuto 
los tests y pasan ambos.

Ya vendrán otros tests que lo arreglaran, y si no, deberíamos alertar a quien elaboró los ejemplos, 
para que revise si faltan (le podemos proponer ejemplos sabemos que fallarían), y si no, si somos 
tan inexpertos que se nos pasa esto, ya vendrá el cliente y dirá: *"La aplicación falla: ingreses
lo que ingreses, el saldo se queda siempre en 100"* y haremos un ejemplo 
de que si ingresas 300 el saldo debe ser 300 y su test correspondiente y su código correspondiente.

Pero con estos dos tests, el código tal cual está, está perfecto.

