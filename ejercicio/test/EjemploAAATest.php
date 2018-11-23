<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EjemploAAATest
 *
 * @author carlos
 */
class EjemploAAATest {
    public function testSuplentes()
    {
        //*********Arrange*********//

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


        //*********Act*********//

        $t = new lime_test();

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

        
        //*********Assert*********//
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

}
