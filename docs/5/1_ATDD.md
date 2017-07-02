#ATDD

La gran diferencia entre las metodologías tradicionales y ATDD es la forma en la 
que se expresan los requisitos de negocio. En lugar de documentos de texto en 
forma mayoritariamente de párrafos, son listados de ejemplos ejecutables. 

Se podría decir que el Desarrollo Dirigido por Test de 
Aceptación (ATDD), técnica conocida también como Story Test-Driven Development 
(STDD), es igualmente TDD pero a nivel de captura de requisitos (cliente).

Los tests de aceptación o de cliente son el criterio escrito de que el software 
cumple los requisitos de negocio que el cliente demanda. Son ejemplos escritos 
por los dueños del producto. 

Al principio, la diferencia es sútil. La clave reside en **centrarnos en el qué y 
no en el cómo**. 


##Ejemplo

Supongamos el siguiente ejemplo de requisito de una funcionalidad de una tienda: 

"(...) Antes de proceder al pago, al cliente le saldrá un resumen detallado de los 
productos que tiene en la cesta, en los que se deberá aplicar el IVA (21%) o el 
RE (5.2%) al total, en caso de que el cliente requiera sus facturas con IVA o con RE.

------

Hum... hemos pedido el máximo detalle en los requisitos y esto es lo que nos ha 
definido el cliente. Decirle que queremos todavía más detalle no tiene pinta de
llevarnos a ningún sitio.

Pero sí que hay una pregunta que podemos hacer al cliente y que nos puede 
encaminar a conseguir los detalles que queremos:

“¿Qué vas a hacer para comprobar que esta característica *funciona*?”

------

Ah, muy fácil:

Entraré a la aplicación con un cliente sin IVA y sin RE, añadiré productos a 
la cesta y en el resumen de la compra previo al pago veré que no se ha aplicado 
ningún impuesto.

Luego entraré con un cliente con IVA pero sin RE, haré una compra y veré que 
se esté aplicando el 21% de IVA y que no se le aplica RE.

Después entraré con un cliente con RE pero sin IVA, haré una compra y veré que 
se esté aplicando el 5.2% de RE y que no se le aplica IVA.

Y finalmente entraré con un cliente que tenga IVA y tenga RE para ver que se 
aplican ambos impuestos.

-------

Esto parece detalladísimo, sin posibilidad ya de ambigûedades de ningún tipo, 
pero todavía no es así. Por ejemplo: 

- ¿El RE se aplica después de aplicar el IVA?, ¿o antes? 
- ¿En el detalle se pone únicamente el precio sin impuestos y el precio final
con impuestos o se debe indicar también la cantidad concreta de cada uno de los 
impuestos?
- ¿Los impuestos se indican en un único concepto "impuestos" o por separado en 
dos conceptos IVA y RE?

Como al cliente también le parece que lo ha detallado con pelos y señales, lo 
que hago ahora es llegar a los ejemplos concretos. 

Recordemos que **la base del éxito de TDD es tener ejemplos concretos y certeros**, 
así que vamos a poner ejemplos al cliente. 

A nosotros nos servirá para resolver las ambigüedades que quedan y al cliente 
para tener la certeza de que lo hemos entendido a la perfección y por tanto la 
confianza de que el producto resultante será tal y como desea:

--------

Entonces, para confirmar que lo he entendido:

Si un cliente con IVA y con RE elige un producto de 100€, en el detalle de la 
factura le enseñaré:

Precio antes de impuestos: 100€
IVA: 21€
RE: 6.292€
Total: 127.29€

---------

No, no, no, el RE se calcula sobre la base imponible, no sobre la suma de base imponible 
más IVA, y debe aparecer el porcentaje de IVA y de RE entre paréntesis. Además las cantidades deben
tener siempre 2 decimales. Sería así:

Base Imponible: 100.00€
I.V.A. (21%): 21.00€
R.E. (5.2%): 5.20€
Total: 126.20€

----------

¡Ahora sí que está bien detallado! Si el cliente no está acostumbrado a dar los 
ejemplos así, hay que ayudarle a que nos los dé haciendo nosotros mismos los 
ejemplos. Al menos las primeras veces.

Con este nivel de detalle nos vamos a ahorrar muchísimas revisiones al entregar 
el código: que siempre hay que poner 2 decimales, que las siglas IVA y RE las 
quiere con puntos, la etiqueta del precio antes de impuestos debe ser "Base Imponible", 
que hay que desglosarlo en las 4 líneas, que tiene que aparecer el porcentaje de 
cada impuesto entre paréntesis, etc.

Además, tenemos la confianza de que estamos haciendo exactamente lo que el 
cliente quiere. Y nos evita además numerosas tomas de decisiones que nos pueden
parecer obvias, pero que muchas veces no lo son. Al fin y al cabo el cliente es 
el que mejor conoce su modelo de negocio. Las decisiones que tome el cliente 
siempre serán más acertadas que las que puedan tomar los desarrolladores, 
analistas, etc

Pero sigamos, el cliente nos dijo que para validar esta funcionalidad, iba a 
realizar 4 pruebas, y solamente tenemos el ejemplo de una de ellas. Hagamos los 
otros tres aprovechando que aún estamos reunidos con el cliente.

----------

Si un cliente con IVA y sin RE elige un producto de 100€, en el detalle de la 
factura aparecerá:

Base Imponible: 100.00€
I.V.A. (21%): 21.00€
R.E. (0%): 0.00€
Total: 121.00€

No, no, si no lleva RE, esa línea no sale.

¿Entonces así?

Base Imponible: 100.00€
I.V.A. (21%): 21.00€
Total: 121.00€

Sí, así, perfecto.


Vale, entonces un cliente sin IVA pero con RE verá:

Base Imponible: 100.00€
R.E. (5.2%): 5.20€
Total: 105.20€

¡Uy, no! El IVA siempre tiene que salir en las facturas.

Vaya, eso era imposible de adivinar, el IVA siempre sale aunque sea el 0% 
y el RE solamente si es del 5.2%. Como mínimo nos hemos ahorrado generar una 
nueva entrega del software.

¿Entonces quedá así?

Base Imponible: 100.00€
I.V.A (0%): 0.00€
R.E. (5.2%): 5.20€
Total: 105.20€

Sí, así.

(El cliente debe estar ya dándose cuenta en la cuenta del nivel de detalle necesario 
para que las cosas salgan como él desea y que no cometamos errores o tomemos decisiones 
de las que no tenemos idea porque se escapan a nuestro conocimiento.  En las siguientes 
funcionalidades su nivel de detalle será mayor sin necesidad de que se lo pidamos. 
El cliente también aprende inconscientemente a trabajar con ATDD.

Y en el caso de un cliente sin IVA y sin RE entiendo que será así:

Base Imponible: 100.00€
I.V.A (0%): 0.00€
Total: 100.00€

Eso es, perfecto.

Genial. Ya tenemos 4 tests de aceptación para la funcionalidad de "mostrar los 
impuestos en el resumen de la factura".


##Otras consideraciones

Otra ventaja de dirigir el desarrollo por los ejemplos, es que vamos a poder 
comprobar muy rápido si el programa está cumpliendo los objetivos o no. 
Conocemos en qué punto estamos y cómo vamos progresando. El Dueño de Producto 
puede revisar los tests de aceptación y ver cuántos se están cumpliendo, así que 
nuestro trabajo gana una confianza tremenda. 


//*******************//


Algunas herramientas que facilitan la práctica del ATDD:

- [Fit] (http://fit.c2.com/)
- [Fitnesse] (http://fitnesse.org/)
- [Concordion] (http://concordion.org/)
- [Cucumber] (https://cucumber.io/)
- [Robot] (http://robotframework.org/)

Básicamente lo que proponen es escribir las frases con un formato determinado 
(HTML, XML...), usando etiquetas de una manera específica para delimitar qué 
partes de la frase son variables de entrada para el código y cuales son datos 
para validación del resultado de la ejecución.

Pueden llegar incluso a generar los esqueletos de los tests para frameworks de 
testeo determinados, ahorrando así adicional.


Características de estos frameworks:

- Orientado al cliente
- Ejecución de especificaciones
