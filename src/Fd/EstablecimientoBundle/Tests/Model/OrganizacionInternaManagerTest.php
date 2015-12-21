<?php

namespace Fd\EstablecimientoBundle\Tests\Model;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\OfertaEducativaBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\ConstantesTests;

class OrganizacionInternaManagerTest extends WebTestCase {

    private $manager;

    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->manager = static::$kernel->getContainer()
                ->get('fd.establecimiento.organizacioninterna.manager');
    }

    public function testCrear() {

        $respuesta = new Respuesta();

        $manager = $this->manager;

        //se crea el objeto vacio
        $respuesta = $manager->crear();

        $oi = $respuesta->getObjNuevo();

        $this->assertTrue($oi instanceof OrganizacionInterna);


        ///////////////////////////////////////////////////////////////
        //se persiste un objeto existente 

        $oi = $manager->existe(ConstantesTests::ENS_3_SEDE, ConstantesTests::RECTORIA_ID);

        $oi->setTe('444');
        $manager->crear(array('objeto' => $oi));

        $resultado = $manager->getRepository()->findOneByTe('444');
        $this->assertTrue(count($resultado) == 1);

        ///////////////////////////////////////////////////////////////
        //se crea el objeto lleno
        $respuesta = $manager->crear(array(
            'establecimiento_edificio_id' => ConstantesTests::ENS_5_ANEXO,
            'dependencia_id' => ConstantesTests::SECRETARIA_ID,
        ));

        $oi = $respuesta->getObjNuevo();

        $this->assertTrue($oi instanceof OrganizacionInterna);

        $this->assertTrue($oi->getId() == null);

        ///////////////////////////////////////////////////////
        // el objeto nuevo creado se persiste y luego se lo elimina
        // se verificó antes que el objeto no existe en la base de pruebas

        $resultado = $manager->getRepository()->findAll();
        $cantidad_anterior = count($resultado);

        $manager->crear(array(
            'objeto' => $oi,
            'flush' => true,
        ));

        $resultado = $manager->getRepository()->findAll();

        $this->assertTrue($cantidad_anterior == (count($resultado) - 1));

        $manager->eliminar($oi);

        $resultado = $manager->getRepository()->findAll();

        $this->assertTrue($cantidad_anterior == count($resultado));
    }

}
