<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

class UnidadEducativaControllerTest extends LoginWebTestCase {

    public function setup() {
        parent::setup();
    }
    public function testDe_un_cue() {
        $client = $this->client;
        $crawler = $this->crawler;

        // Llama a la página del index
        $crawler = $client->request('GET', '/establecimiento/unidad_educativa/unidad_educativa_de_un_cue/13');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        // Verifica el cue del establecimiento
        $this->assertGreaterThan(0, $crawler
                        ->filter('html:contains("200696")')
                        ->count()
                );
        // Verifica alguna autoridad
        $this->assertGreaterThan(0, $crawler
                        ->filter('html:contains("Autoridad:")')
                        ->count()
                );
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
