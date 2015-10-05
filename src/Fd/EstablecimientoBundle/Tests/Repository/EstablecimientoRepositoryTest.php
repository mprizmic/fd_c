<?php

namespace Fd\EstablecimientoBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
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

    //devuelve la lista de establecimientos ordenada por el campo orden
    public function testFindAllOrdenado($orden = 'orden') {
        $establecimientos = $this->repo
                ->findAllOrdenado($orden);

        $ens1 = $establecimientos[0];
        $this->assertTrue($ens1->getApodo() === 'ENS 1');
    }

    /**
     * devuelve los 14 establecimientos que tienen nivel primario 
     * 
     * @param type $nivel
     * @param type $campo
     */
    public function testQyAllNivelOrdenado($nivel = 'Pri', $campo = 'orden') {
        $establecimientos = $this->repo
                ->qyAllNivelOrdenado($nivel, $campo)
                ->getResult();

        $this->assertCount(14, $establecimientos);
    }

    /**
     * Devuelve el edificio principal de un establecimientos
     * Probado para la ENS 3
     * 
     * @param type $establecimiento_id
     */
    public function testFindEdificioPrincipal() {
        $establecimiento = $this->repo->findOneBy(array('apodo' => 'ENS 3'));

        $edificio = $this->repo
                ->findEdificioPrincipal($establecimiento);

        $this->assertTrue($edificio->getCui() == '199');
    }

    /**
     * FALTA cambia a partir del cambio de localizacion de la oferta
     * 
     * Devuelve las carreras de un establecimiento
     * 
     * @param type $establecimiento_id
     */
//    public function testFindCarreras() {
//        $establecimiento = $this->repo->findOneBy(array('apodo' => 'ISPEE'));
//
//        $carreras = $this->repo
//                ->findCarreras($establecimiento);
//
//        $this->assertTrue(count($carreras) == 1);
//    }

    /**
     * FALTA cambia a partir del cambio de localizacion de la oferta
     * 
     * devuelve las especializaciones del establecimento
     * 
     * @param type $establecimiento
     */
//    public function testFindEspecializaciones() {
//        $establecimiento = $this->repo->findOneBy(array('apodo' => 'ISPEE'));
//
//        $especializaciones = $this->repo
//                ->findCarreras($establecimiento);
//
//        $this->assertTrue(count($especializaciones) == 1);
//    }

    /**
     * FALTA cambia a partir del cambio de localizacion de la oferta
     * 
     * Dada una carrera devuelve los establecimientos en que se imparte
     * Se usa el profesorado de portugués
     * 
     * @param type $carrera_id
     */
//    public function testFindEstablecimientosPorCarrera($carrera_id = 34) {
//        //cantidad de establecimientos de profesorado de portugues
//        $carrera = $this->em->getRepository('OfertaEducativaBundle:Carrera')
//                ->find($carrera_id);
//
//        $establecimientos = $this->repo
//                ->findEstablecimientosPorCarrera($carrera);
//
//        $this->assertCount(1, $establecimientos);
//    }

    /**
     * FALTA cambia a partir del cambio de localizacion de la oferta
     * 
     */
//    public function testFindEstablecimientosPorEspecializacion($especializacion_id = 12) {
//        $especializacion = $this->em->getRepository('OfertaEducativaBundle:Especializacion')
//                ->find($especializacion_id);
//
//        $establecimientos = $this->repo
//                ->findEstablecimientosPorEspecializacion($especializacion);
//
//        $this->assertCount(0, $establecimientos);
//    }


    /**
     * FALTA hacer en el repositorio
     * 
     * @param type $establecimiento
     */
    public function findPrimario($establecimiento = 17) {
        
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

    public function testCombo() {
        $establecimientos = $this->repo
                ->combo()
        ;

        $this->assertCount(21, $establecimientos);
    }

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
    /**
     * testea que se devuelvan los obj establecimiento_edificio de un establecimiento determinado, ordenados por anexo
     */
    public function testFindEdificios($apodo = 'ENS 3', $sede = '00', $anexo = '01', $polideportivo = '99') {
        
        $establecimiento = $this->repo->findOneBy(array('apodo' => $apodo));
        
        $datos = $this->repo->findEdificios($establecimiento);
        
        $this->assertCount(3, $datos);
        
        $this->assertTrue( $datos[0] instanceof EstablecimientoEdificio );
        
        $this->assertTrue($datos[0]->getCueAnexo() == $sede);
        $this->assertTrue($datos[1]->getCueAnexo() == $anexo);
        $this->assertTrue($datos[2]->getCueAnexo() == $polideportivo);
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
