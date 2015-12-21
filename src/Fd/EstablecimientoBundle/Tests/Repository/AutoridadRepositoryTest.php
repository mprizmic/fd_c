<?php

namespace Fd\EstablecimientoBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Model\ConstantesTests;

class AutoridadRepositoryTest extends WebTestCase {

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
                ->getRepository('EstablecimientoBundle:Autoridad')
        ;
    }

    //devuelve la lista de establecimientos ordenada por el campo orden
    public function testFindAllOrdenado() {
    }

    /**
     * 
     * @param type $nivel
     * @param type $campo
     */
    public function testFindRectores() {
        
        $rectores = $this->repo
                ->findRectores();

        $this->assertCount(3, $rectores);
        
        //con parametro
        $establecimiento = $this->em->find('EstablecimientoBundle:Establecimiento', ConstantesTests::ENS3 );
        
        $rectores = $this->repo
                ->findRectores($establecimiento);

        $this->assertCount(1, $rectores);
        
        $this->assertTrue( $rectores[0]['apellido'] == 'PRIZMIC');
        
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
