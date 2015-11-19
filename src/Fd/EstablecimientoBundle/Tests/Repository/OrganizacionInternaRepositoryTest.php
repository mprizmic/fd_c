<?php

namespace Fd\EstablecimientoBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Model\ConstantesTests;

class OrganizacionInternaRepositoryTest extends WebTestCase {

    private $em;
    private $repository;

    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager()
        ;
        $this->repository = $this->em
                ->getRepository('EstablecimientoBundle:OrganizacionInterna')
        ;
    }

    /**
     * testea que haya 3 registros de organizacioin_interna para la ENS 3 VL
     * 
     */
    public function testFindUnaSede() {
        
        $organizaciones = $this->repository
                ->findUnaSede(ConstantesTests::ENS_3_SEDE);

        $this->assertTrue(count( $organizaciones ) == 3);
    }

   
    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
