<?php

namespace Fd\EstablecimientoBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class LocalizacionRepositoryTest extends WebTestCase {

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
                ->getRepository('EstablecimientoBundle:Localizacion')
        ;
    }

//    //devuelve la lista de establecimientos ordenada por el campo orden
//    public function testFindAllOrdenado($orden = 'orden') {
//        $establecimientos = $this->repo
//                ->findAllOrdenado($orden);
//
//        $ens1 = $establecimientos[0];
//        $this->assertTrue($ens1->getApodo() === 'ENS 1');
//    }

    /**
     * Devuelve las carreras de una localizacion
     * Se testea con ENS 3 VL = 88
     */
    public function testFindCarreras($id = 96) {
        $localizacion = $this->repo->find($id);
        
        $unidad_ofertas = $this->repo
                ->findCarreras($localizacion, true);

        $this->assertTrue(count($unidad_ofertas) == 43);
    }


    /**
     * FALTA cambia a partir del cambio de localizacion de la oferta
     * 
     * devuelve un array con los establecimientos que tienen cargadas cohortes
     */
//    public function testFindTienenCohortes() {
//        $establecimientos = $this->repo
//                ->findTienenCohortes();
//
//        $this->assertGreaterThan(0, $establecimientos);
//    }

    /**
     * FALTA cambia a partir del cambio de localizacion de la oferta
     * 
     * Devuelve un array con los ingresantes, matriculados y egresador de un año en particular de carreras del terciario
     * 
     * Se usa la ENS 1, el profesorado de inicial y el año 2013
     * 
     * @param type $anio
     * @param type $carrera
     * @param type $establecimiento
     */
//    public function testFindMatriculaCarrera($anio = 2013, $carrera_id = 8, $establecimiento = null) {
//        $establecimiento = $this->repo->findOneBy(array('apodo' => 'ENS 1'));
//
//        $datos = $this->repo->findMatriculaCarrera($anio, $carrera_id, $establecimiento->getId());
//
//        $this->assertTrue($datos[0]['matricula'] == 911);
//    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
