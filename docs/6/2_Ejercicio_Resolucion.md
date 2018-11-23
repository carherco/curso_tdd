Una aplicación monedero para el pago entre amigos. Cada usuario tendrá una cuenta con saldo. 
La idea es que se puedan hacer trasnferencias a tus amigos directamente desde la app. 
La aplicación permitirá al usuario ingresar dinero o retirarlo cuando quiera.

Tras profundizar en cada funcionalidad con el cliente, resulta que tengo las siguientes especificaciones, mucho más detalladas:

- Creación de cuentas:
    - Las cuentas siempre se crean con saldo 0. Hay que hacer algún ingreso después si se quiere tener saldo.

- Ingresos:
    - Suman la cantidad ingresada al saldo. 
    - No hay comisiones ni nada por el estilo.
    - No se pueden hacer ingresos negativos.
    - Los ingresos admiten un máximo de 2 decimales de precisión.
    - La cantidad máxima que se puede ingresar es de 6000.
        

- Retiradas:
    - Restan la cantidad ingresada al saldo. 
    - No se puede retirar una cantidad mayor a la del saldo disponible.
    - No hay comisiones ni nada por el estilo.
    - No se pueden retirar cantidades negativas.
    - Las cantidades admiten un máximo de 2 decimales de precisión.
    - La cantidad máxima que se puede retirar es de 6000.


- Transferencias:
    - No se pueden transferir cantidades negativas.
    - El límite cantidad transferida es de 3000.
        

Este es más o menos el nivel de detalle requerido en la metodología tradicional. Con esto ya
se puede realizar un análisis y un diseño completos de la aplicación. Sin embargo el objetivo de ATDD es conseguir ejemplos concretos, para transformarlos posteriormente en tests concretos cuando apliquemos TDD.

Así que le damos todavía una vuelta más de tuerca para definir los ejemplos con los que 
validaremos las funcionalidades: (en negrita añado los ejemplos)


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
    - El límite de transferencias en un mismo día desde una misma cuenta es de 3000:
        - **Al hacer una transferencia de 3000 desde una cuenta con 3500 a una con 50, en la 
primera cuenta el saldo se quedará en 500 y en la segunda se quedará en 3050.**
        - **Al hacer una transferencia de 3000.01 desde una cuenta con 3500 a una con 50, en la 
primera cuenta el saldo se quedará en 3500 y en la segunda se quedará en 50.**
        - **Al hacer una transferencia de 2000 desde una cuenta con 3500 a una con 50, y justo después otra de 1200, en la 
primera cuenta el saldo se quedará en 1500 y en la segunda se quedará en 2050.**

Y ahora sí, hemos acabado de capturar las especificaciones. Con esto ya podemos empezar a escribir tests y a programar siguiendo el algoritmo TDD visto con anterioridad. Cada ejemplo marcado en negrita, se convertirá en un test que habrá que pasar posteriormente.
