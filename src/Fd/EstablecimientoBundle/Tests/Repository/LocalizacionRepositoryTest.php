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
    
    const CARRERA_PROFESORADO_DE_INICIAL = 71;
    const CARRERA_PROFESORADO_CIENCIA_POLITICA = 84;
    const LOCALIZACION_JOAQUIN = 96;
    const LOCALIZACION_ENS3_ST = 97;
    const LOCALIZACION_ENS3_VL = 88;
    const CANTIDAD_TERCIARIOS = 25;

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

    /**
     * Devuelve las carreras de una localizacion
     * Se testea con ENS 3 VL = 88
     */
    public function testFindCarreras($id = self::LOCALIZACION_JOAQUIN) {
        $localizacion = $this->repo->find($id);

        $unidad_ofertas = $this->repo
                ->findCarreras($localizacion, false);

        $this->assertTrue(count($unidad_ofertas) == 21);
    }

    /**
     * verifica si una carrera se imparte en una sede/anexo de un establecimiento
     * Si el último parametro es false se devuelve un obj tipo unidad_oferta, si es tru se devuelve un valor booleano
     */
    public function testFindSeImparte() {
        
        $localizacion = $this->repo->find(self::LOCALIZACION_JOAQUIN);
        
        $carrera = $this->em->getRepository('OfertaEducativaBundle:Carrera')
                ->find(self::CARRERA_PROFESORADO_DE_INICIAL);
        
        //no se discta la carrera en el joaquin
        $this->assertTrue( !($this->repo->findSeImparte($localizacion, $carrera, true)) );

        //otro cas0
        $carrera = $this->em->getRepository('OfertaEducativaBundle:Carrera')
                ->find(self::CARRERA_PROFESORADO_CIENCIA_POLITICA);

        //se discta la carrera en el joaquin
        $this->assertTrue( $this->repo->findSeImparte($localizacion, $carrera, true) );
    }

    /**
     * Devuelve el querybuilder de las localizaciones de los terciarios.
     * Debe ser completado con el select que se desee
     */
    public function testQbTerciarios() {
        
    }

    /**
     * Devuelve una collection de objetos Localizacion con todas las sedes y anexos de los terciarios
     * 
     * @return type
     */
    public function testQbTerciariosCompleto() {
        $terciarios = $this->repo->qbTerciariosCompleto()->getQuery()->getResult();
        
        $this->assertTrue(count($terciarios) == self::CANTIDAD_TERCIARIOS);
    }

    /**
     * devuelve un array de localizaciones de las sedes y anexos en los que se imparten terciarios
     * ordenados por establecimiento y cue_anexo
     * 
     * resultado[][localizacion]
     * resultado[][establecimiento_nombre]
     * resultado[][localizacion_id]
     * resultado[][establecimiento_edificio_nombre]
     */
    public function testFindTerciarios() {
        
        $terciarios = $this->repo->findTerciarios();
        
        $this->assertTrue( $terciarios[0]['establecimiento_nombre'] == 'ENS 1' );
        $this->assertTrue( $terciarios[1]['establecimiento_edificio_nombre'] == 'Sede ENS 2' );
        $this->assertTrue( $terciarios[2]['establecimiento_edificio_nombre'] == 'San Telmo' );
        $this->assertTrue( $terciarios[3]['establecimiento_edificio_nombre'] == 'anexo Lugano' );
        
    }
        
    /**
     * dada una localizacion devuelve todos los turnos que tienen todas las ofertas que en dicha unidad educativa se impartan
     */
    public function testFindTurnos() {
        
        $localizacion = $this->repo->find(self::LOCALIZACION_ENS3_ST);
        
        $this->assertTrue( count($this->repo->findTurnos($localizacion)) == 1);
        
        $localizacion = $this->repo->find(self::LOCALIZACION_ENS3_VL);
        
        $this->assertTrue( count($this->repo->findTurnos($localizacion)) == 3);
    }

    /**
     * dada una carrera devuelve todas sus localizaciones
     */
    public function testFindDeCarrera() {
    }

    /**
     * dado un establecimiento devuelve todas sus localizaciones
     * 
     * @param type $establecimiento_id
     * @return type
     */
    public function testFindDelEstablecimiento() {
    }

    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
