<?php
use PHPUnit\Framework\TestCase;
require_once 'src/Cuenta.php';

class CuentaTest extends TestCase
{
    /**
     * Nombre de la clase
     * Constructor: ¿con parámetro, sin parámetro?
     * Método para testear el saldo: return 0;
     */
    public function testAlCrearCuentaElSaldoEsCero()
    {
        $c = new Cuenta();
        $this->assertEquals(0, $c->getSaldo());
    }
    
    /**
     * Método para testear el saldo depende del uso o no del método ingreso: => propiedad de clase ($saldo)
     * Método ingreso: $this->saldo = 100;
     */
    public function testAlIngresar100EnCuentaVaciaElSaldoEs100()
    {
        $c = new Cuenta();
        $c->ingreso(100);
        $this->assertEquals(100, $c->getSaldo());
    }
    
    /**
     * Método ingreso depende de variable de entrada: $this->saldo = $cantidad;
     */
    public function testAlIngresar3000EnCuentaVaciaElSaldoEs3000()
    {
        $c = new Cuenta();
        $c->ingreso(3000);
        $this->assertEquals(3000, $c->getSaldo());
    }
    
    /**
     * Método ingreso depende del saldo anterior: $this->saldo += $cantidad;
     */
    public function testAlIngresar3000EnCuentaCon100ElSaldoEs3100()
    {
        $c = new Cuenta();
        $c->ingreso(100);
        $c->ingreso(3000);
        $this->assertEquals(3100, $c->getSaldo());
    }
    
    /**
     * Restricción en variable de entrada: if negativo $this->saldo = 0;
     * (Este error lo mantendremos hasta el final)
     */
    public function testNoSePuedeIngresarCantidadNegativa(){
        $c = new Cuenta();
        $c->ingreso(-100);
        $this->assertEquals(0, $c->getSaldo());
    }
    
    /**
     * No falla, en otro lenguaje que no fuera php, quizás hubiera sido necesario cambiar el tipo de dato
     * de la variable de entrada del método ingreso y la de salida de getSaldo
     */
    public function testIngresoCantidad2Decimales(){
        $c = new Cuenta();
        $c->ingreso(100.45);
        $this->assertEquals(100.45, $c->getSaldo());
    }
    
    
    public function testIngresoCantidadMasDe2DecimalesNoEsValido(){
        $c = new Cuenta();
        $c->ingreso(100.457);
        $this->assertEquals(0, $c->getSaldo());
    }
    
    public function testIngresoMaximoEsDe6000(){
        $c = new Cuenta();
        $c->ingreso(6000);
        $this->assertEquals(6000, $c->getSaldo());
    }
    
    public function testIngresoMasDe6000NoEsValido(){
        $c = new Cuenta();
        $c->ingreso(6000.01);
        $this->assertEquals(0, $c->getSaldo());
    }
    
    //Refactorización método ingreso => método privado de validación
    //Fase 2
    
    //Debate sobre el testeo o no de las clases privadas
    
    
    
    //Ejemplo de cobertura de código
    //../phpunit-5.7.phar test ../cobertura --coverage-html --whitelist src/
    
    
    //Error:         No code coverage driver is available
    //brew install php56-xdebug
    //brew services restart homebrew/php/php56
    ///usr/local/etc/php/5.6/conf.d/ext-xdebug.ini
    ///Applications/MAMP/bin/php/php5.6.25/conf/php.ini
    ///Applications/MAMP/bin/php/php5.6.25/lib/php/extensions/no-debug-non-zts-20131226/
    //Descomentar última línea del php.ini
    
    
    //Cada línea muestra el número de tests que la cubren
    //Descomentar un test (por ejemplo, validar que el ingreso no es negativo)
    
    //Change Risk Anti-Patterns (CRAP) Index
    //The Change Risk Anti-Patterns (CRAP) Index is calculated based 
    //on the cyclomatic complexity and code coverage of a unit of code. 
    //Code that is not too complex and has an adequate test coverage will have 
    //a low CRAP index. The CRAP index can be lowered by writing tests and by 
    //refactoring the code to lower its complexity.
    
    //A method with a CRAP score over 30 is considered CRAPpy (i.e., unacceptable, offensive, etc.).
    //Depende de la complejidad del método y del porcentaje de cobertura
    //http://gmetrics.sourceforge.net/gmetrics-CrapMetric.html

    
    //Los tests como parte de la documentación: Importancia de los nombres de los tests
    //../phpunit-5.7.phar test --testdox doc.html
    //(la documentación se queda a nivel del directorio test)
    
    
    
    
    
}

