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

    //devuelve la lista de establecimientos ordenada por el campo orden
    public function testFindAllOrdenado($orden = 'orden') {
        $establecimientos = $this->repo
                ->findAllOrdenado($orden);

        $ens1 = $establecimientos[0];
        $this->assertTrue($ens1->getApodo() === 'ENS 1');
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

        $this->assertTrue($edificio->getCui() == '333333');
    }

    /**
     * Devuelve las carreras de un establecimiento
     * 
     * @param type $establecimiento_id
     */
    public function testFindCarreras() {
        $establecimiento = $this->repo->findOneBy(array('apodo' => 'ISPEE'));

        $carreras = $this->repo
                ->findCarreras($establecimiento);

        $this->assertTrue(count($carreras) == 1);
    }

    /**
     * devuelve las especializaciones del establecimento
     * 
     * @param type $establecimiento
     */
    public function testFindEspecializaciones() {
        $establecimiento = $this->repo->findOneBy(array('apodo' => 'ISPEE'));

        $especializaciones = $this->repo
                ->findCarreras($establecimiento);

        $this->assertTrue(count($especializaciones) == 1);
    }

    /**
     * Dada una carrera devuelve los establecimientos en que se imparte
     * Se usa el profesorado de portugués
     * 
     * @param type $carrera_id
     */
    public function testFindEstablecimientosPorCarrera($carrera_id = 34) {
        //cantidad de establecimientos de profesorado de portugues
        $carrera = $this->em->getRepository('OfertaEducativaBundle:Carrera')
                ->find($carrera_id);

        $establecimientos = $this->repo
                ->findEstablecimientosPorCarrera($carrera);

        $this->assertCount(1, $establecimientos);
    }

    public function testFindEstablecimientosPorEspecializacion($especializacion_id = 12) {
        $especializacion = $this->em->getRepository('OfertaEducativaBundle:Especializacion')
                ->find($especializacion_id);

        $establecimientos = $this->repo
                ->findEstablecimientosPorEspecializacion($especializacion);

        $this->assertCount(0, $establecimientos);
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
     * FALTA hacer en el repositorio
     * 
     * @param type $establecimiento
     */
    public function findPrimario($establecimiento = 17) {
        
    }

    /**
     * devuelve un array con los establecimientos que tienen cargadas cohortes
     */
    public function testFindTienenCohortes() {
        $establecimientos = $this->repo
                ->findTienenCohortes();

        $this->assertGreaterThan(0, $establecimientos);
    }

    /**
     * devuelve las unidades_oferta de un tipo determinado que tiene un establecimiento dado
     * Se prueba con el ISPEE y el nivel primario
     * 
     * @param type $establecimiento_id
     * @param type $tipo
     */
    public function testFindUnidadesOfertas($establecimiento_id = 17, $tipo = 'primario') {
        $establecimiento = $this->repo->findOneBy(array('apodo' => 'ISPEE'));

        $uos = $this->repo
                ->findUnidadesOfertas($establecimiento, $tipo);

        $this->assertCount(0, $uos);
    }

    public function testCombo() {
        $establecimientos = $this->repo
                ->combo()
        ;

        $this->assertCount(21, $establecimientos);
    }

    /**
     * Devuelve un array con los ingresantes, matriculados y egresador de un año en particular de carreras del terciario
     * 
     * Se usa la ENS 1, el profesorado de inicial y el año 2013
     * 
     * @param type $anio
     * @param type $carrera
     * @param type $establecimiento
     */
    public function testFindMatriculaCarrera($anio = 2013, $carrera_id = 8, $establecimiento = null) {
        $establecimiento = $this->repo->findOneBy(array('apodo' => 'ENS 1'));

        $datos = $this->repo->findMatriculaCarrera($anio, $carrera_id, $establecimiento->getId());

        $this->assertTrue($datos[0]['matricula'] == 911);
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
