Aprovecho la ocasión para introducir el concepto del patrón AAA en los tests.

NO es un patrón de TDD. Es un patrón de construcción de tests, independiente de la 
técnica que se esté utilizando en el desarrollo del software.


Según este patrón, un buen debe tener 3 partes diferenciadas:

- Arrange
- Act
- Assert

Arrange (set up). Antes de empezar nuestro último test, necesitábamos la existencia 
previa de una cuenta con saldo 100. La misión de este test no es testear si se crea 
correctamente una cuenta con saldo 100. La misión es otra. Pero necesita una cuenta 
con saldo 100 para testear lo que tiene que testear. Por lo tanto nuestra primera parte 
del test estará dedicada a conseguir dicha cuenta con saldo 100.

Act. En esta parte se ejecuta la acción (o acciones) que se desea(n) poner a prueba. En nuestro caso
ingresar 3000 en la cuenta previamente preparada con saldo 100.

Assert. En esta parte, se realiza la comprobación (o comprobaciones) pertinentes para verificar
que la parte Act funciona como debe. 



``` [php]


    public function testAlIngresar3000EnCuentaCon100ElSaldoEs3100()
    {
        //Arrange (set up)
        $c = new Cuenta();
        $c->ingreso(100);

        //Act
        $c->ingreso(3000);

        //Assert
        $this->assertEquals(3100, $c->getSaldo());
    }


```


Veamos un ejemplo más complejo:


Se trata de una app de eventos (convocatorias). Con límite de participantes y lista de suplentes.

Las funcionalidad que se está testeando es que cuando se llega al límite máximo, 
ya no se admite más gente, sino que pasan a una lista de suplentes.

El ejemplo es que 1 usuario crea una convocatoria con límite 6 personas y que admite suplentes.
7 personas se apuntan a esa convocatoria. Las 5 primeras entran de titular, y las 2 últimas
se quedan de suplentes.


``` [php]

public function testSuplentes()
{

    //Arrange

    //Creo 8 usuarios
    $num_usuarios = 8;
    for($i=1;$i<=$num_usuarios;$i++){
        $usu = new NfgUsuario();
        $usu->setAlias('usu'.$i);
        $usu->save();
        $tUsuarios[$i] = $usu->getId();
    }

    //Creo una categoría y una actividad
    $cat1 = new NfgCategoria();
    $cat1->setNombre('cat1');
    $cat1->save();

    $act1 = new NfgActividad();
    $act1->setNombre('act1');
    $act1->setIdCategoria($cat1->getId());
    $act1->save();






    //Act
    $t = new lime_test();

    $t->diag('usu1 crea una convocatoria con límite de 6 participantes y que adminte suplentes');
    $conv1 = new NfgConvocatoria();
    $conv1->setIdCreador($tUsuarios[1]);
    $conv1->setIdAdministrador($tUsuarios[1]);
    $conv1->setIdActividad($act1->getId());
    $conv1->setParticipantesMax(6);
    $conv1->setAdmiteSuplentes(true);
    $conv1->save();

    //Se apuntan otros 5
    $conv1->apuntar($tUsuarios[2]);
    $conv1->apuntar($tUsuarios[3]);
    $conv1->apuntar($tUsuarios[4]);
    $conv1->apuntar($tUsuarios[5]);
    $conv1->apuntar($tUsuarios[6]);

    //Se intentan apuntar 2 más
    $conv1->apuntar($tUsuarios[7]);
    $conv1->apuntar($tUsuarios[8]);






    //Assert
    $t->is($conv1->esTitular($tUsuarios[1]),true);
    $t->is($conv1->esTitular($tUsuarios[2]),true);
    $t->is($conv1->esTitular($tUsuarios[3]),true);
    $t->is($conv1->esTitular($tUsuarios[4]),true);
    $t->is($conv1->esTitular($tUsuarios[5]),true);
    $t->is($conv1->esTitular($tUsuarios[6]),true);

    $t->is($conv1->esSuplente($tUsuarios[8]),true);
    $t->is($conv1->esSuplente($tUsuarios[9]),true);

    $t->is($conv1->numApuntados(),8);
    $t->is($conv1->numTitulares(),6);
    $t->is($conv1->numSuplentes(),2);

    $t->is($conv1->admiteMasTitulares(),false);
    $t->is($conv1->admiteMasSuplentes(),true);


}

```