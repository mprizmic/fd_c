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
     * verifica si una carrera se imparte en una sede/anexo de un establecimiento
     * Si el último parametro es false se devuelve un obj tipo unidad_oferta, si es tru se devuelve un valor booleano
     */
    public function testFindSeImparte() {
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
    }

    /**
     * dada una localizacion devuelve todos los turnos que tienen todas las ofertas que en dicha unidad educativa se impartan
     */
    public function testFindTurnos() {
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
