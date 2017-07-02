Seguimos

- Ingresos. 
    (...)
    - Los ingresos admiten un máximo de 2 decimales de precisión
        - **Si ingreso 100.45 en una cuenta vacía, el saldo es de 100.45**
        - **Si ingreso 100.457 en una cuenta vacía, el saldo es de 0**
    - La cantidad máxima que se puede ingresar es de 6000
        - **Si ingreso 6000.00 en una cuenta vacía, el saldo es de 6000.00**
        - **Si ingreso 6000.01 en una cuenta vacía, el saldo es de 0**


Tests

``` [php]

    public function testIngresoCantidad2Decimales(){
        $c = new Cuenta();
        $c->ingreso(100.45);
        $this->assertEquals(100.45, $c->getSaldo());
    }

```

Ejecuto el test y... no falla. El paso 1 de TDD dice que tengo que escribir un test que falle.

¿Es que este test NO aporta funcionalidad nueva? Sí la aporta, pero es culpa de PHP que 
no hace distinción entre enteros y decimales. La mayoría de lenguajes obligaría con 
este test a ir al código y cambiar el tipo de dato de *private $saldo;* de *int* a *float*.

Sabiendo el por qué, dejamos el test, nos saltamos el paso 2 y 3 y continuamos con el siguiente test