#Frameworks de testeo 

Cada lenguaje de programación tiene uno o más frameworks profesionales de testeo. Algunos de los más conocidos son:

Junit (Java), PhpUnit (PHP), Jasmine (JavaScript), Selenium (cliente web), Codeception (PHP)

Permiten programar tests de manera muy sencilla, analizar la cobertura de código, 
programar dobles para independizar sistemas/componentes en el testeo (Mocks, Stubs).

- Dummy: se pasa como argumento pero nunca se usa realmente. Normalmente, los objetos dummy se usan sólo para rellenar listas de parámetros.
- Fake: tiene una implementación que realmente funciona pero, por lo general, toma algún atajo o cortocircuito que le hace inapropiado para producción (como una base de datos en memoria por ejemplo).
- Stub: proporciona respuestas predefinidas a llamadas hechas durante los tests, frecuentemente, sin responder en absoluto a cualquier otra cosa fuera de aquello para lo que ha sido programado. Los stubs pueden también grabar información sobre las llamadas; tal como una pasarela de email que recuerda cuántos mensajes envió.
- Mock: objeto preprogramado con expectativas que conforman la especificación de cómo se espera que se reciban las llamadas. Son más complejos que los stubs aunque sus diferencias son sutiles. Las veremos a continuación.


En los sucesivos ejemplos y ejercicios prácticos de este curso, utilizaremos PHP a secas para el desarrollo, sin 
Apache ni ningún otro tipo de servidor, y PhpUnit para la programación de los tests.

No obstante, el curso se puede seguir sin ninguna dificultad con cualquier otro lenguaje que soporte
POO (Programación Orientada a Objetos) y cualquier framework de testeo disponible para el lenguaje elegido.



