#Antipatrones

James Carr [(https://blog.james-carr.org/)](https://blog.james-carr.org/) recopiló 
una lista de antipatrones ayudado por la comunidad TDD.

Ese listado ya no está disponible en su blog, pero la comunidad de TDD mantiene un 
[catálogo de antipatrones en stackoverflow](https://stackoverflow.com/questions/333682/unit-testing-anti-patterns-catalogue):

Los nombres que les pusieron tienen un carácter cómico y no son en absoluto oficiales 
pero su contenido dice mucho. Algunos de ellos ya están recogidos en los errores comentados 
en el vídeo anterior. 

Como en tantas otras áreas, las reglas tienen sus excepciones. El objetivo es 
tenerlos en mente para identificar posibles malas prácticas al aplicar TDD.

He traducido algunos de ellos y enumerado a continuación:

- El Mentiroso

    Un test completo que cumple todas sus afirmaciones (asserts) y parece ser 
    válido pero que cuando se inspecciona más de cerca, muestra que realmente 
    no está probando su cometido en absoluto.

- Setup Excesivo

    Es un test que requiere un montón de trabajo para ser configurado. A veces 
    se usan varios cientos de líneas de código para configurar el entorno de 
    dicho test, con varios objetos involucrados, lo cual nos impide saber qué 
    es lo que se está probando debido a tanto "ruido".

- El Gigante

    Aunque prueba correctamente el objeto en cuestión, puede contener miles de 
    líneas y probar muchísimos casos de uso. Esto puede ser un indicador de que 
    el sistema que estamos probando es un Objeto Todopoderoso.

- El Imitador

    A veces, usar mocks puede estar bien y ser práctico pero otras, el desarrollador 
    se puede perder imitando los objetos colaboradores. En este caso un test 
    contiene tantos mocks, stubs y/o falsificaciones, que el SUT ni siquiera se 
    está probando. En su lugar estamos probándo lo que los mocks están devolviendo.

- Sobras Abundantes

    Es el caso en que un test crea datos que se guardan en algún lugar y otro 
    test los reutiliza para sus propios fines. Si el generador de los datos se 
    ejecuta después, o no se llega a ejecutar, el test que usa esos datos falla 
    por completo.

- El Héroe Local

    Depende del entorno de desarrollo específico en que fue escrito para poder 
    ejecutarse. El resultado es que el test pasa en dicho entorno pero falla en 
    cualquier otro sitio. Un ejemplo típico es poner rutas que son específicas 
    de una persona, como una referencia a un fichero en su escritorio.

- El Cotilla Quisquilloso

    Compara la salida completa de la función que se prueba, cuando en realidad 
    sólo está interesado en pequeñas partes de ella. Esto se traduce en que el 
    test tiene que ser continuamente mantenido a pesar de que los cambios sean 
    insignificantes. 
    Este es endémico de los tests de aplicaciones web. Ejemplo, comparar todo 
    un HTML de salida cuando solo se necesita saber si el title es correcto.

- El Cazador Secreto

    A primera vista parece no estar haciendo ninguna prueba por falta de afirmaciones (asserts). 
    El test está en verdad confiando en que se lanzará una excepción en caso de 
    que ocurra algún accidente desafortunado y que el framework de tests la 
    capturará reportando el fracaso.
    
    Ejemplo: Test de conexión a base de datos. Se confía en que si no se establece 
    conexión, el propio sistema lanzará una excepción provocando que falle el test.

- El Escaqueado

    Un test que hace muchas pruebas sobre efectos colaterales (presumiblemente 
    fáciles de hacer) pero que nunca prueba el auténtico comportamiento deseado. 

- El Bocazas

    Un test o batería de tests que llenan la consola con mensajes de diagnóstico, 
    de log, de depuración, y demás forraje, incluso cuando los tests pasan. 
    A veces, durante la creación de un test, es necesario mostrar salida por 
    pantalla, y lo que ocurre en este caso es que, cuando se termina, se deja 
    ahí aunque ya no haga falta, en lugar de limpiarlo.

- El Cazador Hambriento

    Captura excepciones y no tiene en cuenta sus trazas, a veces reemplazándolas 
    con un mensaje menos informativo, pero otras incluso registrando el suceso 
    en un log y dejando el test pasar.

- El Secuenciador

    Un test unitario que depende de que aparezcan, en el mismo orden, elementos 
    de una lista sin ordenar.

- Dependencia Oculta

    Un primo hermano del Héroe Local, un test que requiere que existan ciertos 
    datos en alguna parte antes de correr. Si los datos no se rellenaron, el 
    test falla sin dejar apenas explicación, forzando al desarrollador a indagar 
    por acres de código para encontrar qué datos se suponía que debía haber.

- El Enumerador

    Una batería de tests donde cada test es simplemente un nombre seguido de un 
    número, ej, test1, test2, test3. Esto supone que la misión del test no queda 
    clara y la única forma de averiguarlo es leer todo el test y rezar para que 
    el código sea claro.

- El Extraño

    Un test que ni siquiera pertenece a la clase de la cual es parte. Está en 
    realidad probando otro objeto (X), muy probablemente usado por el que se está 
    probando en la clase actual (objeto Y), pero saltándosela interacción que 
    hay entre ambos, donde el objecto X debía funcionar en base a la salida de 
    Y, y no directamente. También conocido como La Distancia Relativa.

- El Evangelista de los Sistemas Operativos

    Confía en que un sistema operativo específico se está usando para ejecutarse. 
    Un buen ejemplo sería un test que usa la secuencia de nueva línea de Windows 
    en la afirmación (assert), rompiéndose cuando corre bajo Linux.

- El que Siempre Funciona

    Se escribió para pasar en lugar de para fallar primero. Como desafortunado 
    efecto colateral, sucede que el test siempre funciona, aunque debiese fallar.

- El Libre Albedrío

    En lugar de escribir un nuevo test para probar una nueva funcionalidad, 
    se añade una nueva afirmación (assert) dentro de un test existente.

- El Unico

    Una combinación de varios antipatrones, particularmente El Libre Albedrío y 
    El Gigante. Es un sólo test unitario que contiene el conjunto entero de 
    pruebas de toda la funcionalidad que tiene un objeto. Una indicación común 
    de eso es que el test tiene el mismo nombre que su clase y contiene múltiples 
    líneas de setup y afirmaciones.

- El Macho Chillón

    Debido a recursos compartidos puede ver los datos resultantes de otro test 
    y puede hacerlo fallar incluso aunque el sistema a prueba sea perfectamente 
    válido. Esto se ha visto comúnmente en fitnesse, donde el uso de variables 
    de clase estáticas, usadas para guardar colecciones, no se limpiaban 
    adecuadamente después de la ejecución, a menudo repercutiendo de manera 
    inesperada en otros tests. También conocido como El huésped no invitado.

- El Excavador Lento

    Un test que se ejecuta de una forma increíblemente lenta. Cuando los 
    desarrolladores lo lanzan, les da tiempo a ir al servicio,tomar café, o 
    peor, dejarlo corriendo y marcharse a casa al terminar el día.

- Ciudadanos de segunda clase

    El código de los tests no se refactoriza tan cuidadosamente como el código de 
    producción, acabando con un montón de código duplicado, y haciendo que los 
    tests sean difícil de mantener.
	
- El Inspector

    Viola la encapsulación en un intento de conseguir el 100 % de cobertura de 
    código y por ello sabe tanto del objeto a prueba que, cualquier intento de 
    refactorizarlo, rompe el test.