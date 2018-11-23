# Errores comunes en TDD

Empezar con TDD no es coser y cantar. A lo largo del proceso surgen muchas dudas y se cometen muchos errores.

A continuación enumero una pequeña lista de errores comunes al empezar con TDD.

- El nombre del test no es suficientemente descriptivo

    Recordemos que el nombre de un método y de sus parámetros son su mejor documentación. En el caso de un test, su nombre debe expresar con total claridad la intención del mismo.

    Los nombres de los tests se deben parecer a esto:

    - testIngresoCantidadMasDe2DecimalesNoEsValido
    - testAlRetirar100EnCuentaCon500ElSaldoEs400
    - testAlRetirar200EnCuentaCon1200ElSaldoEs1000YAlRetirarOtros150ElSaldoEs850

    y no a esto:

    - testRetirada1
    - testRetirada2
    - testRetirada3
    - testForBUG128

- Escribir demasiados tests de una vez

    La técnica establece que se debe escribir un test, y luego el código para 
    hacerlo pasar. Luego otro test, y luego el código para hacerlo pasar... 
    Siempre de uno en uno. De esta forma al programar el código que debe pasar 
    el test, nos aseguramos que cada decisión de diseño (de clases, métodos, 
    relaciones entre clases, etc,) tomada en los tests es acertada, viable, válida...
    
    Al coger práctica y experiencia con TDD, es bastante habitual escribir 
    varios tests seguidos y luego el código que los hace pasar. Pero si 
    escribimos decenas de tests seguidos, corremos el riesgo de acarrear malas 
    decisiones de diseño que no hemos contrastado al escribir el código que los 
    hace pasar.

- Adopción parcial de TDD 
    
    A veces sucede, por diversos motivos, que no todos los desarrolladores del equipo usan TDD.

    El proyecto fracasará con toda seguridad a menos que todo el equipo al completo esté 
    aplicando TDD.

- No sabemos qué es lo que queremos que haga el SUT (System Under Test)

    Nos hemos lanzado a escribir un test pero no sabemos en realidad qué es lo 
    que el código bajo prueba tiene que hacer. 

    En algunas ocasiones, lo resolvemos hablando con el dueño de producto y, en 
    otras, hablando con otros desarrolladores. Hay que tener en cuenta que se 
    están tomando decisiones de diseño al escribir los tests por lo que las 
    especificaciones tienen que estar muy claras antes de empezar para no acabar 
    diseñando un software que no cumple las especificaciones.

- No sabemos quién es el SUT y quién es el colaborador

    Es muy común que cuando necesitamos un colaborador, aquel que representamos 
    mediante un doble (un mock, un stub...), para testear una funcionalidad del 
    SUT, acabamos testeando al colaborador en lugar de al SUT.

- Un mismo método de test está haciendo múltiples afirmaciones

    Cuando practicamos TDD correctamente, apenas tenemos que usar el depurador. 
    Cuando un test falla, lo encontramos directamente y lo corregimos en dos minutos. 
    Para que esto sea así, cada método debe probar una única funcionalidad del SUT. 
    A veces utilizamos varias afirmaciones (asserts) en el mismo test, pero sólo 
    si giran en torno a la misma funcionalidad. Un método de test raramente excede 
    las 10 líneas de código.

- Se nos olvida refactorizar

    No sólo por tener una gran batería de tests, el código ya es más fácil de 
    mantener. Si el código no está limpio, será muy costoso modificarlo, y 
    también sus tests. No hay que olvidar buscar y corregir código duplicado 
    después de hacer pasar cada test. El código de los tests debe estar tan 
    limpio como el código de producción.

- No eliminamos código muerto

    A veces, tras cambios en las especificaciones, queda código en desuso. Puede 
    ser código de producción o pueden ser tests. Puesto que normalmente disponemos de un 
    sistema de control de versiones que nos permite volver atrás si alguna vez 
    volviese a hacer falta el código, debemos eliminar todo código que creamos
    en desuso. El código muerto induce a errores antes o después. Se suele 
    menospreciar cuando se trata de tests pero, como hemos hecho notar antes, el código de los 
    tests es tan importante como el código que testean.
