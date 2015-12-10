<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

/**
 * 
 */
class AutoridadControllerTest extends LoginWebTestCase {

    public function testListadoRectores(){
        $client = $this->client;

        $client->request('GET', '/establecimiento/autoridad/listado_rectores');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

}
