<?php
/**
 * El testo del handler se deja por que se supone que se testea el manager 
 * El handlar es sólo un intermediario. Para testearlo se termina testeando el manager. Por lo menos a esta altura del avance del testinh
 * Se posterga.
 */

namespace Fd\OfertaEducativaBundle\Tests\Form\Handler;

use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Form\Handler\CarreraFormHandler;
use Fd\OfertaEducativaBundle\Model\CarreraManager;

class CarreraFormHandlerTest extends LoginWebTestCase {

    private $container;
    private $formHandler;
    private $em;

    public function setUp() {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = $this->container = static::$kernel->getContainer()
                ->get('doctrine.orm.entity_manager');
        
        $this->formHandler = new CarreraFormHandler(new CarreraManager($this->em));
    }

    public function testActualizar() {
        
    }
    public function testCrear(){
        
    }
    public function testEliminar(){
        
    }


}
