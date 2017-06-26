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
        $this->assertSame(0, $c->getSaldo());
    }
    
    /**
     * Método para testear el saldo depende del uso o no del método ingreso: => propiedad de clase ($saldo)
     * Método ingreso: $this->saldo = 100;
     */
    public function testAlIngresar100EnCuentaVaciaElSaldoEs100()
    {
        $c = new Cuenta();
        $c->ingreso(100);
        $this->assertSame(100, $c->getSaldo());
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
     * Método ingreso es acumulativo: $this->saldo += $cantidad;
     * ¿En vez de $c->ingreso(100); podría ser $c->setSaldo(100);
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
}

