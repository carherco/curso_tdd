<?php
use PHPUnit\Framework\TestCase;
require_once 'src/Cuenta.php';

class CuentaTest extends TestCase{
    
    public function testAlCrearCuentaElSaldoEsCero(){
        
        $c = new Cuenta();
        
        $this->assertSame(0,$c->getSaldo());
    }
    
    public function testAlIngresar100EnCuentaVaciaElSaldoEs100() {
        
        $c = new Cuenta();
        
        $c->ingreso(100);
        $this->assertSame(100,$c->getSaldo());
        
    }
        
    public function testAlIngresar3000EnCuentaVaciaElSaldoEs3000() {
        
        $c = new Cuenta();
        $c->ingreso(3000);
        $this->assertEquals(3000,$c->getSaldo()); 
    }
    
    public function testAlIngresar3000EnCuentaCon100ElSaldoEs3100(){
        
        //Arrage (set up)
        $c = new Cuenta();
        $c->ingreso(100);
        
        //Act
        $c->ingreso(3000);
        
        //Assert
        $this->assertEquals(3100,$c->getSaldo());
   
    }
    
    public function testNoSePuedeIngresarCantidadNegativa(){
        $c = new Cuenta();
                
        $c->ingreso(-100);
        
        $this->assertSame(0,$c->getSaldo());
    }
    
    public function testIngresoCantidad2Decimales(){
        $c = new Cuenta();
        
        $c->ingreso(100.45);
        
        $this->assertEquals(100.45,$c->getSaldo());
    }
    
    public function testIngresoCantidadMasDe2DecimalesNoEsValido(){
        $c = new Cuenta();
        
        $c->ingreso(100.457);
        
        $this->assertEquals(0,$c->getSaldo());
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
    
    public function testAlIngresoMasDe6000EnCuentaNoVaciaNoEsValido(){
        //Arrange (set up)
        $c = new Cuenta();
        $c->ingreso(2350);
        
        //Act
        $c->ingreso(7000);
        
        //Assert
        $this->assertEquals(2350, $c->getSaldo());
    }
}
