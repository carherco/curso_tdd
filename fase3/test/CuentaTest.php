<?php
use PHPUnit\Framework\TestCase;
require_once 'src/Cuenta.php';

class CuentaTest extends TestCase
{
    /**
     * Nombre de la clase, require_once, ubicación del fichero en el proyecto...
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
    
    
    //Fase 3. Testeo retiradas de saldo
    
    
    /**
     * Método para testear la retirada de dinero: => Hay que crear un nuevo método
     * $this->saldo = 400;
     */
    public function testAlRetirar100EnCuentaCon500ElSaldoEs400()
    {
        $c = new Cuenta();
        $c->ingreso(500);
        $this->assertEquals(500, $c->getSaldo());
        $c->retirada(100);
        $this->assertEquals(400, $c->getSaldo());
    }
    
    /**
     * 2 formas de robustecer: repetir test con cantidades distintas 
     */
    public function testAlRetirar200EnCuentaCon900ElSaldoEs700()
    {
        $c = new Cuenta();
        $c->ingreso(900);
        $c->retirada(200);
        $this->assertEquals(700, $c->getSaldo());
    }
    
    /**
     * 2 formas de robustecer: hacer test con 2 retiradas 
     */
    public function testAlRetirar200EnCuentaCon1200ElSaldoEs1000YAlRetirarOtros150ElSaldoEs850()
    {
        $c = new Cuenta();
        $c->ingreso(1200);
        $c->retirada(200);
        $this->assertEquals(1000, $c->getSaldo());
        $c->retirada(150);
        $this->assertEquals(850, $c->getSaldo());
    }
    
    public function testNoSePuedeRetirarMasSaldoDelDisponible()
    {
        $c = new Cuenta();
        $c->ingreso(200);

        $c->retirada(500);
        $this->assertEquals(200, $c->getSaldo());
    }
    
    public function testRetiradaCantidad2Decimales(){
        $c = new Cuenta();
        $c->ingreso(1000);
        
        $c->retirada(100.45);
        $this->assertEquals(899.55, $c->getSaldo());
    }
    
    public function testNoSePuedeRetirarCantidadNegativa(){
        $c = new Cuenta();
        $c->ingreso(500);
        
        $c->retirada(-100);
        $this->assertEquals(500, $c->getSaldo());
    }
    
    public function testRetiradaCantidadDe2DecimalesEsValida(){
        $c = new Cuenta();
        $c->ingreso(500);
        
        $c->retirada(100.45);
        $this->assertEquals(399.55, $c->getSaldo());
    }
    
    public function testRetiradaCantidadMasDe2DecimalesNoEsValida(){
        $c = new Cuenta();
        $c->ingreso(500);
        
        $c->retirada(100.457);
        $this->assertEquals(500, $c->getSaldo());
    }
    
    public function testRetiradaMaximoEsDe6000(){
        $c = new Cuenta();
        $c->ingreso(3000);
        $c->ingreso(4000);
        
        $c->retirada(6000);
        $this->assertEquals(1000, $c->getSaldo());
    }
    
    public function testRetiradaMasDe6000NoEsValido(){
        $c = new Cuenta();
        $c->ingreso(3000);
        $c->ingreso(4000);
        
        $c->retirada(6000.01);
        $this->assertEquals(7000, $c->getSaldo());
    }
    
    
    //Con la experiencia, el diseño de tests mejora y resulta más completo y robusto a la primera
    //También los tests de ATDD
    
    
}

