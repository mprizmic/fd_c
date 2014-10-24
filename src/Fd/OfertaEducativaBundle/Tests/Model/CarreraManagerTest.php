<?php

namespace Fd\OfertaEducativaBundle\Tests\Model;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\EstablecimientoBundle\Entity\Respuesta;

class CarreraManagerTest extends WebTestCase {

    private $manager;

    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->manager = static::$kernel->getContainer()
                ->get('ofertaeducativa.carrera.manager');
    }

    public function actualizar(Carrera $entity, Carrera $anterior, $originalOrientaciones = null, $originalTitulos = null) {
        
    }

    public function accept(AsignarVisitadorInterface $visitador) {
        
    }

    public function asignarEstablecimiento($carrera_id, $establecimiento_id, $accion) {
        
    }

    public function testCrear() {

        $manager = $this->manager;

        //se crea el objeto carrera
        $carrera = $manager->crearNuevo();

        //se lo completa
        $carrera->setNombre('carrerea de prieba');
        $carrera->setAnioInicio(9999);
        $carrera->setDuracion(4);

        //se crea el registro de carrera
        $respuesta = $manager->crear($carrera, true);
        $this->assertTrue($respuesta->getCodigo() == 1);

        //se verifica que la carrera recien creada sea tipo Carrera
        $object = $manager->getEm()
                ->getRepository('OfertaEducativaBundle:Carrera')
                ->find($respuesta->getClaveNueva());

        $this->assertTrue($object instanceof Carrera);

        //se guarda la clave para seguir testeando
        $id = $object->getId();

        //se elimina la carrera recien creada
        $respuesta = $manager->eliminar($object, true);

        $object = $manager->getEm()
                ->getRepository('OfertaEducativaBundle:Carrera')
                ->find($id);

        //se veirfica que el objeto fue eliminado
        $this->assertTrue(is_null($object));
    }

    public function testCrearNuevo() {
        $manager = $this->manager;
        $object = $manager->crearNuevo();

        $this->assertTrue($object instanceof Carrera);
    }

    public function desvincular_norma($carrera, $norma) {
        
    }

    public function vincular_norma($carrera, $norma) {
        
    }

    public function eliminar(Carrera $carrera, $flush = false) {
        
    }

    public function testGenerar_combo_json() {
        //cantidad de carreras en la BD
        $cantidad_total = 56;

        //se leen todas las carreras
        $carreras = $this->manager->getRepository()->findAll();
        $this->assertCount($cantidad_total, $carreras);

        //testeo del metodo del manager
        $en_array = $this->manager->generar_combo_json($carreras);

        //luego del testo hay la misma cantidad de elementos
        $this->assertCount($cantidad_total, $en_array);
    }

}
