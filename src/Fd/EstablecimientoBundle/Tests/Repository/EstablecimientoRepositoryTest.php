<?php

namespace Fd\EstablecimientoBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class EstablecimientoRepositoryTest extends WebTestCase {

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
                ->getRepository('EstablecimientoBundle:Establecimiento')
        ;
    }

    public function testCombo() {
        $establecimientos = $this->repo
                ->combo()
        ;

        $this->assertCount(21, $establecimientos);
    }

    /**
     * $grupos_etarios es un objeto que tienen todas las salas 
     */
    public function testFindSalasInicial() {
        $establecimiento = $this->repo->findOneBy(
                array('apodo' => 'ENS 1')
        );
        $inicial_x = $this->repo
                ->findSalasInicial($establecimiento)
        ;
        $this->assertTrue($inicial_x ? true : false );
    }

    /**
     * testea si el query del edificio del Mariano Acosta devuelve 2 establecimientos
     * Depende del id del edificio
     * @param type $edificio_id 
     */
    public function testFindDeUnCui($edificio_id = 22) {
        $establecimientos = $this->repo
                ->findDeUnCui($edificio_id)
        ;
        $this->assertCount(2, $establecimientos);
    }
    
    public function testFindEstablecimientosPorCarrera(){
        //cantidad de establecimientos de profesorado de portugues
        $carrera = $this->em->getRepository('OfertaEducativaBundle:Carrera')
                ->find(34);
        
        $establecimientos = $this->repo
                ->findEstablecimientosPorCarrera($carrera);
        
        $this->assertCount(13, $establecimientos);
    }
    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}