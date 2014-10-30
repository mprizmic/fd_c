<?php

namespace Fd\EstablecimientoBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

class UnidadOfertaControllerTest extends LoginWebTestCase {

    public function testAsignarTurno() {
        $client = $this->client;

        // Llama a la página del index
        $crawler = $client->request('GET', '/establecimiento/unidadoferta/asignar_turno/10');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        // Verifica un turno del establecimiento
        $this->assertGreaterThan(0, $crawler
                        ->filter('html:contains("Mañana")')
                        ->count()
        );
        // Verifica el boton del nombre de la carrera
        $crawler = $client->click($crawler->selectLink('Profesorado')->link());

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Profesorado")')->count());
    }

    public function testActualizarTurnos() {


        $client = $this->client;

        // Llama a la página del index
        $crawler = $client->request('GET', '/establecimiento/unidadoferta/asignar_turno/10');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Guardar')->form();
        $crawler = $client->submit($form);

    }

}
