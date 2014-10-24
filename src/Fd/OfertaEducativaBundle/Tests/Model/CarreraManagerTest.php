<?php

namespace Fd\OfertaEducativaBundle\Tests\Model;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class CarreraManagerTest extends WebTestCase {

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
    public function actualizar(Carrera $entity, Carrera $anterior, $originalOrientaciones = null, $originalTitulos = null) {
        
    }
    public function accept(AsignarVisitadorInterface $visitador) {
        
    }
    public function asignarEstablecimiento($carrera_id, $establecimiento_id, $accion) {
        
    }
    public function crear(Carrera $entity, $flush = true) {
        
    }
    public function crearNuevo(){
        
    }
    public function desvincular_norma($carrera, $norma) {
        
    }
    public function vincular_norma($carrera, $norma) {
        
    }
    public function eliminar(Carrera $carrera, $flush = false) {
        
    }
    public function generar_combo_json($entities) {
        
    }
    
    protected function tearDown() {
        parent::tearDown();
        $this->em->close();
    }

}
