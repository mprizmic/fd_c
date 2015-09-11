<?php

namespace Fd\EstablecimientoBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class EstablecimientoEdificioRepositoryTest extends WebTestCase {

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
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
        ;
    }

    /**
     * establecimientos que funcionan en un edificio. Para el caso del edificio de Urquiza 277
     * 
     * @param type $edificio_id
     */
    public function testQueryDeUnCui($edificio_id = 22) {
        $establecimientos = $this->repo
                ->findDeUnCui($edificio_id);
        $this->assertCount(2, $establecimientos);
    }

    /**
     * testea si el query del edificio del Mariano Acosta devuelve 2 establecimientos
     * Depende del id del edificio
     * 
     * @param type $edificio_id 
     */
    public function testFindDeUnCui($edificio_id = 22) {
        $establecimientos = $this->repo
                ->findDeUnCui($edificio_id)
        ;
        $this->assertCount(2, $establecimientos);
    }

    
    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
