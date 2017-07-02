#Test Driven Bug Fixing

Hace tiempo que acabamos el desarrollo de nuestra aplicación y está funcionando en producción sin problemas.

Pero un día llega nuestro cliente super preocupado. La aplicación no va. Dice que las transferencias no funcionan bien.

Como bien sabemos por experiencia, para poder corregir un bug, necesitamos reproducirlo. Así, que le pedimos
al cliente que nos diga cómo ha sido alguno de los casos en los que ha ocurrido el fallo.

Nos cuenta que un usuario ha intentado transferir 2500 teniendo solamente 2350 de saldo. Al emisor no se le ha quitado el dinero (bien) pero el receptor ha recibido dinero (mal).

Nuestro primer impulso es ir al código, a la función transferencia, y mirarla para ver si descubrimos el fallo. **¡¡¡Error!!!***
eso no es TDD. Para corregir el bug siguiendo TDD hay que seguir la técnica denominada *Test Driven Bug Fixing* 
(Corrección de Bugs Guíado por Tests). Esto no es más que hacer lo que hemos estado haciendo durante todo el proyecto:

1. Escribir un test que falle
2. Escribir el código que haga pasar el test
3. Refactorizar.

Lo primero es verficar con el cliente qué debe hacer exactamente la aplicación en ese caso que no está funcinado. 

> "Si un usario con 2350 transfiere 2500 a otro usuario con saldo 50 ¿cual debería ser el resultado?

> "Como no se puede hacer esa transferencia porque el usuario no emisor no tiene suficiente saldo. Los saldos deberían quedarse como están."

> "O. Entonces, Si un usario con 2350 transfiere 2500 a otro usuario con saldo 50, el saldo del emisor debería seguir siendo 2350 y el del receptor debería seguir siendo 50 ¿correcto?

> "Correcto, así debe ser"

Hemos vuelto a hacer ATDD y ya tenemos un ejemplo concreto para convertirlo en un test.

TDD - Paso 1. Escribimos el test.

``` [php]

    public function testNoSePuedeTransferirMasSaldoDelDisponible(){
        $cuenta1 = new Cuenta();
        $cuenta1->ingreso(2350);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(300);
        
        $cuenta1->transferencia($cuenta2,2500);

        $this->assertEquals(2350, $cuenta1->getSaldo());
        $this->assertEquals(300, $cuenta2->getSaldo());
    }

```

Ejecutamos. El test falla. Precisamente ocurre lo que el usuario ha reportado que ocurre:
al emisor no se le descuenta ninguna cantidad, pero al receptor sí que se le ingresa
la cantidad.

"Test Driven Bug Fixing" nos da la seguridad de estar reproduciendo exactamente el 
fallo que hay que corregir, y al ejecutar el test, ver que realmente falla. ¡No tenemos 
ni que utilizar la aplicación para comprobarlo!

TDD - Paso 2. Hacer que el test Pase.


``` [php]
src/Cuenta.php

    
    private function validarCantidadTransferencia($cantidad){        
        if($cantidad < 0) {
            return false;
        }
        
        if($cantidad > $this->saldo) {
            return false;
        }
        
        if($cantidad > 3000){
            return false;
        } 
        
        return true;
    }

}

```

Ejecutamos. ¡¡¡Pasa todos los tests!!!

TDD - Paso 3: Refactorizamos (si es necesario) y volvemos a comprobar que pasan todos los tests 

Todo correcto. Ya podemos subir el código a producción sin miedo. 
