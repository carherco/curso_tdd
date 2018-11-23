#Test Driven Bug Fixing

Hace tiempo que acabamos el desarrollo de nuestra aplicación y está funcionando en producción sin problemas.

Pero un día llega nuestro cliente super preocupado. La aplicación no va. Dice que a algunos usuarios les deja sin saldo.

Como bien sabemos por experiencia, para poder corregir un bug, necesitamos reproducirlo. Así, que le pedimos
al cliente que nos diga cómo ha sido alguno de los casos en los que ha ocurrido el fallo.

Nos cuenta que un usuario se ha quejado de que tenía 2350€ en su cuenta, ha ido a ingresar 7000 y se ha quedado sin saldo.

Nuestro primer impulso es ir al código, a la función ingreso, y mirarla para ver si descubrimos el fallo. **¡¡¡Error!!!***
eso no es TDD. Para corregir el bug siguiendo TDD hay que seguir la técnica denominada *Test Driven Bug Fixing* 
(Corrección de Bugs Guíado por Tests). Esto no es más que hacer lo que hemos estado haciendo durante todo el proyecto:

1. Escribir un test que falle
2. Escribir el código que haga pasar el test
3. Refactorizar.

Lo primero es verficar con el cliente qué debe hacer exactamente la aplicación en ese caso que no está funcinado. 

> "Si un usario con 2350€ ingresa 7000, el saldo debería ser 9350 ¿verdad?

> "No, no. Debería seguir siendo 2350. Hay un límite de ingreso de 6000.

> "De acuerdo".

Hemos vuelto a hacer ATDD y ya tenemos un ejemplo concreto para convertirlo en un test.

TDD - Paso 1. Escribimos un test que falle.

``` [php]

    public function testIngresoMasDe6000NoEsValidoAlIngresar7000EnCuentaCon2350ElSaldoSeQuedaEn2350(){
        //Arrange
        $c = new Cuenta();
        $c->ingreso(2350);
        
        //Act
        $c->ingreso(7000);

        //Asert
        $this->assertEquals(2350, $c->getSaldo());
    }

```

Ejecutamos. El test falla. Precisamente ocurre lo que el usuario ha reportado que ocurre:
su saldo se queda a 0.

"Test Driven Bug Fixing" nos da la seguridad de estar reproduciendo exactamente el 
fallo que hay que corregir, y al ejecutar el test, ver que realmente falla. ¡No tenemos 
ni que utilizar la aplicación para comprobarlo!

TDD - Paso 2. Hacer que el test Pase.


``` [php]
src/Cuenta.php

    
    public function ingreso($cantidad){
        $esValida = $this->validarCantidadIngresada($cantidad);
        if($esValida){ 
            $this->saldo += $cantidad;
        }
    }

}

```

Ejecutamos. ¡¡¡Pasa todos los tests!!!

TDD - Paso 3: Refactorizamos (si es necesario) y volvemos a comprobar que pasan todos los tests 

Todo correcto. Ya podemos subir el código a producción sin miedo. 
