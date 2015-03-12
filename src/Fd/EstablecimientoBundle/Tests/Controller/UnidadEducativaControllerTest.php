<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

class UnidadEducativaControllerTest extends LoginWebTestCase {

    public function setup() {
        parent::setup();
    }
    public function testCombo() {

        // Llama a la página del index
        $this->crawler = $this->client->request('GET', '/establecimiento/unidad_educativa/combo/13');
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());

        // Verifica un valor del json
        $this->assertGreaterThan(0, $this->crawler
                        ->filter('html:contains(":45")')
                        ->count()
                );
    }

}
