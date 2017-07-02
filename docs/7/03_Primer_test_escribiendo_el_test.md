¿Habéis escrito ya el test? Os aconsejo encarecidamente que lo hagáis, o al 
menos lo intentéis, antes de seguir con el vídeo.

Enfrentarse a la escritura del primer test es una experiencia muy curiosa que nos encontramos
al aventurarnos en el mundo del TDD. No tenemos nada, ni clases, ni métodos, 
ni nombres de archivos, pero tenemos que escribir un test que utilice todo eso 
que no existe. Esto no tiene sentido, es como empezar por el final.

Efectivamente, es lo que vimos en la definición de TDD y en cómo es el flujo de 
trabajo, primero el test, luego el código. Es chocante, pero una vez cambiado el 
chip, las cosas fluyen, e incluso "engancha".

Hay que testear que al crear una cuenta, el saldo es 0. Adelante, escribe un test 
que cree una cuenta y haga un assert para comprobar que el saldo es 0.

Lo primero es ponerle nombre al test. En PhpUnit cada test es un método de una clase que extiende a *TestCase*.
La clase debe tener el sufijo "Test" y el método debe tener el prefijo "test". Los nombres de los tests deben ser lo 
más descriptivos posibles, así que al test lo llamaré *testAlCrearCuentaElSaldoEsCero* 
y a la clase la llamaré *EjemploTDDTest*

Necesito también crear un archivo en el que escribir el test. Crearé el archivo EjemploTDDTest.php 
dentro de un directorio llamado test.

``` [php]

    public function testAlCrearCuentaElSaldoEsCero()
    {
        
    }

 ```

Hasta el momento solamente he aplicado TDD en el nombre del test, que debe ser muy descriptivo,
todo lo demás forma parte de la elaboración de tests con PhpUnit sea TDD o sea con cualquier otra técnica.

Escribamos ahora el test. Según la especificación, el test debe:

1. Crear una cuenta
2. Comprobar que el saldo es 0

Si nos fijamos el test va a hacer lo mismo que hará el cliente para validar la especificación.

Bien, crear una cuenta. ¿Cómo se crea una cuenta en nuestra aplicación? En un desarrollo tradicional, 
tendrías (con suerte) un documento de diseño que te diría cómo se crea una cuenta. Pero con TDD no hay
documento de diseño, las decisiones de diseño se toman "al vuelo", mientras escribimos los tests. Así que, 
como no hay nada diseñado, tienes libertad total para hacer un diseño a tu gusto. ¿Cómo te gustaría 
que fuera el código para crear una cuenta? Yo lo tengo claro: *new Cuenta()*. Así que procedo:

``` [php]

    public function testAlCrearCuentaElSaldoEsCero()
    {
        $c = new Cuenta();
    }

 ```

Acabo de tomar varias decisiones de diseño: Que existe una clase llamada *Cuenta*
y que tiene un constructor que no recibe parámetros.

Quizás otro desarrollador hubiera escrito *new Account()* y otro o *new Cuenta(0)*. 
Alguno incluso algún *$c = GestorCuentas::crearCuenta()*. Cada uno según su estilo.
Yo he optado, y ese es el espíritu de TDD, en escribir lo mínimo necesrio. Como 
por el momento no necesito un gestor de cuentas ni necesito pasar el saldo al constructor
para que mi test haga su trabajo, pues no lo hago.

Ahora me queda el segundo paso: *comprobar que el saldo de la cuenta es 0*. Voy 
a necesitar algo que todavía no existe. Un mecanismo para conocer el saldo de la 
cuenta. Voy a optar por un getter típico.

``` [php]

    public function testAlCrearCuentaElSaldoEsCero()
    {
        $c = new Cuenta();
        $this->assertSame(0, $c->getSaldo());
    }

 ```

Así pues, he tomado otra decisión: que la clase tenga un método getSaldo(). 
Escribiendo primero los tests, mi código está orientado a ser fácilmente utilizado.
Como debe ser fácilmente utilizado por los tests (no me voy a complicar la vida 
escribiendo test) acabará siendo también fácil de utilizar por otros componentes de la 
aplicación.

El test ya está hecho, ya lo podemos probar. Evidentemente, no debemos esperar 
que suceda algo mágico. El test fallará estrepitosamente. Pero ese es precisamente
el paso 1 del algoritmo. Escribir un test que falle. Ya podemos pasar al segundo
paso del algoritmo: Escribir el código para que el test pase.










