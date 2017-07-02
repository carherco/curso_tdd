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
    

    //********** Transferencias *********//

    public function testTransferencia()
    {
        //Set up
        $cuenta1 = new Cuenta();
        $cuenta1->ingreso(500);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(50);
        
        //Act
        $cuenta1->transferencia($cuenta2,100);
        
        //Assert
        $this->assertEquals(400, $cuenta1->getSaldo());
        $this->assertEquals(150, $cuenta2->getSaldo());
    }
    
    /**
     * Nos encontramos con el bug que habíamos dejado pasar
     */
    public function testTransferenciaNegativaNoEsValida()
    {
        //Set up
        $cuenta1 = new Cuenta();
        $cuenta1->ingreso(500);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(50);
        
        //Act
        $cuenta1->transferencia($cuenta2,-100);
        
        //Assert
        $this->assertEquals(500, $cuenta1->getSaldo());
        $this->assertEquals(50, $cuenta2->getSaldo());
    }
    
    public function testTransferenciaLimiteCantidad3000()
    {
        //Set up
        $cuenta1 = new Cuenta();
        $cuenta1->ingreso(3500);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(50);
        
        $cuenta3 = new Cuenta();
        $cuenta3->ingreso(3500);
        
        $cuenta4 = new Cuenta();
        $cuenta4->ingreso(50);
        
        //Act
        //Esta transferencia es válida
        $cuenta1->transferencia($cuenta2,3000);
        //Esta transferencia no es válida porque supera los 3000
        $cuenta3->transferencia($cuenta4,3000.01);
        
        //Assert
        $this->assertEquals(500, $cuenta1->getSaldo());
        $this->assertEquals(3050, $cuenta2->getSaldo());
        $this->assertEquals(3500, $cuenta3->getSaldo());
        $this->assertEquals(50, $cuenta4->getSaldo());
    }
    
    
    
    //Fase X
    //Bug encontrado: un usuario ha intentado transferir 2500 teniendo solamente 2350 de saldo.
    //Al emisor no se le ha quitado el dinero (bien) pero el receptor ha recibido dinero (mal)
    //El receptor no debería haber recibido dinero. 
    //Ir directamente al código => Error. Se debe hacer lo que se denomina como "Test Driven Bug Fixing" (Corregir el bug guiado por un test)
    //1) Consensuar con el cliente el comportamiento correcto (ATDD)
    //2) Nuevo test con el nuevo requisito que reproduzca este bug. Si el test reproduce correctamente el bug, fallará.
    //3) Escribir el código para pasar el test
    
    public function testNoSePuedeTransferirMasSaldoDelDisponible(){
        $cuenta1 = new Cuenta();
        $cuenta1->ingreso(2350);
        
        $cuenta2 = new Cuenta();
        $cuenta2->ingreso(300);
        
        $cuenta1->transferencia($cuenta2,2500);

        $this->assertEquals(2350, $cuenta1->getSaldo());
        $this->assertEquals(300, $cuenta2->getSaldo());
    }
    
    //Guiarse solamente por los tests puede confundir si no se hacen buenos tests que cubran todos los requisitos.

    
}

