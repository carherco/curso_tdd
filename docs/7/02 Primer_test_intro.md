#Primer test

Pongámonos manos a la obra. Lo primero que hay que hacer es coger el listado de 
ejemplos de las especificaciones. Es conveniente que se hayan ordenado por funcionalidad, agrupando todos los 
ejemplos de la misma funcionalidad. En nuestro caso, fuimos diligentes y organizados
y los tenemos agrupados por funcionalidades.


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
    - El límite de cantidad transferida es de 3000:
        - **Al hacer una transferencia de 3000 desde una cuenta con 3500 a una con 50, en la 
primera cuenta el saldo se quedará en 500 y en la segunda se quedará en 3050.**
        - **Al hacer una transferencia de 3000.01 desde una cuenta con 3500 a una con 50, en la 
primera cuenta el saldo se quedará en 3500 y en la segunda se quedará en 50.**


Empezaremos con la primera funcionalidad, con el primer test de la misma:
*Al crear cuenta el saldo es cero*

Yo utilizaré PHP y el framework PhpUnit. Pero podéis hacer el ejercicio con cualquier otro lenguaje y framework.

Adelante, escribid el primer test antes de pasar al siguiente vídeo.



