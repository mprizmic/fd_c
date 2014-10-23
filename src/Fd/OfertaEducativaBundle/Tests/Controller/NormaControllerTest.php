<?php

namespace Fd\OfertaEducativaBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

/**
 * FLATA obtenernormaspaginadas
 * Testea el frontend de norma. Es una busqueda y una página de asignación
 */
class NormaControllerTest extends LoginWebTestCase {
    
    public $x = '/oferta/norma';
    
    public function testNorma() {
        $client = $this->client;
        $client->request('GET', $this->x.'/ver/4');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testBuscarAsignarCarrera() {
        $client = $this->client;
        $client->request('GET', $this->x.'/norma_buscar_asignar_carrera/1');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testObtenerNormasPaginadas() {
        //por ahora no se testea
    }

}