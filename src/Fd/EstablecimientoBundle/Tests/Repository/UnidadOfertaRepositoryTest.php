<?php

namespace Fd\EstablecimientoBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class UnidadOfertaRepositoryTest extends WebTestCase {

    private $em;
    private $repo;

    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager()
        ;
        $this->repo = $this->em
                ->getRepository('EstablecimientoBundle:UnidadOferta')
        ;
    }

    /**
     */
    public function testFindUnidadOferta() {
        $this->assertTrue(count(array()) == 0);
    }
    /**
     */
    public function testFindCarreras() {
        $this->assertTrue(count(array()) == 0);
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
