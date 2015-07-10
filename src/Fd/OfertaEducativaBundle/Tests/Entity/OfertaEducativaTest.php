<?php

namespace Fd\OfertaEducativaBundle\Tests\Entity;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;
use Fd\OfertaEducativaBundle\Entity\Carrera;

/**
 * FLATA obtenernormaspaginadas
 * Testea el frontend de norma. Es una busqueda y una página de asignación
 */
class OfertaEducativaTest extends LoginWebTestCase {

    private $em;
    private $repository;

    public function setUp() {
        parent::setUp();

        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager()
        ;
        $this->repository = $this->em
                ->getRepository('OfertaEducativaBundle:OfertaEducativa')
        ;
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

    public function testOfertaEducativa() {
        $carreras = $this->em->getRepository("OfertaEducativaBundle:Carrera")->findAll();
        $carrera = $carreras[0];
        
        $oferta_educativa = $carrera->getOferta();
        
        $this->assertTrue($carrera->getTipo() == 'Carrera');
        
        $this->assertTrue($oferta_educativa->esTipo() == "Carrera");
    }

}
