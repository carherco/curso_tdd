# Cobertura de código
> ../phpunit-5.7.phar test  --coverage-html ../cobertura --whitelist src/

# Change Risk Anti-Patterns (CRAP) Index

El índice CRAP se calcula en base a la complejidad ciclomática y a la cobertura de código. 
    
Aquel código que no sea muy complejo y esté bien cubierto por los tests, tendrá un 
índice CRAP bajo. El CRAP se puede reducir, por lo tanto, escribiendo tests y refactorizando
el código para reducir la complejidad
  
Un método con un índice CRAP de más de 30 se considera CRAPpy (es decir, inaceptable, ofensivo, etc.).

http://gmetrics.sourceforge.net/gmetrics-CrapMetric.html


# Los tests como parte de la documentación

> ../phpunit-5.7.phar test --testdox doc.html

- Importancia de los nombres de los tests
- Importancia de que cada tests se dedique a una úncia especificación

