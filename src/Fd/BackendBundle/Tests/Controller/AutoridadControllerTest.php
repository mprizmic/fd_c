<?php

namespace Fd\BackendBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;

/**
 * testea el crud de autoridad que tiene una busqueda en el index
 * 
 * FALTA create, update, delete, deleteForm, generarDatosBusquedaPaginada
 */
class AutoridadControllerTest extends LoginWebTestCase {

    public function testBuscar() {
        // Create a new client to browse the application
        $client = $this->client;

        // buscar una autoridad
        $crawler = $client->request('GET', '/backend/autoridad/buscar');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        //cliqueo en buscar
        $form = $crawler->selectButton('Buscar')->form();
        $crawler = $client->submit($form);

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('th:contains("Acciones")')->count()
        );

        //hace click en la acción editar
        $crawler = $client->click($crawler->selectLink('Editar')->link());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        //verifica que fue a la página de edición
        $this->assertgreaterThan(0, $crawler->filter('h1:contains("Editar Autoridad")')->count());
    }

    /** @dataProvider provideUrls */
    public function testPageIsSuccessful($url) {
        $client = $this->client;
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @return type
     */
    public function provideUrls() {
        $x = '/backend/autoridad';
        return array(
            array($x . '/buscar'),
            array($x . '/1/show'),
            array($x . '/new'),
            array($x . '/1/edit'),
// ...
        );
    }

}
