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

    /**
     * Para veificar que actualiza se modifica un campo y se lo campara con el valor original
     * 
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $entity
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $anterior
     * @param type $originalOrientaciones
     * @param type $originalTitulos
     */
    public function testActualizar() {

        $parametro_no_usado = $this->manager->crearNuevo();
        
        //se prueba con profesorado de primario
        $carrera_original = $this->manager
                ->getRepository()
                ->find(1);

        //se guarda el nombre original para contrastar con el nuevo
        $nombre_original = $carrera_original->getNombre();

        //se cambia el datos de la carrera
        $carrera_original->setNombre('xx');

        //se cambia el nombre
        $this->manager->actualizar($carrera_original, $parametro_no_usado, array(), array());

        $actualizado = $this->manager
                ->getRepository()
                ->find(1);
        
        //se verifica el cambio
        $this->assertTrue($actualizado->getNombre() <> $nombre_original);
        
        //se vuelve al estado inicial
        $carrera_original->setNombre($nombre_original);
        
        //se cambia el nombre
        $this->manager->actualizar($carrera_original, $parametro_no_usado, array(), array());
        
        
        
    }

    public function accept(AsignarVisitadorInterface $visitador) {
        //ya esta probado en el m{etodo asignarEstablecimientoAction de este test
    }
    /**
     * Asigna una carrera a un establecimiento pero queda asignado
     */

    public function testAsignarEstablecimiento() {

        //se prueba con profesorado de primaria
        $carrera_id = 1;
        $repository = $this->manager->getEm()->getRepository('EstablecimientoBundle:Establecimiento');

        //se calcula sobre el ISPEE que se sabe que no tiene profesorado de primaria
        $establecimiento = $repository->findOneBy(array('apodo' => 'ISPEE'));

        //calcula cuantos establecimientos tienen asignada una carrera
        $cantidad_anterior = count($repository->findCarreras($establecimiento));

        //hace una asignacion
        $this->manager->asignarEstablecimiento($carrera_id, $establecimiento->getId(), 'Asignar');

        //recalcula cuantos establecimientos tienen asignada la carrera
        $carreras = $repository->findCarreras($establecimiento);

        //compara los resultados
        $this->assertTrue($cantidad_anterior <> count($carreras));
        
        //se elimina la asignacion
        $this->manager->asignarEstablecimiento($carrera_id, $establecimiento->getId(), 'Desasignar');
        
        //recalcula cuantos establecimientos tienen asignada la carrera
        $carreras = $repository->findCarreras($establecimiento);

        //compara los resultados
        $this->assertTrue($cantidad_anterior == count($carreras));
        
        
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

        //se verifica que el objeto fue eliminado
        $this->assertTrue(is_null($object));
    }

    public function testCrearNuevo() {
        $manager = $this->manager;
        $object = $manager->crearNuevo();

        $this->assertTrue($object instanceof Carrera);
    }

    public function desvincular_norma($carrera = 1, $norma = 10) {
        //HASTA ACA
        
    }

    public function vincular_norma($carrera, $norma) {
        //HASTA aca
    }

    public function eliminar(Carrera $carrera, $flush = false) {
        //está testeado en el método crearAction de este test
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
