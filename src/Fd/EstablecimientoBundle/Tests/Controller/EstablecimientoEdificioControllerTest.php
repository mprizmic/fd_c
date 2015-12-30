<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

/**
 * crud del backend de establecimiento_edificio.
 * FALTA Tiene un ajax que no se está testeando
 * FALTA create, update, delete y createdelete
 */

class EstablecimientoEdificioControllerTest extends LoginWebTestCase {


    /** @dataProvider provideUrls */
    public function testPageIsSuccessful($url) {
        $client = $this->client;
        $client->request('GET', $url);
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    /**
     * @return type
     */
    public function provideUrls() {
        $x = '/establecimiento/establecimiento_edificio';
        return array(
            array($x . '/sedes_anexos'),
// ...
        );
    }
}
