<?php

namespace Fd\EstablecimientoBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Model\ConstantesTests;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class UnidadOfertaRepositoryTest extends WebTestCase {

    private $em;
    private $repo;
    private $logger;

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
        $this->logger = static::$kernel->getContainer()->get('logger');
    }

    /**
     * devuelve el establecimiento localizado donde se dicta una unidad oferta
     * El resultado es un objeto establecimiento_edificio
     */
    public function testFindSedeAnexo() {

        $unidad_oferta = $this->repo->find(ConstantesTests::ENS3_ST_PEI);

        $ee = $this->repo->findSedeAnexo($unidad_oferta);

        $this->assertTrue($ee->getCueAnexo() == '00' && $ee->getEstablecimientos()->getCue() == '200536');
    }

    /**
     * dada una localizacion de un terciario, devuelve array de obj unidad_oferta de todas las carreras que se imparten en esa localizacion
     * Si el 2do parametro es verdadero, devuelve también las cohortes que encuentre
     */
    public function testFindCarreras() {

        $localizacion = $this->em->find('EstablecimientoBundle:Localizacion', ConstantesTests::LOCALIZACION_JOAQUIN);

        $carreras = $this->repo->findCarreras($localizacion);

        $this->assertTrue(count($carreras) == ConstantesTests::CARRERAS_JOAQUIN);
    }

    /**
     * Dada una localizacion un array de objetos unidad_oferta donde se imparte ese o esos tipos de oferta.
     */
    public function testFindUnidadOferta() {

        $localizacion = $this->em->find('EstablecimientoBundle:Localizacion', ConstantesTests::LOCALIZACION_ENS3_VL);

        $unidad_ofertas = $this->repo->findUnidadOferta($localizacion);

        $this->assertTrue(count($unidad_ofertas) == 2);
        
    }

    /**
     * devuelve el array de turnos de una unidad_oferta agregándole la descripción del turno
     */
    public function testFindTurnosArray() {

        $pei = $this->em->find('OfertaEducativaBundle:Carrera', ConstantesTests::CARRERA_PROFESORADO_DE_INICIAL);

        $oferta_educatica = $pei->getOferta();

        $localizacion = $this->em->find('EstablecimientoBundle:Localizacion', ConstantesTests::LOCALIZACION_ENS3_VL);

        $unidad_oferta = $this->repo->findOneBy(array(
            'ofertas' => $oferta_educatica->getId(),
            'localizacion' => $localizacion->getId(),
        ));
        
        $turnos = $this->repo->findTurnosArray( $unidad_oferta );
        
        //la carrera pei en la ens 3 de villa lugano se imparte en los 3 turnos
        $this->assertTrue( $turnos[0] == 'Mañana');
        $this->assertTrue( $turnos[1] == 'Tarde');
        $this->assertTrue( $turnos[2] == 'Vespertino');
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
