<?php

namespace Fd\OfertaEducativaBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Model\ConstantesTests;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class CarreraRepositoryTest extends WebTestCase {

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
                ->getRepository('OfertaEducativaBundle:Carrera')
        ;
    }

    public function testFindLocalizaciones(){
        $carrera = $this->repo->find( ConstantesTests::CARRERA_PROFESORADO_DE_INICIAL) ;
        
        $resultado = $this->repo->findLocalizaciones($carrera);
        
        $this->assertCount(13, $resultado);
    }
    /**
     * dado un establecimeinto devuelve objetos de tipo carrera de las carreras del mismo
     * Se prueba con el ISPEE
     * 
     * @param type $establecimiento_id
     */
//    public function testFindCarrerasPorEstablecimiento($establecimiento_id = 30) {
//        $establecimiento = $this->em->getRepository('EstablecimientoBundle:Establecimiento')
//                ->findOneBy(array('apodo' => 'ISPEE'));
//
//        $carreras = $this->repo
//                ->findCarrerasPorEstablecimiento($establecimiento);
//
//        $this->assertCount(1, $carreras);
//    }

    /**
     * Se testea en el siguiente
     * 
     * @param type $campo
     */
    public function qbAllOrdenado($campo) {
        
    }

    /**
     * devuelve todas las carreras ordenadas por un campo
     * 
     * @param type $campo
     */
    public function testQyAllOrdenado() {
        $carreras = $this->repo
                ->qyAllOrdenado('nombre')
                ->getResult();

        $carrera = $carreras[0];

        $this->assertTrue(substr($carrera->getNombre(), 0, 5) == 'Ciclo');
    }

    public function testDqlActivas() {
        $carreras = $this->repo
                ->dqlActivas()
                ->getQuery()
                ->getResult();

        $this->assertCount(ConstantesTests::CANTIDAD_TOTAL_CARRERAS_ACTIVAS, $carreras);
    }

    public function testDqlActivasOrdenadas($campo = 'nombre') {
        $carreras = $this->repo
                ->dqlActivasOrdenadas($campo)
                ->getQuery()
                ->getResult();

        $this->assertCount(ConstantesTests::CANTIDAD_TOTAL_CARRERAS_ACTIVAS, $carreras);

        $carrera = $carreras[0];

        $this->assertTrue($carrera->getAnioInicio() != 2015);
    }

    public function testQyActivasOrdenadas($campo = 'nombre') {
        $carreras = $this->repo
                ->qyActivasOrdenadas($campo)
                ->getResult();

        $this->assertcount(ConstantesTests::CANTIDAD_TOTAL_CARRERAS_ACTIVAS, $carreras);
    }

    public function testFindActivasOrdenadas($campo = 'nombre') {
        $carreras = $this->repo
                ->findActivasOrdenadas($campo)
        ;

        $this->assertcount(ConstantesTests::CANTIDAD_TOTAL_CARRERAS_ACTIVAS, $carreras);
    }

    public function testFindAllOrdenado($campo = 'nombre') {
        $carreras = $this->repo
                ->findAllOrdenado($campo )
        ;

        $this->assertcount(ConstantesTests::CANTIDAD_TOTAL_CARRERAS, $carreras);
    }

    public function combo($establecimiento = null) {
        $establecimiento = $this->em
                ->getRepositoty('EstablecimientoBundle:Establecimiento')
                ->find( array('apodo'=>'Romero'));
        
        $carreras = $this->repo->combo($establecimiento);
        
        $this->assertCount(1, $carreras);
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
