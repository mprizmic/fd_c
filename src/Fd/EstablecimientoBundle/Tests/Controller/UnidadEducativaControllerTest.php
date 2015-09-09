<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

class UnidadEducativaControllerTest extends LoginWebTestCase {

    private $establecimiento_edificio;

    public function setup() {

        parent::setup();

        /**
         * si el nro del id de establecimiento_edificio está mal no corre
         */
        $this->establecimiento_edificio = 28;
    }

    public function testCombo() {

        // Llama a la página del index
        $this->crawler = $this->client->request('GET', '/establecimiento/unidad_educativa/combo/' . $this->establecimiento_edificio);
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());

        // Verifica un valor del json
        $this->assertGreaterThan(0, $this->crawler
                        ->filter('html:contains("Terciario")')
                        ->count()
        );
    }

}
