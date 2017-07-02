#¿Qué es TDD?

TDD no es un lenguaje de programación, sino una **técnica de ingeniería de software** 
cuyo propósito se centra en **tres objetivos básicos**:

- Minimizar el número de bugs que surgen en el software una vez entregado.
- Implementar las funcionalidades justas que el cliente necesita y no más. 
- Producir software modular, altamente reutilizable y preparado para el cambio. 

Quizás hayáis oído hablar de que el objetivo de TDD es *conseguir el 100% de 
cobertura de código* con los tests. Pero no es así. Ese objetivo de 100% de cobertura
es deseable con cualquier técnica que se aplique. Lo que persigue TDD es **que no
surjan bugs**. Pero como ya sabemos que eso es imposible en el desarrollo de 
software, lo que perseguimos es **minimizar el número de bugs**. Cuantos menos 
bugs surjan en producción, más eficiente habrá sido nuestro trabajo y menos tiempo
invertiremos en una tarea que no aporta beneficios directos. 

El segundo de los objetivos es no diseñar ni programar más código del necesario. 
Muchas veces, guiados por nuestra experiencia o nuestra intuición, dotamos al 
código de funcionalidades que pensamos que van a ser buenas o van a añadir calidad
extra al producto. Pero la mayoría de las veces acaba siendo código que nunca se
utilizará o que no se debía comportar como nostros habíamos pensado.

Y el tercer objetivo busca tener un software de calidad y que no asuste cuando 
haya que hacer un cambio o una ampliación. Con TDD, hasta el más novel de los programadores
será capaz de hacer cambios en un código desconocido, con la absoluta **confianza** 
de que no va a romper nada.

##¿Y cómo se consigue esto? 

Pues cambiando la mentalidad tradicional de desarrollo.

Pasaremos de pensar en implementar tareas, a pensar en ejemplos concretos y certeros 
que eliminen la ambigüedad creada por la prosa en lenguaje natural (nuestro idioma). 
Hasta ahora estábamos acostumbrados a que las tareas, o los casos de uso, 
eran las unidades de trabajo más pequeñas sobre las que ponerse a desarrollar código. 
Con TDD intentamos traducir el caso de uso o tarea en **ejemplos concretos**, 
hasta que el número de ejemplos sea suficiente como para describir la tarea 
**sin lugar a malinterpretaciones de ningún tipo**.

A lo largo de este curso, iremos viendo cómo aplicar esta técnica en nuestros 
proyectos.

